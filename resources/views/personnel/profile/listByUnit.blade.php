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
            {{ __('Liste par unite') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 pb-5">
        <div class="card">
            <div class="card-header">
                @include('personnel.profile.partials.templates.profile-search-nav')
            </div>

            <div class="card-body p-0">
                <div class="accordion accordion-flush" id="accordionList">
                    @forelse ($units as $key => $unit)
                        @php
                            $unitProfiles = $profilesByUnit[$unit->id] ?? collect();
                        @endphp
                        <div class="accordion-item">
                            <h2 class="accordion-header d-flex" id="heading_{{ $key }}">
                                <button class="accordion-button {{ $expand ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $key }}" aria-expanded="false"
                                    aria-controls="collapse{{ $key }}">
                                    {{ $unit->unit_abbreviate ?? 'Non spécifié' }}
                                    <span class="badge {{ $unitProfiles->count()>0 ? ' bg-primary' : ' bg-secondary' }} ms-1">{{$unitProfiles->count()}}</span>
                                </button>
                            </h2>
                            <div id="collapse{{ $key }}" class="accordion-collapse collapse {{ $expand ? '' : 'show' }}"
                                aria-labelledby="heading_{{ $key }}" data-bs-parent="#accordionList">
                                <div class="accordion-body p-0">
                                    @if ($unitProfiles->isNotEmpty())
                                        <table
                                            class="table table-striped table-hover table-sm text-sm align-middle mb-0">
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
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Fonction</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Modifié le</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($unitProfiles as $profile)
                                                    <tr>
                                                        <td><input class="form-check-input ms-1 mb-1" type="checkbox">
                                                        </td>
                                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $loop->iteration }}</td>
                                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $profile->rank_abbreviate }}</td>
                                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $profile->name . ' ' . $profile->firstname }}</td>
                                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $profile->military_registration_number }}</td>
                                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $profile->current_function }}</td>
                                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $profile->profile_updated_at ? optional(Carbon\Carbon::parse($profile->profile_updated_at))->format('d/m/Y H:i:s') : 'Non spécifié' }}
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn" type="button"
                                                                    id="profileMenuDropdown{{ $profile->id }}"
                                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                                    style="border: none; background: transparent;">
                                                                    <i class="fas fa-ellipsis-vertical"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-lg-end"
                                                                    aria-labelledby="profileMenuDropdown{{ $profile->id }}">
                                                                    <li>
                                                                        <a href="{{ route('personnel.show', $profile->id) }}"
                                                                            class="dropdown-item">Afficher</a>
                                                                    </li>
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('personnel.destroy', $profile->id) }}"
                                                                            method="POST" class="d-inline"
                                                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ $profile->name . ' ' . $profile->firstname }} ?')">
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
                                    @else
                                        <div class="p-3 text-center text-gray-500">
                                            Pas de personnel dans cette unité.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">Aucune unité trouvée.</div>
                    @endforelse
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
