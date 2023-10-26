<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models;

class StatsOverview extends BaseWidget
{
    protected static bool $isLazy = true;

    //protected static ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        return [
            Stat::make(
                'Total Voters',
                Models\Voter::count(),
            )
            ->color('success'),
            Stat::make(
                'Total Positions',
                Models\Category::count(),
            )
            ->color('success'),
            Stat::make(
                'Total Nominees',
                Models\Nominee::count(),
            )
            ->color('success'),
            Stat::make(
                'Members Voted',
                Models\Vote::select('user_id')->distinct()->get()->count(),
            )
            ->color('success'),
        ];
    }
}
