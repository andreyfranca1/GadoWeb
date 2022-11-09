<?php

namespace App\Http\Controllers;
use App\Models\Cattle;
use App\Models\Flock;
use Illuminate\Support\Facades\DB;
use App\Models\Weighing;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function index(): Factory|View|Application
    {

        

        $nextEvents['alimentacoes'] = DB::table('food_events')->selectRaw('food_events.description as descricao, 
        food_events.start_date as dataInicio, flocks.name as nomeRebanho')
        ->join('flocks', 'food_events.flock_id', '=', 'flocks.id')
        ->where('flocks.company_id', '=', Auth::user()->company_id)
        ->whereBetween('food_events.start_date',[Carbon::now(), Carbon::now()->addDays(7)])
        ->get()->toArray();
        


        $nextEvents['medicacoes'] = DB::table('medication_events')->selectRaw('medication_events.description as descricao, 
        medication_events.start_date as dataInicio, flocks.name as nomeRebanho')
        ->join('flocks', 'medication_events.flock_id', '=', 'flocks.id')
        ->where('flocks.company_id', '=', Auth::user()->company_id)
        ->whereBetween('medication_events.start_date',[Carbon::now(), Carbon::now()->addDays(7)])
        ->get()->toArray();
        

        $nextEvents['vacinacoes'] = DB::table('vaccination_events')->selectRaw('vaccination_events.description as descricao, 
        vaccination_events.date as dataInicio, flocks.name as nomeRebanho')
        ->join('flocks', 'vaccination_events.flock_id', '=', 'flocks.id')
        ->where('flocks.company_id', '=', Auth::user()->company_id)
        ->whereBetween('vaccination_events.date',[Carbon::now(), Carbon::now()->addDays(7)])
        ->get()->toArray();
        

        return view('site.index', [
            'metrics' => $this->getMetrics(), 
            'events' => $nextEvents]);
    }

    public function getMetrics(): array
    {


        $data['cattles'] = Cattle::where('company_id', Auth::user()['company_id'])
            ->count();

        $data['flocks'] = Flock::where('company_id', Auth::user()['company_id'])
            ->count();

        $data['weighings'] = DB::table('weighings')
            ->join('cattle', 'weighings.cattle_id', '=', 'cattle.id')
            ->where('cattle.company_id', '=', Auth::user()['company_id'])
            ->where('weighings.created_at', '>=', date('Y-m-d',
                strtotime('today - 30 days')))
            ->count();

        $data['events'] = DB::table('flocks')
            ->join('food_events', 'food_events.flock_id', '=', 'flocks.id')
            ->whereBetween('food_events.created_at',[Carbon::now()->subDays(7),Carbon::now()])
            ->count();

        $data['events'] += DB::table('flocks')
            ->join('medication_events', 'medication_events.flock_id', '=', 'flocks.id')
            ->whereBetween('medication_events.created_at',[Carbon::now()->subDays(7),Carbon::now()])
            ->count();

        $data['events'] += DB::table('flocks')
            ->join('vaccination_events', 'vaccination_events.flock_id', '=', 'flocks.id')
            ->whereBetween('vaccination_events.created_at',[Carbon::now()->subDays(7),Carbon::now()])
            ->count();
            

        return $data;
    }
}
