<?php
declare(strict_types=1);

namespace Procob\Test\Services;

use Procob\Exceptions\ProcobParameterException;
use Procob\Services\PersonValidator;
use Procob\Test\BaseTest;

class PersonValidatorTest extends BaseTest
{
    /**
     * @dataProvider invalidCpfCnpj
     */
    public function test_invalid_cpf_cnpj($value)
    {
        $this->expectException(ProcobParameterException::class);
        $this->expectExceptionMessage('CPF/CNPJ is not valid');
        PersonValidator::validateCpfCnpj($value);
    }

    /**
     * @dataProvider invalidName
     */
    public function test_invalid_name($value)
    {
        $this->expectException(ProcobParameterException::class);
        $this->expectExceptionMessage('Name is not valid');
        PersonValidator::validateName($value);
    }

    /**
     * @dataProvider invalidPhone
     */
    public function test_invalid_ddd($value)
    {
        $this->expectException(ProcobParameterException::class);
        $this->expectExceptionMessage('DDD is not valid');
        PersonValidator::validatePhoneDdd($value);
    }

    /**
     * @dataProvider invalidPhone
     */
    public function test_invalid_number($value)
    {
        $this->expectException(ProcobParameterException::class);
        $this->expectExceptionMessage('Number is not valid');
        PersonValidator::validatePhoneNumber($value);
    }

    /**
     * @dataProvider invalidEmail
     */
    public function test_validate_invalid_email($value)
    {
        $this->expectException(ProcobParameterException::class);
        $this->expectExceptionMessage('E-mail is not valid');
        PersonValidator::validateEmail($value);
    }

    public function invalidCpfCnpj(): array
    {
        return [
            'empty' => [''],
            'invalid' => ['a']
        ];
    }

    public function invalidName(): array
    {
        return [
            'empty' => [''],
        ];
    }

    public function invalidPhone(): array
    {
        return [
            'empty' => [''],
            'one-char' => [1],
            'three-chars' => [111]
        ];
    }

    public function invalidEmail(): array
    {
        return [
            'empty' => [''],
            'syntax' => ['wrong@gmail']
        ];
    }
}
