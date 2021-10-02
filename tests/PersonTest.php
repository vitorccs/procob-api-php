<?php
declare(strict_types=1);

namespace Procob\Test;

use GuzzleHttp\Psr7\Response;
use Procob\Person;

class PersonTest extends BaseTest
{
    /**
     * Run once
     */
    public static function setUpBeforeClass(): void
    {
        self::setEnvParameters();
    }

    /**
     * Run before each test
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->handler->append(new Response(200, [], '{"code": "000"}'));
    }

    /**
     * @dataProvider validCpf
     */
    public function test_get_by_cpf(string $cpf)
    {
        $response = Person::getByCpfCnpj($cpf);

        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('code', $response);
        $this->assertSame('000', $response->code);
    }

    /**
     * @dataProvider validName
     */
    public function test_get_by_name(string $cnpj)
    {
        $response = Person::getByName($cnpj);

        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('code', $response);
        $this->assertSame('000', $response->code);
    }

    /**
     * @dataProvider validPhone
     */
    public function test_get_by_phone(string $ddd, string $number)
    {
        $response = Person::getByPhone($ddd, $number);

        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('code', $response);
        $this->assertSame('000', $response->code);
    }

    /**
     * @dataProvider validCnpj
     */
    public function test_get_cpf_cnpj_status(string $cnpj)
    {
        $response = Person::getCpfCnpjStatus($cnpj);

        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('code', $response);
        $this->assertSame('000', $response->code);
    }

    /**
     * @dataProvider validCnpj
     */
    public function test_get_company_partners(string $cnpj)
    {
        $response = Person::getCompanyPartners($cnpj);

        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('code', $response);
        $this->assertSame('000', $response->code);
    }

    /**
     * @dataProvider validNeighborsParams
     */
    public function test_get_neighbors(array $params)
    {
        $response = Person::getNeighbors($params);

        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('code', $response);
        $this->assertSame('000', $response->code);
    }

    /**
     * @dataProvider validEmail
     */
    public function test_get_by_email(string $email)
    {
        $response = Person::getByEmail($email);

        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('code', $response);
        $this->assertSame('000', $response->code);
    }

    /**
     * @dataProvider validCpf
     */
    public function test_national_insurance_status(string $cpf)
    {
        $response = Person::getNationalInsuranceStatus($cpf);

        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('code', $response);
        $this->assertSame('000', $response->code);
    }

    /**
     * @dataProvider validCpf
     */
    public function test_basic_data(string $cpf)
    {
        $response = Person::getBasicData($cpf);

        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('code', $response);
        $this->assertSame('000', $response->code);
    }

    /**
     * @dataProvider validCnpj
     */
    public function test_company_profile(string $cpfCnpj)
    {
        $response = Person::getCompanyProfile($cpfCnpj);

        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('code', $response);
        $this->assertSame('000', $response->code);
    }



    public function validNeighborsParams(): array
    {
        return [
            'valid' => [
                [
                    'endereco' => self::faker()->streetAddress(),
                    'cidade' => self::faker()->city(),
                    'uf' => self::faker()->stateAbbr(),
                    'numero' => self::faker()->numberBetween(1, 100)
                ]
            ]
        ];
    }
}
