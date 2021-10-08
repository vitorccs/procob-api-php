<?php

namespace Procob\Services;

use Procob\Exceptions\ProcobParameterException;
use Procob\Helpers\CpfCnpjHelper;
use Procob\Helpers\SanitizerHelper;

class PersonValidator
{
    /**
     * @param string|int $cpf
     * @return string
     * @throws ProcobParameterException
     */
    public static function validateCpf($cpf): string
    {
        $cpf = SanitizerHelper::cleanNumeric($cpf);

        if (!strlen($cpf) || !CpfCnpjHelper::validateCpf($cpf)) {
            throw new ProcobParameterException('CPF is not valid');
        }

        return $cpf;
    }

    /**
     * @param string|int $cnpj
     * @return string
     * @throws ProcobParameterException
     */
    public static function validateCnpj($cnpj): string
    {
        $cnpj = SanitizerHelper::cleanNumeric($cnpj);

        if (!strlen($cnpj) || !CpfCnpjHelper::validateCnpj($cnpj)) {
            throw new ProcobParameterException('CNPJ is not valid');
        }

        return $cnpj;
    }

    /**
     * @param string|int $cpfCnpj
     * @return string
     * @throws ProcobParameterException
     */
    public static function validateCpfCnpj($cpfCnpj): string
    {
        $cpfCnpj = SanitizerHelper::cleanNumeric($cpfCnpj);

        if (!strlen($cpfCnpj) || !CpfCnpjHelper::validateCpfCnpj($cpfCnpj)) {
            throw new ProcobParameterException('CPF/CNPJ is not valid');
        }

        return $cpfCnpj;
    }

    /**
     * @param string $name
     * @return string
     * @throws ProcobParameterException
     */
    public static function validateName(string $name): string
    {
        $name = SanitizerHelper::cleanString($name);

        if (!strlen($name)) {
            throw new ProcobParameterException('Name is not valid');
        }

        return $name;
    }

    /**
     * @param string $email
     * @return string
     * @throws ProcobParameterException
     */
    public static function validateEmail(string $email): string
    {
        $email = SanitizerHelper::cleanString($email);

        if (!strlen($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ProcobParameterException('E-mail is not valid');
        }

        return $email;
    }

    /**
     * @param string|int $ddd
     * @return string
     * @throws ProcobParameterException
     */
    public static function validatePhoneDdd($ddd): string
    {
        $ddd = SanitizerHelper::cleanNumeric($ddd);

        if (strlen($ddd) != 2) {
            throw new ProcobParameterException('DDD is not valid');
        }

        return $ddd;
    }

    /**
     * @param string|int $number
     * @return string
     * @throws ProcobParameterException
     */
    public static function validatePhoneNumber($number): string
    {
        $number = SanitizerHelper::cleanNumeric($number);

        if (strlen($number) != 8 && strlen($number) != 9) {
            throw new ProcobParameterException('Number is not valid');
        }

        return $number;
    }
}

