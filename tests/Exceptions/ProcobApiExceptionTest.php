<?php

namespace Procob\Test\Exceptions;

use GuzzleHttp\Psr7\Response;
use Procob\Exceptions\ProcobApiException;
use Procob\Person;
use Procob\Test\BaseTest;

class ProcobApiExceptionTest extends BaseTest
{
    /**
     * @dataProvider validCpf
     */
    public function test_check_body_error_code(string $cpf) {
        $this->expectException(ProcobApiException::class);
        $this->expectExceptionMessage('Mensagem de erro');

        $this->handler->append(new Response(200, [], '{"code": "999", "message": "Mensagem de erro"}'));

        Person::getByCpfCnpj($cpf);
    }
}
