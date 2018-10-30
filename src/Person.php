<?php
namespace Procob;

use Procob\Http\Resource;
use Procob\Helpers\PersonValidator;

class Person extends Resource
{
    public static function getByCpfCnpj($cpfCnpj)
    {
        $cpfCnpj = PersonValidator::validateCpfCnpj($cpfCnpj);

        return parent::find('v2/L0001', $cpfCnpj);
    }

    public static function getByName(string $name, array $params = [])
    {
        $name = PersonValidator::validateName($name);

        return parent::find('v2/L0002', $name, $params);
    }

    public static function getByPhone($ddd, $number)
    {
        $ddd    = PersonValidator::validatePhoneDdd($ddd);
        $number = PersonValidator::validatePhoneNumber($number);

        return parent::find('L0003', "$ddd/$number");
    }

    public static function getCpfCnpjStatus($cpfCnpj, array $params = [])
    {
        $cpfCnpj = PersonValidator::validateCpfCnpj($cpfCnpj);

        return parent::find('v2/L0014', $cpfCnpj, $params);
    }

    public static function getCompanyPartners($cnpj)
    {
        $cnpj = PersonValidator::validateCnpj($cnpj);

        return parent::find('v3/L0006', $cnpj);
    }

    public static function getNeighbors(array $params = [])
    {
        return parent::find('v1/L0038', null, $params);
    }

    public static function getByEmail(string $email)
    {
        $email = PersonValidator::validateEmail($email);

        return parent::find('v1/L0035', $email);
    }

    public static function getNationalInsuranceStatus($cpf)
    {
        $cpf = PersonValidator::validateCpf($cpf);

        return parent::find('v1/L0033', $cpf);
    }

    public static function getBasicData($cpfCnpj)
    {
        $cpfCnpj = PersonValidator::validateCpfCnpj($cpfCnpj);

        return parent::find('v1/L0032', $cpfCnpj);
    }

    public static function getCompanyProfile($cnpj)
    {
        $cnpj = PersonValidator::validateCnpj($cnpj);

        return parent::find('v1/L0008', $cnpj);
    }
}
