<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ComplianceStatsOverview;
use App\Filament\Widgets\EnforcementCaseStatusChart;
use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;

class AnalyticsOverview extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel = 'Analytics Overview';

    protected static ?string $title = 'Analytics Overview';

    public function getWidgets(): array
    {
        return [
            ComplianceStatsOverview::class,
            EnforcementCaseStatusChart::class,

        ];
    }
}
