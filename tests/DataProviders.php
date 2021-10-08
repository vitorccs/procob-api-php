<?php

namespace Procob\Test;

use Faker\Factory;
use Faker\Generator;

trait DataProviders
{
    /**
     * @var Generator|null
     */
    protected static $faker = null;

    /**
     *
     */
    protected static $fakerLocale = 'pt_BR';

    /**
     * @return Generator
     */
    public static function faker(): Generator
    {
        if (is_null(self::$faker)) {
            self::$faker = Factory::create(self::$fakerLocale);
        }

        return self::$faker;
    }

    public function validCpf(): array
    {
        return [
            'valid' => [self::faker()->cpf()]
        ];
    }

    public function validCnpj(): array
    {
        return [
            'valid' => [self::faker()->cnpj()]
        ];
    }

    public function validName(): array
    {
        return [
            'valid' => [self::faker()->name()]
        ];
    }

    public function validPhone(): array
    {
        return [
            'valid' => [self::faker()->areaCode(), self::faker()->cellphone()]
        ];
    }

    public function validEmail(): array
    {
        return [
            'valid' => [self::faker()->email()]
        ];
    }
}
