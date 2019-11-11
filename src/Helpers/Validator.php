<?php

namespace Procob\Helpers;

class Validator
{
    /**
     * @param $cpf
     * @return bool
     */
    public static function validateCpf($cpf): bool
    {
        if (empty($cpf)) return false;

        // removes mask
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) != 11) return false;

        // prevent invalid numbers that cannot be detected in the digit calculation
        elseif ($cpf == '00000000000' ||
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
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }

    /**
     * @param $cnpj
     * @return bool
     */
    public static function validateCnpj($cnpj): bool
    {
        if (empty($cnpj)) return false;

        // removes mask
        $cnpj = preg_replace('/[^0-9]/', '', (string)$cnpj);

        if (strlen($cnpj) != 14) return false;

        // check first validator digit
        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
            $sum += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $remainder = $sum % 11;

        if ($cnpj{12} != ($remainder < 2 ? 0 : 11 - $remainder)) {
            return false;
        }

        // check second validator digit
        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
            $sum += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $remainder = $sum % 11;

        return $cnpj{13} == ($remainder < 2 ? 0 : 11 - $remainder);
    }

    /**
     * @param $string
     * @return bool
     */
    public static function validateCpfCnpj($string): bool
    {
        return (static::validateCpf($string) || static::validateCnpj($string));
    }
}
