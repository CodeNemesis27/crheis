<?php

namespace App\Filament\Widgets;

use App\Models\EnforcementCase;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class EnforcementCaseStatusChart extends ChartWidget
{
    protected ?string $heading = 'Enforcement Case Status Distribution';

    // protected int|string|array $columnSpan = 'full';

    protected ?string $maxHeight = '300px';

    private const STATUSES = [
        'Pending' => '#9CA3AF',
        'Under Review' => '#3B82F6',
        'Resolved' => '#22C55E',
        'Under Appeal' => '#F59E0B',
        'Dismissed' => '#8B5CF6',
        'Completed' => '#14B8A6',
    ];

    protected function getFilters(): ?array
    {
        return [
            'all' => 'All time',
            'year' => 'This year',
            'month' => 'This month',
        ];
    }

    protected function getData(): array
    {
        // $this->filter is set from user input via the dropdown, so it is
        // validated through this match expression (safe default: 'all')
        // rather than used to build a query directly.
        $startDate = match ($this->filter) {
            'year' => now()->startOfYear(),
            'month' => now()->startOfMonth(),
            default => null,
        };

        $counts = EnforcementCase::query()
            ->when($startDate, fn($query) => $query->where('filed_at', '>=', $startDate))
            ->select('current_status', DB::raw('count(*) as aggregate'))
            ->groupBy('current_status')
            ->pluck('aggregate', 'current_status');

        return [
            'datasets' => [
                [
                    'label' => 'Cases',
                    'data' => collect(self::STATUSES)->keys()
                        ->map(fn($status) => $counts->get($status, 0))
                        ->toArray(),
                    'backgroundColor' => array_values(self::STATUSES),
                ],
            ],
            'labels' => array_keys(self::STATUSES),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
