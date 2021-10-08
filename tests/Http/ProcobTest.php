<?php
declare(strict_types=1);

namespace Procob\Test\Http;

use Procob\Http\Procob;
use Procob\Test\BaseTest;

class ProcobTest extends BaseTest
{
    public function test_parameters_by_env()
    {
        $this->assertEquals(Procob::getTimeout(), getenv(Procob::TIMEOUT));
        $this->assertEquals(Procob::getUser(), getenv(Procob::USER));
        $this->assertEquals(Procob::getPassword(), getenv(Procob::PWD));
    }

    public function test_parameters_by_array()
    {
        $parameters = self::generateParameters();

        Procob::setParams($parameters);

        $this->assertEquals(Procob::getTimeout(), $parameters[Procob::TIMEOUT]);
        $this->assertEquals(Procob::getUser(), $parameters[Procob::USER]);
        $this->assertEquals(Procob::getPassword(), $parameters[Procob::PWD]);
    }
}
