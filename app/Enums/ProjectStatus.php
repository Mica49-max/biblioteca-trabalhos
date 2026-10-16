<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Idea = 'idea';
    case InProgress = 'in_progress';
    case Done = 'done';
    case Abandoned = 'abandoned';

    public function label(): string
    {
        return match ($this) {
            self::Idea => 'Ideia',
            self::InProgress => 'Em curso',
            self::Done => 'Concluído',
            self::Abandoned => 'Abandonado',
        };
    }
}