<?php

if (!function_exists('validaCPF')) {
    function validaCPF($cpf = null): bool
    {
        if (empty($cpf)) {
            return false;
        }

        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (!is_numeric($cpf)) {
            return false;
        }

        if (strlen($cpf) != 11) {
            return false;
        } elseif ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {

            return false;
        } else {
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }
            return true;
        }
    }

    if (!function_exists('validaCNPJ')) {
        function validaCNPJ($cnpj = null): bool
        {
            $cnpj = preg_replace('/[^0-9]/is', '', $cnpj);

            if (strlen($cnpj) != 14) {
                return false;
            }

            if (preg_match('/(\d)\1{13}/', $cnpj)) {
                return false;
            }

            for ($t = 12; $t < 14; $t++) {
                for ($d = 0, $m = ($t - 7), $i = 0; $i < $t; $i++) {
                    $d += $cnpj[$i] * $m;
                    $m = ($m == 2 ? 9 : --$m);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cnpj[$i] != $d) {
                    return false;
                }
            }
            return true;
        }
    }

    if (!function_exists('removeCaracteres')) {
        function removeCaracteres($string): array|string
        {
            $array = array('/', '-', '(', ')', '=', '+', '@', '!', '[', ']', '.', ' ', ',', 'R', '$');
            return str_replace($array, '', $string);
        }
    }
}
