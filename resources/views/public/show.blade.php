@extends('layouts.public')

@section('title', $project->title . ' · Biblioteca de Trabalhos')

@section('content')
    <a href="{{ route('projects.index') }}" class="back">← Voltar à lista</a>

    <h1>{{ $project->title }}</h1>

    <div class="meta">
        <span class="badge">{{ $project->type->label() }}</span>
        <span class="badge badge-status">{{ $project->status->label() }}</span>
    </div>

    @if ($project->description)
        <p class="description">{!! nl2br(e($project->description)) !!}</p>
    @endif

    <div class="actions">
        @if ($project->github_url)
            <a class="btn" href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer">Ver no GitHub</a>
        @endif
        @if ($project->demo_url)
            <a class="btn" href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer">Ver online</a>
        @endif
        @if ($project->download_url)
            <a class="btn" href="{{ $project->download_url }}" target="_blank" rel="noopener noreferrer">Descarregar</a>
        @endif
    </div>

    @if ($project->started_at || $project->finished_at)
        <p class="dates">
            @if ($project->started_at) Início: {{ $project->started_at->format('d/m/Y') }} @endif
            @if ($project->finished_at) · Fim: {{ $project->finished_at->format('d/m/Y') }} @endif
        </p>
    @endif

    @if ($project->technologies->isNotEmpty())
        <h2>Tecnologias</h2>
        <div class="tags">
            @foreach ($project->technologies as $technology)
                <span class="tag">{{ $technology->name }}</span>
            @endforeach
        </div>
    @endif

    @if ($project->learned)
        <h2>O que aprendi</h2>
        <p>{!! nl2br(e($project->learned)) !!}</p>
    @endif
@endsection