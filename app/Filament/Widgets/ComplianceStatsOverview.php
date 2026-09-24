<?php

namespace App\Filament\Widgets;

use App\Models\Confiscation;
use App\Models\EnforcementCase;
use App\Models\MeatEstablishment;
use App\Models\MtvOperator;
use App\Models\MtvVehicle;
use App\Models\Violation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Number;

class ComplianceStatsOverview extends BaseWidget
{
    protected ?string $pollingInterval = '60s';

    public function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
        $data = $this->data();

        return [
            Stat::make('Active Regulated Entities', Number::format($data['active_total']))
                ->description("Baseline under NMIS's active oversight")
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('success'),

            Stat::make('Open Violations', Number::format($data['violations_open_total']))
                ->description("Current enforcement workload")
                ->descriptionIcon($data['violations_open'] > 0 ? 'heroicon-m-exclamation-triangle' : 'heroicon-m-check-circle')
                ->color($data['violations_open'] > 0 ? 'danger' : ($data['violations_investigating'] > 0 ? 'warning' : 'success')),

            Stat::make('Pending Enforcement Cases', Number::format($data['cases_pending_total']))
                ->description('Due-process backlog')
                ->descriptionIcon('heroicon-m-scale')
                ->color(($data['oldest_pending_days'] ?? 0) > 30 ? 'danger' : 'warning'),

            Stat::make('Accreditations Expiring Soon', Number::format($data['expiring_total']))
                ->description("Renewals before they lapse into Expired")
                ->descriptionIcon('heroicon-m-clock')
                ->color($data['expiring_total'] > 0 ? 'warning' : 'success'),

            Stat::make('Confiscations Pending Disposition', Number::format($data['confiscations_pending']))
                ->description('Physical evidence still sitting unresolved')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color($data['confiscations_pending'] > 0 ? 'warning' : 'success'),

            Stat::make('Cases Under Appeal', Number::format($data['cases_under_appeal']))
                ->description("Out of {$data['cases_total']} total cases on record")
                ->descriptionIcon('heroicon-m-flag')
                ->color($data['cases_under_appeal'] > 0 ? 'warning' : 'success'),
        ];
    }

    /**
     * All raw numbers computed here, cached for 2 minutes. This dashboard is
     * viewed by every logged-in staff member and polls every 60 seconds, so
     * caching avoids re-running ~20 aggregate queries across five tables on
     * every single poll from every open session.
     */
    private function data(): array
    {
        return Cache::remember('dashboard:compliance-stats', now()->addMinutes(2), function () {
            $now = now();
            $expiryWindow = now()->addDays(30);

            $activeEstablishments = MeatEstablishment::where('accreditation_status', 'active')->count();
            $activeOperators = MtvOperator::where('accreditation_status', 'active')->count();
            $activeVehicles = MtvVehicle::where('permit_status', 'Active')->count();

            $violationsOpen = Violation::where('status', 'Open')->count();
            $violationsInvestigating = Violation::where('status', 'Under Investigation')->count();

            $violationsTrend = collect(range(5, 0))
                ->map(fn($monthsAgo) => Violation::whereBetween('date_reported', [
                    now()->subMonths($monthsAgo)->startOfMonth(),
                    now()->subMonths($monthsAgo)->endOfMonth(),
                ])->count())
                ->toArray();

            $casesPending = EnforcementCase::where('current_status', 'Pending')->count();
            $casesUnderReview = EnforcementCase::where('current_status', 'Under Review')->count();
            $oldestPending = EnforcementCase::whereIn('current_status', ['Pending', 'Under Review'])->min('filed_at');

            $expiringEstablishments = MeatEstablishment::whereBetween('accreditation_expiry_at', [$now, $expiryWindow])->count();
            $expiringOperators = MtvOperator::whereBetween('accreditation_expiry_at', [$now, $expiryWindow])->count();
            $expiringVehicles = MtvVehicle::whereBetween('permit_expiry_at', [$now, $expiryWindow])->count();

            return [
                'active_establishments' => $activeEstablishments,
                'active_operators' => $activeOperators,
                'active_vehicles' => $activeVehicles,
                'active_total' => $activeEstablishments + $activeOperators + $activeVehicles,

                'violations_open' => $violationsOpen,
                'violations_investigating' => $violationsInvestigating,
                'violations_open_total' => $violationsOpen + $violationsInvestigating,
                'violations_trend' => $violationsTrend,

                'cases_pending' => $casesPending,
                'cases_under_review' => $casesUnderReview,
                'cases_pending_total' => $casesPending + $casesUnderReview,
                'oldest_pending_days' => $oldestPending ? $now->diffInDays(Carbon::parse($oldestPending)) : null,
                'cases_under_appeal' => EnforcementCase::where('current_status', 'Under Appeal')->count(),
                'cases_total' => EnforcementCase::count(),

                'expiring_establishments' => $expiringEstablishments,
                'expiring_operators' => $expiringOperators,
                'expiring_vehicles' => $expiringVehicles,
                'expiring_total' => $expiringEstablishments + $expiringOperators + $expiringVehicles,

                'confiscations_pending' => Confiscation::where('disposition', 'Pending')->count(),
                'confiscations_pending_value' => Confiscation::where('disposition', 'Pending')->sum('estimated_value') ?? 0,
            ];
        });
    }
}
