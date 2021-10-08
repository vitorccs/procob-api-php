<?php

namespace Procob\Test\Exceptions;

use GuzzleHttp\Psr7\Response;
use Procob\Exceptions\ProcobRequestException;
use Procob\Person;
use Procob\Test\BaseTest;

class ProcobRequestExceptionTest extends BaseTest
{
    /**
     * @dataProvider validCpf
     */
    public function test_check_http_status_code(string $cpf) {
        $this->expectException(ProcobRequestException::class);

        $this->handler->append(new Response(500, [], null));

        Person::getByCpfCnpj($cpf);
    }
}
