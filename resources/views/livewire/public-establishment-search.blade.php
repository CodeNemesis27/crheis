<div class="max-w-6xl mx-auto px-4 py-8">
    <header class="mb-6">
        <h1 class="text-2xl font-semibold">NMIS Establishment Compliance Lookup</h1>
        <p class="text-sm text-gray-600 mt-1">
            Search accredited meat establishments and view their inspection, violation, and enforcement history.
            Some case details are restricted and not shown here.
        </p>
    </header>

    <div class="mb-6">
        <input
            type="text"
            wire:model.live.debounce.400ms="search"
            placeholder="Search by business name, registration number, accreditation number, or owner..."
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <div wire:loading wire:target="search" class="text-xs text-gray-400 mt-1">Searching...</div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        {{-- Results list --}}
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-200 rounded-lg divide-y divide-gray-100 overflow-hidden">
                @forelse ($this->results as $item)
                <button
                    type="button"
                    wire:click="select({{ $item->id }})"
                    wire:key="result-{{ $item->id }}"
                    wire:loading.class="opacity-60"
                    wire:target="select({{ $item->id }})"
                    class="w-full text-left px-4 py-3 hover:bg-gray-50 transition {{ $this->selectedId === $item->id ? 'bg-blue-50' : '' }}">
                    <div class="font-medium text-sm">{{ $item->business_name }}</div>
                    <div class="text-xs text-gray-500 mt-0.5">
                        {{ $item->registration_number }} &middot; {{ str_replace('_', ' ', ucfirst($item->establishment_type)) }}
                    </div>
                    <span class="inline-block mt-1 text-[11px] px-2 py-0.5 rounded-full {{ $this->badgeClasses(ucfirst($item->accreditation_status)) }}">
                        {{ ucfirst($item->accreditation_status) }}
                    </span>
                </button>
                @empty
                <div class="px-4 py-6 text-sm text-gray-500 text-center">No establishments match your search.</div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $this->results->links() }}
            </div>
        </div>

        {{-- Detail panel --}}
        <div class="lg:col-span-3">
            <div wire:loading wire:target="select" class="bg-white border border-gray-200 rounded-lg p-8 text-center text-sm text-gray-400">
                Loading establishment details...
            </div>

            <div wire:loading.remove wire:target="select">

                @if (! $this->establishment)
                <div class="bg-white border border-gray-200 rounded-lg p-8 text-center text-sm text-gray-500">
                    Select an establishment from the list to view its full history.
                </div>
                @else
                @php $e = $this->establishment; @endphp

                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-lg font-semibold">{{ $e->business_name }}</h2>
                            @if ($e->trade_name)
                            <p class="text-sm text-gray-500">Trading as {{ $e->trade_name }}</p>
                            @endif
                        </div>
                        <button wire:click="clearSelection" class="text-xs text-gray-400 hover:text-gray-600">Close ✕</button>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-4 text-sm">
                        <div>
                            <div class="text-xs text-gray-400">Type</div>
                            <div>{{ str_replace('_', ' ', ucfirst($e->establishment_type)) }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400">Registration No.</div>
                            <div>{{ $e->registration_number }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400">Accreditation No.</div>
                            <div>{{ $e->accreditation_number ?? '—' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400">Status</div>
                            <span class="inline-block text-[11px] px-2 py-0.5 rounded-full {{ $this->badgeClasses(ucfirst($e->accreditation_status)) }}">
                                {{ ucfirst($e->accreditation_status) }}
                            </span>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400">Owner</div>
                            <div>{{ $e->owner_name }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400">Location</div>
                            <div>{{ collect([$e->city_municipality, $e->province, $e->region])->filter()->implode(', ') ?: '—' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400">Registering Office</div>
                            <div>{{ $e->registeringOffice?->name ?? '—' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400">Accreditation Expiry</div>
                            <div>{{ $e->accreditation_expiry_at?->format('M d, Y') ?? '—' }}</div>
                        </div>
                    </div>
                </div>

                {{-- Inspections --}}
                <div class="mt-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Inspection History ({{ $e->inspections->count() }})</h3>
                    <div class="bg-white border border-gray-200 rounded-lg divide-y divide-gray-100">
                        @forelse ($e->inspections as $inspection)
                        <div class="px-4 py-3 flex items-center justify-between text-sm">
                            <div>
                                <div class="font-medium">{{ $inspection->report_number }}</div>
                                <div class="text-xs text-gray-500">
                                    {{ $inspection->inspection_type }} &middot; {{ $inspection->inspection_date->format('M d, Y') }}
                                    @if ($inspection->inspector) &middot; {{ $inspection->inspector->name }} @endif
                                </div>
                            </div>
                            <span class="text-[11px] px-2 py-0.5 rounded-full {{ $this->badgeClasses($inspection->result) }}">
                                {{ $inspection->result }}
                            </span>
                        </div>
                        @empty
                        <div class="px-4 py-4 text-sm text-gray-400">No inspection records on file.</div>
                        @endforelse
                    </div>
                </div>

                {{-- Violations --}}
                <div class="mt-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Violation History ({{ $e->violations->count() }})</h3>
                    <div class="bg-white border border-gray-200 rounded-lg divide-y divide-gray-100">
                        @forelse ($e->violations as $violation)
                        <div class="px-4 py-3 text-sm">
                            <div class="flex items-center justify-between">
                                <div class="font-medium">{{ $violation->violationType->title }}</div>
                                <div class="flex gap-1.5">
                                    <span class="text-[11px] px-2 py-0.5 rounded-full {{ $this->badgeClasses($violation->severity) }}">{{ $violation->severity }}</span>
                                    <span class="text-[11px] px-2 py-0.5 rounded-full {{ $this->badgeClasses($violation->status) }}">{{ $violation->status }}</span>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mt-0.5">
                                {{ $violation->violation_number }} &middot; Committed {{ $violation->date_committed->format('M d, Y') }}
                            </div>
                        </div>
                        @empty
                        <div class="px-4 py-4 text-sm text-gray-400">No violation records on file.</div>
                        @endforelse
                    </div>
                </div>

                {{-- Enforcement actions --}}
                <div class="mt-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Enforcement Actions ({{ $e->enforcementActions->count() }})</h3>
                    <div class="bg-white border border-gray-200 rounded-lg divide-y divide-gray-100">
                        @forelse ($e->enforcementActions as $action)
                        <div class="px-4 py-3 flex items-center justify-between text-sm">
                            <div>
                                <div class="font-medium">{{ str_replace('_', ' ', ucfirst($action->action_type)) }}</div>
                                <div class="text-xs text-gray-500">{{ $action->action_number }} &middot; Issued {{ $action->issued_at->format('M d, Y') }}</div>
                            </div>
                            <span class="text-[11px] px-2 py-0.5 rounded-full {{ $this->badgeClasses(ucfirst($action->status)) }}">
                                {{ ucfirst($action->status) }}
                            </span>
                        </div>
                        @empty
                        <div class="px-4 py-4 text-sm text-gray-400">No enforcement actions on file.</div>
                        @endforelse
                    </div>
                </div>

                {{-- Due process / cases --}}
                <div class="mt-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Case Status ({{ $e->enforcementCases->count() }})</h3>
                    <div class="bg-white border border-gray-200 rounded-lg divide-y divide-gray-100">
                        @forelse ($e->enforcementCases as $case)
                        <div class="px-4 py-3 text-sm">
                            <div class="flex items-center justify-between">
                                <div class="font-medium">{{ $case->case_number }}</div>
                                <span class="text-[11px] px-2 py-0.5 rounded-full {{ $this->badgeClasses($case->current_status) }}">
                                    {{ $case->current_status }}
                                </span>
                            </div>
                            <div class="text-xs text-gray-500 mt-0.5">Filed {{ $case->filed_at->format('M d, Y') }}</div>

                            @if (! $case->is_confidential)
                            @if ($case->resolution)
                            <p class="text-xs text-gray-600 mt-2">{{ $case->resolution }}</p>
                            @endif
                            @else
                            <p class="text-xs text-gray-400 italic mt-2">Case details restricted.</p>
                            @endif
                        </div>
                        @empty
                        <div class="px-4 py-4 text-sm text-gray-400">No cases on file.</div>
                        @endforelse
                    </div>
                </div>

                {{-- Confiscations --}}
                <div class="mt-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Confiscation / Apprehension History ({{ $e->confiscations->count() }})</h3>
                    <div class="bg-white border border-gray-200 rounded-lg divide-y divide-gray-100">
                        @forelse ($e->confiscations as $confiscation)
                        <div class="px-4 py-3 flex items-center justify-between text-sm">
                            <div>
                                <div class="font-medium">{{ $confiscation->type }} &middot; {{ $confiscation->commodity_type }}</div>
                                <div class="text-xs text-gray-500">{{ $confiscation->confiscation_number }} &middot; {{ $confiscation->date_confiscated->format('M d, Y') }}</div>
                            </div>
                            <span class="text-[11px] px-2 py-0.5 rounded-full {{ $this->badgeClasses($confiscation->disposition) }}">
                                {{ $confiscation->disposition }}
                            </span>
                        </div>
                        @empty
                        <div class="px-4 py-4 text-sm text-gray-400">No confiscation records on file.</div>
                        @endforelse
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>