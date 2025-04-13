<x-app-layout>
    <x-slot name="header">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb"
            class="d-flex justify-content-between align-items-center text-sm">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('personnel.index') }}">Personnel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Views</li>
            </ol>
        </nav>
        <h2 class="pt-3 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Résultat de recherche') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="card">
                <div class="card-header">
                    @include('personnel.profile.partials.templates.profile-search-nav')
                </div>

                <div class="card-body p-0">
                    @if ($results->isEmpty())
                        <div class="alert alert-info m-0">Aucun profil trouvé.</div>
                    @else

                    @php
                        $displayColumns = [
                            'service_entry_date' => request()->filled('service_entry_date_before') && request()->filled('service_entry_date_after'),
                            'diplomes_academiques' => request()->filled('academic_diploma'),
                            'diplomes_militaires' => request()->filled('military_diploma'),
                            'distinctions_honorifiques' => request()->filled('honorary_title'),
                            'campagnes_militaires' => request()->filled('campaign_title')
                        ];
                    @endphp
                        <table class="table table-striped table-hover table-sm text-sm align-middle mb-0">
                            <thead>
                                <tr class="align-middle">
                                    <th><input class="form-check-input ms-1 mb-1" type="checkbox"></th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        NR</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Grade</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nom et prénoms</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Matricule</th>
                                    @if($displayColumns['service_entry_date'])
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'entrée en service</th>
                                    @endif
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Unité</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fonction</th>

                                    @if($displayColumns['diplomes_academiques'])
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diplômes civils</th>
                                    @endif
                                    @if($displayColumns['diplomes_militaires'])
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diplômes militaires</th>
                                    @endif
                                    @if($displayColumns['distinctions_honorifiques'])
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Distinctions honorifiques</th>
                                    @endif
                                    @if($displayColumns['campagnes_militaires'])
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campagnes militaires</th>
                                    @endif

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Modifié le</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    <tr>
                                        <td><input class="form-check-input ms-1 mb-1" type="checkbox"></td>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                            {!! highlight($result->rank_abbreviate ?? '', request('search') ?? request('rank_abbreviate')) !!}
                                        </td>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                            {!! highlight(($result->name . ' ' . $result->firstname) ?? '', request('search')) !!}
                                        </td>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                            {!! highlight($result->military_registration_number ?? '', request('search')) !!}
                                        </td>
                                        @if($displayColumns['service_entry_date'])
                                            <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                                {{ $result->service_entry_date ? optional(Carbon\Carbon::parse($result->service_entry_date))->format('d/m/Y') : 'Non spécifié' }}
                                            </td>
                                        @endif
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                            {!! highlight($result->unit_abbreviate ?? '', request('search') ?? request('unit_abbreviate')) !!}
                                        </td>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                            {!! highlight($result->current_function ?? '', request('search')) !!}
                                        </td>

                                        @if($displayColumns['diplomes_academiques'])
                                            <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                                {!! highlight($result->academicPaths->pluck('diploma')->join(', ') ?? 'Aucun diplôme', request('academic_diploma')) !!}
                                            </td>
                                        @endif
                                        @if($displayColumns['diplomes_militaires'])
                                            <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                                {!! highlight($result->militaryPaths->pluck('academy_diploma')->join(', ') ?? 'Aucun diplôme', request('military_diploma')) !!}
                                            </td>
                                        @endif
                                        @if($displayColumns['distinctions_honorifiques'])
                                            <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                                {!! highlight($result->honoraryDistinctions->pluck('honorary_title')->join(', ') ?? 'Aucune distinction', request('honorary_title')) !!}
                                            </td>
                                        @endif
                                        @if($displayColumns['campagnes_militaires'])
                                            <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                                {!! highlight($result->militaryCampaigns->pluck('campaign_title')->join(', ') ?? 'Aucune campagne', request('campaign_title')) !!}
                                            </td>
                                        @endif

                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                            {{ $result->profile_updated_at ? optional(Carbon\Carbon::parse($result->profile_updated_at))->format('d/m/Y H:i:s') : 'Non spécifié' }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn" type="button"
                                                    id="profileMenuDropdown{{ $result->id }}"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="border: none; background: transparent;">
                                                    <i class="fas fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-lg-end"
                                                    aria-labelledby="profileMenuDropdown{{ $result->id }}">
                                                    <li>
                                                        <a href="{{ route('personnel.show', $result->id) }}"
                                                            class="dropdown-item">Afficher</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('personnel.destroy', $result->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {!! highlight($result->name . ' ' . $result->firstname }} ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="dropdown-item">Supprimer</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($results->total() > $perPage)
                            <div class="p-3">
                                {{ $results->appends(request()->query())->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('personnel.create') }}"
        class="btn btn-primary position-fixed bottom-3 end-3 rounded-circle shadow d-flex align-items-center justify-content-center" title="Ajouter nouveau"
        style="width: 46px; height: 46px;">
            <i class="fas fa-user-plus"></i>
    </a>
</x-app-layout>
