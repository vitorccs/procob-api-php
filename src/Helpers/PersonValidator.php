<?php
namespace Procob\Helpers;

use Procob\Exceptions\ProcobParameterException;
use Procob\Helpers\Sanitizer;
use Procob\Helpers\Validator;

class PersonValidator
{
    public static function validateCpf($cpf)
    {
        $cpf = Sanitizer::cleanNumeric($cpf);

        if (!strlen($cpf) || !Validator::validateCpf($cpf)) {
            throw new ProcobParameterException('CPF is not valid');
        }

        return $cpf;
    }

    public static function validateCnpj($cnpj)
    {
        $cnpj = Sanitizer::cleanNumeric($cnpj);

        if (!strlen($cnpj) || !Validator::validateCpfCnpj($cnpj)) {
            throw new ProcobParameterException('CNPJ is not valid');
        }

        return $cnpj;
    }

    public static function validateCpfCnpj($cpfCnpj)
    {
        $cpfCnpj = Sanitizer::cleanNumeric($cpfCnpj);

        if (!strlen($cpfCnpj) || !Validator::validateCpfCnpj($cpfCnpj)) {
            throw new ProcobParameterException('CPF/CNPJ is not valid');
        }

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
        $ddd = Sanitizer::cleanNumeric($ddd);

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
