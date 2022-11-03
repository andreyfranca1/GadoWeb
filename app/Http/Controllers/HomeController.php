<?php

namespace App\Http\Controllers;
use App\Models\Cattle;
use App\Models\Flock;
use Illuminate\Support\Facades\DB;
use App\Models\Weighing;
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
        return view('site.index', ['metrics' => $this->getMetrics()]);
    }

    public function getMetrics()
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
            ->join('food_events', 'food_events.id', '=', 'flocks.id')
            ->join('medication_events', 'medication_events.id', '=', 'flocks.id')
            ->join('vaccination_events', 'vaccination_events.id', '=', 'flocks.id')
            ->count();

        return $data;
    }
}
