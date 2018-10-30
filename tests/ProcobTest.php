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
}
