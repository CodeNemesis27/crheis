<?php

namespace App\Livewire;

use App\Models\MeatEstablishment;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.public')]
class PublicEstablishmentSearch extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public ?int $selectedId = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
        $this->selectedId = null;
    }

    public function select(int $id): void
    {
        $this->selectedId = $id;
    }

    public function clearSelection(): void
    {
        $this->selectedId = null;
    }

    #[Computed]
    public function results()
    {
        $query = MeatEstablishment::query()->orderBy('business_name');

        if ($this->search !== '') {
            $term = $this->search;

            $query->where(function ($q) use ($term) {
                $q->where('business_name', 'like', "%{$term}%")
                    ->orWhere('trade_name', 'like', "%{$term}%")
                    ->orWhere('registration_number', 'like', "%{$term}%")
                    ->orWhere('accreditation_number', 'like', "%{$term}%")
                    ->orWhere('owner_name', 'like', "%{$term}%");
            });
        }

        return $query->paginate(10);
    }

    #[Computed]
    public function establishment(): ?MeatEstablishment
    {
        if (! $this->selectedId) {
            return null;
        }

        return Cache::remember(
            "public-lookup:establishment:{$this->selectedId}",
            now()->addMinutes(10),
            fn() => MeatEstablishment::query()
                ->with([
                    'registeringOffice',
                    'inspections' => fn($q) => $q->latest('inspection_date'),
                    'inspections.inspector',
                    'violations' => fn($q) => $q->latest('date_reported'),
                    'violations.violationType',
                    'enforcementActions' => fn($q) => $q->latest('issued_at'),
                    'enforcementActions.issuedBy',
                    'enforcementCases' => fn($q) => $q->latest('filed_at'),
                    'enforcementCases.assignedOfficer',
                    'confiscations' => fn($q) => $q->latest('date_confiscated'),
                    'confiscations.apprehendingOfficer',
                ])
                ->find($this->selectedId)
        );
    }

    /**
     * Shared status-to-color mapping so every badge on this page — across
     * five different enums — looks consistent without repeating match()
     * blocks in the view.
     */
    public function badgeClasses(?string $value): string
    {
        return match ($value) {
            'Active', 'Passed', 'Resolved', 'Completed', 'Donated', 'Forfeited' => 'bg-green-100 text-green-800',
            'Pending', 'Minor', 'Closed' => 'bg-gray-100 text-gray-700',
            'Under Review' => 'bg-blue-100 text-blue-800',
            'Suspended', 'Expired', 'Passed With Findings', 'Under Investigation', 'Under Appeal', 'Major', 'Sold' => 'bg-amber-100 text-amber-800',
            'Revoked', 'Failed', 'Open', 'Critical', 'Destroyed', 'Dismissed' => 'bg-red-100 text-red-800',
            'Released' => 'bg-sky-100 text-sky-800',
            default => 'bg-gray-100 text-gray-700',
        };
    }

    public function render()
    {
        return view('livewire.public-establishment-search');
    }
}
