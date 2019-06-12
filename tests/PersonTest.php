<?php
declare(strict_types=1);

namespace ApiBradesco\Test;

use PHPUnit\Framework\TestCase;
use Procob\Exceptions\ProcobValidationException;
use Procob\Person;

class PersonTest extends TestCase
{
    protected $data;

    public function setUp()
    {
        $this->data = json_decode(getenv('DATA'));
    }

    /**
     * @test
     */
    public function it_should_get_by_cpf()
    {
        $response = Person::getByCpfCnpj($this->data->cpf);

        $success = ($response->code ?? null) === '000';

        $this->assertTrue($success);
    }

    /**
     * @test
     */
    public function it_should_get_by_cnpj()
    {
        $response = Person::getByCpfCnpj($this->data->cnpj);

        $success = ($response->code ?? null) === '000';

        $this->assertTrue($success);
    }

    /**
     * @test
     * @expectedException        Procob\Exceptions\ProcobParameterException
     * @expectedExceptionMessage CPF/CNPJ is not valid
     */
    public function it_should_validate_empty_cpf_cnpj()
    {
        Person::getByCpfCnpj('');
    }

    /**
     * @test
     * @expectedException        Procob\Exceptions\ProcobParameterException
     * @expectedExceptionMessage CPF/CNPJ is not valid
     */
    public function it_should_validate_null_cpf_cnpj()
    {
        Person::getByCpfCnpj(null);
    }

    /**
     * @test
     * @expectedException        Procob\Exceptions\ProcobParameterException
     * @expectedExceptionMessage CPF/CNPJ is not valid
     */
    public function it_should_validate_invalid_cpf_cnpj()
    {
        Person::getByCpfCnpj('invalid');
    }

    /**
     * @test
     */
    public function it_should_get_by_name()
    {
        $response = Person::getByName($this->data->name);

        $success = ($response->code ?? null) === '000';

        $this->assertTrue($success);
    }

    /**
     * @test
     * @expectedException        Procob\Exceptions\ProcobParameterException
     * @expectedExceptionMessage Name is not valid
     */
    public function it_should_validate_empty_name()
    {
        Person::getByName('');
    }

    /**
     * @test
     * @expectedException        Procob\Exceptions\ProcobParameterException
     * @expectedExceptionMessage Name is not valid
     */
    public function it_should_validate_invalid_name()
    {
        Person::getByName("/");
    }

    /**
     * @test
     */
    public function it_should_get_by_name_with_params()
    {
        $params = [
            'buscarPessoa' => 'SIM',
            'tipoPessoa'   => 'F'
        ];

        $response = Person::getByName('João', $params);

        $success = ($response->code ?? null) === '000';

        $noCompanies = is_null($response->content->cnpj ?? null);

        $this->assertTrue($success);
        $this->assertTrue($noCompanies);
    }

    /**
     * @test
     */
    public function it_should_get_by_phone()
    {
        $response = Person::getByPhone($this->data->ddd, $this->data->number);

        $success = ($response->code ?? null) === '000';

        $this->assertTrue($success);
    }

    /**
     * @test
     * @expectedException        Procob\Exceptions\ProcobParameterException
     * @expectedExceptionMessage DDD is not valid
     */
    public function it_should_validate_null_ddd()
    {
        Person::getByPhone(null, $this->data->number);
    }

    /**
     * @test
     * @expectedException        Procob\Exceptions\ProcobParameterException
     * @expectedExceptionMessage DDD is not valid
     */
    public function it_should_validate_invalid_ddd()
    {
        Person::getByPhone(1, $this->data->number);
    }

    /**
     * @test
     * @expectedException        Procob\Exceptions\ProcobParameterException
     * @expectedExceptionMessage Number is not valid
     */
    public function it_should_validate_null_number()
    {
        Person::getByPhone($this->data->ddd, null);
    }

    /**
     * @test
     * @expectedException        Procob\Exceptions\ProcobParameterException
     * @expectedExceptionMessage Number is not valid
     */
    public function it_should_validate_invalid_number()
    {
        Person::getByPhone($this->data->ddd, 111);
    }

    /**
     * @test
     */
    public function it_should_get_by_cpf_cnpj_status()
    {
        $response = Person::getCpfCnpjStatus($this->data->cnpj);

        $success = ($response->code ?? null) === '000';

        $this->assertTrue($success);
    }

    /**
     * @test
     */
    public function it_should_get_company_partners()
    {
        if ($this->data->basicPlan) {
            $this->expectException(ProcobValidationException::class);
        }

        $response = Person::getCompanyPartners($this->data->cnpj);

        $success = ($response->code ?? null) === '000';

        $this->assertTrue($success);
    }

    /**
     * @test
     */
    public function it_should_get_neighbors()
    {
        $params = [
            'endereco' => 'Bernardino de Campos',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'numero' => 294
        ];

        $response = Person::getNeighbors($params);

        $success = ($response->code ?? null) === '000';

        $this->assertTrue($success);
    }

    /**
     * @test
     */
    public function it_should_get_by_email()
    {
        $response = Person::getByEmail($this->data->email);

        $success = ($response->code ?? null) === '000';

        $this->assertTrue($success);
    }

    /**
     * @test
     * @expectedException        Procob\Exceptions\ProcobParameterException
     * @expectedExceptionMessage E-mail is not valid
     */
    public function it_should_validate_email()
    {
        Person::getByEmail("wrong@gmail");
    }

    /**
     * @test
     */
    public function it_should_get_national_insurance_status()
    {
        $response = Person::getNationalInsuranceStatus($this->data->cpf);

        $success = ($response->code ?? null) === '000';

        $this->assertTrue($success);
    }

    /**
     * @test
     */
    public function it_should_get_basic_data()
    {
        $response = Person::getBasicData($this->data->cnpj);

        $success = ($response->code ?? null) === '000';

        $this->assertTrue($success);
    }

    /**
     * @test
     */
    public function it_should_get_company_profile()
    {
        if ($this->data->basicPlan) {
            $this->expectException(ProcobValidationException::class);
        }

        $response = Person::getCompanyProfile($this->data->cnpj);

        $success = ($response->code ?? null) === '000';

        $this->assertTrue($success);
    }
}
