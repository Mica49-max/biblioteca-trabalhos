<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AdminPassword extends Command
{
    protected $signature = 'admin:password';

    protected $description = 'Gera o hash da palavra-passe da área privada para colar no .env';

    public function handle(): int
    {
        $password = $this->secret('Palavra-passe (não aparece enquanto escreves)');
        $confirm = $this->secret('Repete a palavra-passe');

        if ($password === null || $password === '' || $password !== $confirm) {
            $this->error('As palavras-passe estão vazias ou não coincidem.');

            return self::FAILURE;
        }

        if (mb_strlen($password) < 12) {
            $this->error('Usa pelo menos 12 caracteres.');

            return self::FAILURE;
        }

        $this->newLine();
        $this->info('Cola esta linha no teu .env (substitui a linha ADMIN_PASSWORD_HASH):');
        $this->newLine();
        $this->line("ADMIN_PASSWORD_HASH='" . Hash::make($password) . "'");
        $this->newLine();

        return self::SUCCESS;
    }
}