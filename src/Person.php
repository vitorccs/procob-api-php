<?php

namespace Procob;

use GuzzleHttp\Exception\GuzzleException;
use Procob\Http\Resource;
use Procob\Services\PersonValidator;

class Person extends Resource
{
    /**
     * @param string|int $cpfCnpj
     * @return mixed
     * @throws Exceptions\ProcobApiException
     * @throws Exceptions\ProcobParameterException
     * @throws Exceptions\ProcobRequestException
     * @throws GuzzleException
     */
    public static function getByCpfCnpj($cpfCnpj)
    {
        $cpfCnpj = PersonValidator::validateCpfCnpj($cpfCnpj);

        return parent::find('v2/L0001', $cpfCnpj);
    }

    /**
     * @param string $name
     * @param array $params
     * @return mixed
     * @throws Exceptions\ProcobApiException
     * @throws Exceptions\ProcobParameterException
     * @throws Exceptions\ProcobRequestException
     * @throws GuzzleException
     */
    public static function getByName(string $name, array $params = [])
    {
        $name = PersonValidator::validateName($name);

        return parent::find('v2/L0002', $name, $params);
    }

    /**
     * @param string|int $ddd
     * @param $number
     * @return mixed
     * @throws Exceptions\ProcobApiException
     * @throws Exceptions\ProcobParameterException
     * @throws Exceptions\ProcobRequestException
     * @throws GuzzleException
     */
    public static function getByPhone($ddd, $number)
    {
        $ddd = PersonValidator::validatePhoneDdd($ddd);
        $number = PersonValidator::validatePhoneNumber($number);

        return parent::find('L0003', "$ddd/$number");
    }

    /**
     * @param string|int $cpfCnpj
     * @param array $params
     * @return mixed
     * @throws Exceptions\ProcobApiException
     * @throws Exceptions\ProcobParameterException
     * @throws Exceptions\ProcobRequestException
     * @throws GuzzleException
     */
    public static function getCpfCnpjStatus($cpfCnpj, array $params = [])
    {
        $cpfCnpj = PersonValidator::validateCpfCnpj($cpfCnpj);

        return parent::find('v2/L0014', $cpfCnpj, $params);
    }

    /**
     * @param string|int $cnpj
     * @return mixed
     * @throws Exceptions\ProcobApiException
     * @throws Exceptions\ProcobParameterException
     * @throws Exceptions\ProcobRequestException
     * @throws GuzzleException
     */
    public static function getCompanyPartners($cnpj)
    {
        $cnpj = PersonValidator::validateCnpj($cnpj);

        return parent::find('v3/L0006', $cnpj);
    }

    /**
     * @param array $params
     * @return mixed
     * @throws Exceptions\ProcobApiException
     * @throws Exceptions\ProcobRequestException
     * @throws GuzzleException
     */
    public static function getNeighbors(array $params)
    {
        return parent::find('v1/L0038', null, $params);
    }

    /**
     * @param string $email
     * @return mixed
     * @throws Exceptions\ProcobApiException
     * @throws Exceptions\ProcobParameterException
     * @throws Exceptions\ProcobRequestException
     * @throws GuzzleException
     */
    public static function getByEmail(string $email)
    {
        $email = PersonValidator::validateEmail($email);

        return parent::find('v1/L0035', $email);
    }

    /**
     * @param string|int $cpf
     * @return mixed
     * @throws Exceptions\ProcobApiException
     * @throws Exceptions\ProcobParameterException
     * @throws Exceptions\ProcobRequestException
     * @throws GuzzleException
     */
    public static function getNationalInsuranceStatus($cpf)
    {
        $cpf = PersonValidator::validateCpf($cpf);

        return parent::find('v1/L0033', $cpf);
    }

    /**
     * @param string|int $cpfCnpj
     * @return mixed
     * @throws Exceptions\ProcobApiException
     * @throws Exceptions\ProcobParameterException
     * @throws Exceptions\ProcobRequestException
     * @throws GuzzleException
     */
    public static function getBasicData($cpfCnpj)
    {
        $cpfCnpj = PersonValidator::validateCpfCnpj($cpfCnpj);

        return parent::find('v1/L0032', $cpfCnpj);
    }

    /**
     * @param string|int $cnpj
     * @return mixed
     * @throws Exceptions\ProcobApiException
     * @throws Exceptions\ProcobParameterException
     * @throws Exceptions\ProcobRequestException
     * @throws GuzzleException
     */
    public static function getCompanyProfile($cnpj)
    {
        $cnpj = PersonValidator::validateCnpj($cnpj);

        return parent::find('v1/L0008', $cnpj);
    }
}
