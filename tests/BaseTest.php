<?php

namespace Procob\Test;

use Faker\Factory;
use Faker\Generator;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;
use Procob\Http\Procob;
use Procob\Person;

abstract class BaseTest extends TestCase
{
    /**
     * @var Generator|null
     */
    protected static $faker = null;

    /**
     * @var MockHandler
     */
    protected $handler;

    /**
     *
     */
    const FAKER_LOCALE = 'pt_BR';

    /**
     * @return Generator
     */
    public static function faker(): Generator
    {
        if (is_null(self::$faker)) {
            self::$faker = Factory::create(self::FAKER_LOCALE);
        }

        return self::$faker;
    }

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
}
