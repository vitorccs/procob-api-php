<?php

namespace Procob\Test;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;
use Procob\Http\Procob;
use Procob\Person;

abstract class BaseTest extends TestCase
{
    use DataProviders;

    /**
     * @var MockHandler
     */
    protected $handler;

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
        $this->setFakeHttpClient();
    }

    /**
     * Set env parameters
     */
    protected static function setEnvParameters(): void
    {
        $parameters = self::generateParameters();

        foreach ($parameters as $key => $value) {
            putenv("$key=$value");
        }
    }

    /**
     * Change HTTP Client to a Fake Guzzle instance
     */
    protected function setFakeHttpClient(): void
    {
        $this->handler = new MockHandler([]);

        $client = new Client([
            'handler' => HandlerStack::create($this->handler)
        ]);

        Person::api()->setClient($client);
    }

    /**
     * Generate random env parameters
     *
     * @return array
     */
    protected static function generateParameters(): array
    {
        return [
            Procob::TIMEOUT => self::faker()->numberBetween(1, 60),
            Procob::USER => self::faker()->word(),
            Procob::PWD => self::faker()->word(),
        ];
    }
}
