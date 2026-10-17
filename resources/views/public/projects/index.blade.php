@extends('layouts.public')

@section('content')
    @php
        $hasFilters = request('q') || count($selectedTypes) || count($selectedTechnologies);
    @endphp

    <div class="page-head">
        <h1>Os meus projetos</h1>
        <p class="lead">Sites, programas e experiências que fui construindo.</p>
    </div>

    <div class="layout">
        <aside class="sidebar">
            <form method="GET" action="{{ route('projects.index') }}" id="filters" class="filters">
                <div class="filter-block">
                    <label for="q" class="filter-title">Pesquisar</label>
                    <input type="search" id="q" name="q" value="{{ request('q') }}" placeholder="Nome ou descrição...">
                </div>

                <fieldset class="filter-block">
                    <legend class="filter-title">Tipo</legend>
                    @foreach ($types as $type)
                        <label class="check">
                            <input type="checkbox" name="type[]" value="{{ $type->value }}"
                                   @checked(in_array($type->value, $selectedTypes))>
                            <span>{{ $type->label() }}</span>
                        </label>
                    @endforeach
                </fieldset>

                <fieldset class="filter-block">
                    <legend class="filter-title">Tecnologia</legend>
                    @forelse ($technologies as $technology)
                        <label class="check">
                            <input type="checkbox" name="technology[]" value="{{ $technology->slug }}"
                                   @checked(in_array($technology->slug, $selectedTechnologies))>
                            <span>{{ $technology->name }}</span>
                        </label>
                    @empty
                        <p class="muted-small">Ainda sem tecnologias.</p>
                    @endforelse
                </fieldset>

                <button type="submit" class="btn btn-block">Aplicar filtros</button>

                @if ($hasFilters)
                    <a href="{{ route('projects.index') }}" class="btn-clear">✕ Limpar filtros</a>
                @endif
            </form>
        </aside>

        <section class="results">
            <p class="count">
                {{ $projects->count() }} {{ $projects->count() === 1 ? 'projeto' : 'projetos' }}
            </p>

            @if ($projects->isEmpty())
                <p class="empty">Nenhum projeto encontrado com estes filtros.</p>
            @else
                <div class="grid">
                    @foreach ($projects as $project)
                        <article class="card">
                            <div class="meta">
                                <span class="badge">{{ $project->type->label() }}</span>
                                <span class="status status-{{ $project->status->value }}">{{ $project->status->label() }}</span>
                            </div>

                            <h2>
                                <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                            </h2>

                            <p>{{ \Illuminate\Support\Str::limit($project->description, 140) }}</p>

                            <div class="tags">
                                @foreach ($project->technologies as $technology)
                                    <span class="tag">{{ $technology->name }}</span>
                                @endforeach
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    </div>

    <script>
        document.querySelectorAll('#filters input[type="checkbox"]').forEach(function (box) {
            box.addEventListener('change', function () { box.form.submit(); });
        });
    </script>
@endsection