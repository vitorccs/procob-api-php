<?php
namespace Procob\Helpers;

use Procob\Exceptions\ProcobParameterException;
use Procob\Helpers\Sanitizer;
use Procob\Helpers\Validator;

class PersonValidator
{
    public static function validateCpf($cpf)
    {
        if (!Validator::validateCpf($cpf)) {
            throw new ProcobParameterException('CPF is not valid');
        }

        $cpf = Sanitizer::cleanNumeric($cpf);

        return $cpf;
    }

    public static function validateCnpj($cnpj)
    {
        if (!Validator::validateCpfCnpj($cnpj)) {
            throw new ProcobParameterException('CNPJ is not valid');
        }

        $cnpj = Sanitizer::cleanNumeric($cnpj);

        return $cnpj;
    }

    public static function validateCpfCnpj($cpfCnpj)
    {
        if (!Validator::validateCpfCnpj($cpfCnpj)) {
            throw new ProcobParameterException('CPF/CNPJ is not valid');
        }

        $cpfCnpj = Sanitizer::cleanNumeric($cpfCnpj);

        return $cpfCnpj;
    }

    public static function validateName($name)
    {
        $name = Sanitizer::cleanString($name);

        if (!strlen($name)) {
            throw new ProcobParameterException('Name is not valid');
        }

        return $name;
    }

    public static function validateEmail($email)
    {
        $email = Sanitizer::cleanString($email);

        if (!strlen($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ProcobParameterException('E-mail is not valid');
        }

        return $email;
    }

    public static function validatePhoneDdd($ddd)
    {
        $ddd    = Sanitizer::cleanNumeric($ddd);

        if (strlen($ddd) != 2) {
            throw new ProcobParameterException('DDD is not valid');
        }

        return $ddd;
    }

    public static function validatePhoneNumber($number)
    {
        $number = Sanitizer::cleanNumeric($number);

        if (strlen($number) != 8 && strlen($number) != 9) {
            throw new ProcobParameterException('Number is not valid');
        }

        return $number;
    }
}
?>
