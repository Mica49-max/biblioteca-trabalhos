<?php

namespace App\Enums;

enum ProjectType: string
{
    case Site = 'site';
    case Program = 'program';
    case App = 'app';
    case Script = 'script';
    case Test = 'test';

    public function label(): string
    {
        return match ($this) {
            self::Site => 'Site',
            self::Program => 'Programa',
            self::App => 'App',
            self::Script => 'Script',
            self::Test => 'Teste / Experiência',
        };
    }
}