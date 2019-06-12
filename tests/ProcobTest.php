<?php
declare(strict_types=1);

namespace Procob\Test;

use PHPUnit\Framework\TestCase;
use Procob\Http\Procob;

class ProcobTest extends TestCase
{
    /** @test */
    public function it_should_set_timeout()
    {
        $envValue       = getenv(Procob::TIMEOUT);
        $procobValue    = Procob::getTimeout();

        $this->assertEquals($procobValue, $envValue);
    }

    /** @test */
    public function it_should_set_user()
    {
        $envValue       = getenv(Procob::USER);
        $procobValue    = Procob::getUser();

        $this->assertEquals($procobValue, $envValue);
    }

    /** @test */
    public function it_should_set_password()
    {
        $envValue       = getenv(Procob::PWD);
        $procobValue    = Procob::getPassword();

        $this->assertEquals($procobValue, $envValue);
    }

    /** @test */
    public function it_should_set_by_params()
    {
        // set random value
        $params = [
            Procob::TIMEOUT => '60',
            Procob::USER => 'usuario',
            Procob::PWD => 'senha'
        ];
        Procob::setParams($params);
        $this->assertEquals(Procob::getTimeout(), $params[Procob::TIMEOUT]);
        $this->assertEquals(Procob::getUser(), $params[Procob::USER]);
        $this->assertEquals(Procob::getPassword(), $params[Procob::PWD]);

        // rollback
        $params = [
            Procob::TIMEOUT => getenv(Procob::TIMEOUT),
            Procob::USER => getenv(Procob::USER),
            Procob::PWD => getenv(Procob::PWD)
        ];
        Procob::setParams($params);
    }
}
