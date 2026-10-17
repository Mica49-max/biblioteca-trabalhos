<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $php = Technology::firstOrCreate(['name' => 'PHP']);
        $laravel = Technology::firstOrCreate(['name' => 'Laravel']);
        $js = Technology::firstOrCreate(['name' => 'JavaScript']);
        $sqlite = Technology::firstOrCreate(['name' => 'SQLite']);

        $biblioteca = Project::updateOrCreate(
            ['title' => 'Biblioteca de Trabalhos'],
            [
                'description' => "A minha biblioteca pessoal de projetos.\nGuarda sites, programas e experiências, com filtros por tipo e tecnologia, e tem uma área privada para gerir tudo.",
                'type' => 'site',
                'status' => 'in_progress',
                'started_at' => '2026-10-16',
                'github_url' => 'https://github.com/Mica49-max/biblioteca-trabalhos',
                'demo_url' => 'https://example.com',
                'download_url' => 'https://example.com/download',
                'learned' => "Como organizar um projeto em Laravel: migrations, modelos, controllers e páginas Blade.\nComo ligar tabelas com relações muitos-para-muitos.",
            ]
        );
        $biblioteca->technologies()->syncWithoutDetaching([$php->id, $laravel->id, $sqlite->id]);

        $galo = Project::updateOrCreate(
            ['title' => 'Jogo do Galo'],
            [
                'description' => 'Um pequeno jogo feito para praticar JavaScript.',
                'type' => 'test',
                'status' => 'done',
                'started_at' => '2026-09-01',
                'finished_at' => '2026-09-03',
            ]
        );
        $galo->technologies()->syncWithoutDetaching([$js->id]);

        Project::updateOrCreate(
            ['title' => 'Projeto secreto'],
            [
                'type' => 'test',
                'status' => 'idea',
                'is_public' => false,
            ]
        );
    }
}