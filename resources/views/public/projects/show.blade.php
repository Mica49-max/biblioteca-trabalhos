@extends('layouts.public')

@section('title', $project->title . ' · Biblioteca de Trabalhos')

@section('content')
    <a href="{{ route('projects.index') }}" class="back">← Voltar aos projetos</a>

    <header class="project-hero">
        <div class="meta">
            <span class="badge">{{ $project->type->label() }}</span>
            <span class="status status-{{ $project->status->value }}">{{ $project->status->label() }}</span>
        </div>

        <h1>{{ $project->title }}</h1>
    </header>

    <div class="detail-layout">
        <div class="detail-main">
            <section class="panel">
                <h2>Sobre o projeto</h2>
                @if ($project->description)
                    <p class="text">{!! nl2br(e($project->description)) !!}</p>
                @else
                    <p class="muted-small">Sem descrição ainda.</p>
                @endif
            </section>

            <section class="panel">
                <h2>O que aprendi</h2>
                @if ($project->learned)
                    <p class="text">{!! nl2br(e($project->learned)) !!}</p>
                @else
                    <p class="muted-small">Ainda por preencher.</p>
                @endif
            </section>
        </div>

        <aside class="detail-side">
            <section class="panel">
                <h2>Detalhes</h2>
                <dl class="facts">
                    <dt>Tipo</dt>
                    <dd>{{ $project->type->label() }}</dd>

                    <dt>Estado</dt>
                    <dd>{{ $project->status->label() }}</dd>

                    <dt>Início</dt>
                    <dd>{{ $project->started_at?->format('d/m/Y') ?? '—' }}</dd>

                    <dt>Fim</dt>
                    <dd>{{ $project->finished_at?->format('d/m/Y') ?? '—' }}</dd>

                    <dt>Adicionado</dt>
                    <dd>{{ $project->created_at->format('d/m/Y') }}</dd>
                </dl>
            </section>

            <section class="panel">
                <h2>Tecnologias</h2>
                @if ($project->technologies->isNotEmpty())
                    <div class="tags">
                        @foreach ($project->technologies as $technology)
                            <span class="tag">{{ $technology->name }}</span>
                        @endforeach
                    </div>
                @else
                    <p class="muted-small">Não indicadas.</p>
                @endif
            </section>

            <section class="panel">
                <h2>Ligações</h2>

                @if ($project->demo_url || $project->download_url || $project->github_url)
                    <div class="link-buttons">
                        @if ($project->demo_url)
                            <a class="btn" href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer">Ver online ↗</a>
                        @endif
                        @if ($project->download_url)
                            <a class="btn" href="{{ $project->download_url }}" target="_blank" rel="noopener noreferrer">Descarregar ↗</a>
                        @endif
                        @if ($project->github_url)
                            <a class="btn btn-outline" href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer">Código no GitHub ↗</a>
                        @endif
                    </div>
                @else
                    <p class="muted-small">Sem ligações disponíveis.</p>
                @endif
            </section>
        </aside>
    </div>
@endsection