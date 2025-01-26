<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion du personnel') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <nav class="d-flex justify-content-between align-items-center" aria-label="breadcrumb"
                style="--bs-breadcrumb-divider: '>';">
                <ol class="breadcrumb mb-0 text-sm">
                    <li class="breadcrumb-item"><a href="{{ route('personnel.index') }}">Base de données</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('personnel.list') }}">Liste du personnel</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Informations du profil
                    </li>
                </ol>
            </nav>

            <!-- Fenêtre modale -->
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('personnel.search')}}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="searchModalLabel">Recherche personnalisée</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <!-- Critères -->
                                    <!-- Rang -->
                                    <div class="col-md-6">
                                        <label for="rank_id_search" class="form-label">Grade</label>
                                        <select id="rank_id_search" name="rank_id_search" class="form-control">
                                            <option value="">Choisir à la selection</option>
                                            @foreach($selectRanks as $rank)
                                                <option value="{{ $rank->id }}" title="{{ $rank->rank_abbreviate }}" >{{ $rank->rank_abbreviate }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Unité -->
                                    <div class="col-md-6">
                                        <label for="unit_id_search" class="form-label">Unité</label>
                                        <select id="unit_id_search" name="unit_id_search" class="form-control">
                                            <option value="">Choisir à la selection</option>
                                            @foreach($selectUnits as $unit)
                                                <option value="{{ $unit->id }}" title="{{ $unit->unit_abbreviate }}" >{{ $unit->unit_abbreviate }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Date d'entrée en service -->
                                    <div class="col-md-6">
                                        <label for="service_entry_date_start" class="form-label">Date d'entrée en service (Début)</label>
                                        <input type="date" id="service_entry_date_start" name="service_entry_date_start" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="service_entry_date_end" class="form-label">Date d'entrée en service (Fin)</label>
                                        <input type="date" id="service_entry_date_end" name="service_entry_date_end" class="form-control">
                                    </div>

                                    <!-- Diplômes académiques -->
                                    <div class="col-md-6">
                                        <label for="academic_diploma_search" class="form-label">Diplômes académiques</label>
                                        <input type="text" id="academic_diploma_search" name="academic_diploma_search" class="form-control" placeholder="Ex: Bacc, Licence, Master ...">
                                    </div>

                                    <!-- Diplômes militaires -->
                                    <div class="col-md-6">
                                        <label for="military_diploma_search" class="form-label">Diplômes militaires</label>
                                        <input type="text" id="military_diploma_search" name="military_diploma_search" class="form-control" placeholder="Ex: BE, BAT, EMS1 ...">
                                    </div>

                                    <!-- Distinctions honorifiques -->
                                    <div class="col-md-6">
                                        <label for="honorary_title_search" class="form-label">Distinctions honorifiques</label>
                                        <input type="text" id="honorary_title_search" name="honorary_title_search" class="form-control" placeholder="Ex: CHOMM, OFOMM, CHONM ...">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary" >Rechercher</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contenu -->
            <div class="p-4 sm:p-8 bg-white">
                <div class="container">
                    <div class="row g-3">
                        <!-- Photo et Nom -->
                        <div class="d-flex justify-content-between align-items-center bg-light bg-gradient">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center overflow-hidden"
                                    style="width: 100px; height: 100px; font-size: 36px; font-weight: bold; flex-shrink: 0;">
                                    {{-- @if ($profile->photo)
                                        <img src="{{ $profile->photo }}" alt="Photo de profil" class="img-fluid w-100 h-100">
                                    @else --}}
                                    {{ strtoupper(substr($profile->name, 0, 1)) }}{{ strtoupper(substr($profile->firstname, 0, 1)) }}
                                    {{-- @endif --}}
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-1">{{ $profile->name }} {{ $profile->firstname }}</h5>
                                    <p class="text-muted mb-0">{{ $profileRank->rank_name }}</p>
                                </div>
                            </div>
                            @if(auth()->user()->profile_id !== $profile->id)
                                <div>
                                    <ul>
                                        <li class="mb-2">
                                            <a href="{{ route('personnel.create', ['recipient' => $profile->id]) }}"
                                                class="btn btn-sm btn-light d-flex align-items-center">
                                                <i class="fas fa-envelope me-2"></i> Envoyer message
                                            </a>
                                        </li>

                                        <li>
                                            <form action="{{ route('personnel.destroy', $profile->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce détail ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Supprimer"
                                                    class="btn btn-sm btn-danger w-100">Supprimer</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- Navigation -->
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-rens-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-rens" type="button" role="tab" aria-controls="nav-rens"
                                    aria-selected="true">Informations</button>
                                <button class="nav-link" id="nav-perm-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-perm" type="button" role="tab" aria-controls="nav-perm"
                                    aria-selected="false">Congés et permissions</button>
                                <button class="nav-link" id="nav-role-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-role" type="button" role="tab" aria-controls="nav-role"
                                    aria-selected="false">Paramètres</button>
                                <button class="nav-link" id="nav-service-status-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-service-status" type="button" role="tab" aria-controls="nav-service-status"
                                    aria-selected="false">Décompte</button>
                            </div>
                        </nav>

                        <!-- Contents -->
                        <div class="tab-content" id="nav-tabContent">

                            <!-- Renseignements -->
                            <div class="tab-pane fade show active" id="nav-rens" role="tabpanel"
                                aria-labelledby="nav-rens-tab">
                                <div class="d-flex align-items-start">
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <button class="nav-link btn-sm text-start {{ $tab == 'personnal_information' ? 'active' : '' }}" id="v-pills-civil-status-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-civil-status" type="button"
                                            role="tab" aria-controls="v-pills-civil-status"
                                            aria-selected="true">Etat civil</button>
                                        <button class="nav-link text-start btn-sm {{ $tab == 'military_detail' ? 'active' : '' }}" id="v-pills-military-status-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-military-status"
                                            type="button" role="tab" aria-controls="v-pills-military-status"
                                            aria-selected="false">Renseignements militaires</button>
                                        <button class="nav-link text-start btn-sm {{ $tab == 'spouse_details' ? 'active' : '' }}" id="v-pills-spouse-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-spouse" type="button"
                                            role="tab" aria-controls="v-pills-spouse"
                                            aria-selected="false">Conjoint(e)</button>
                                        <button class="nav-link text-start btn-sm {{ $tab == 'children_details' ? 'active' : '' }}" id="v-pills-children-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-children" type="button"
                                            role="tab" aria-controls="v-pills-children"
                                            aria-selected="false">Enfant(s)</button>
                                        <button class="nav-link text-start btn-sm {{ $tab == 'academic_paths' ? 'active' : '' }}" id="v-pills-education-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-education" type="button"
                                            role="tab" aria-controls="v-pills-education"
                                            aria-selected="false">Parcours académique</button>
                                        <button class="nav-link text-start btn-sm {{ $tab == 'military_paths' ? 'active' : '' }}" id="v-pills-military-path-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-military-path"
                                            type="button" role="tab" aria-controls="v-pills-military-path"
                                            aria-selected="false">Parcours militaire</button>
                                        <button class="nav-link text-start btn-sm {{ $tab == 'professional_careers' ? 'active' : '' }}" id="v-pills-professional-path-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-professional-path"
                                            type="button" role="tab" aria-controls="v-pills-professional-path"
                                            aria-selected="false">Parcours professionnel</button>
                                        <button class="nav-link text-start btn-sm {{ $tab == 'rank_histories' ? 'active' : '' }}" id="v-pills-rank-history-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-rank-history"
                                            type="button" role="tab" aria-controls="v-pills-rank-history"
                                            aria-selected="false">Grades successifs</button>
                                        <button class="nav-link text-start btn-sm {{ $tab == 'honorary_distinctions' ? 'active' : '' }}" id="v-pills-aware-history-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-aware-history"
                                            type="button" role="tab" aria-controls="v-pills-aware-history"
                                            aria-selected="false">Décorations successives</button>
                                        <button class="nav-link text-start btn-sm {{ $tab == 'campaign_histories' ? 'active' : '' }}" id="v-pills-campaign-history-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-campaign-history"
                                            type="button" role="tab" aria-controls="v-pills-campaign-history"
                                            aria-selected="false">Campagnes militaires</button>
                                    </div>
                                    <div class="tab-content w-100" id="v-pills-tabContent">

                                        <!-- Etat civil -->
                                        @include('personnel.profile.partials.templates.civil-modal')
                                        <div class="tab-pane fade {{ $tab == 'personnal_information' ? 'show active' : '' }}" id="v-pills-civil-status" role="tabpanel"
                                            aria-labelledby="v-pills-civil-status-tab">
                                            <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Etat civil') }}</h3>
                                                    <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#civilModal"
                                                        data-action="{{ route('personnel.update', ['id' => $profile->id]) }}"
                                                        data-method="PUT"
                                                        data-title="Modification d'état civil"
                                                        data-name="{{ $profile->name }}"
                                                        data-firstname="{{ $profile->firstname }}"
                                                        data-birth_date="{{ optional($profile->birth_date)->format('Y-m-d') }}"
                                                        data-birth_place="{{ $profile->birth_place }}"
                                                        data-gender="{{ $profile->gender }}"
                                                        data-national_id="{{ $profile->national_id }}"
                                                        data-last_national_id="{{ $profile->national_id }}"
                                                        data-issue_date="{{ optional($profile->issue_date)->format('Y-m-d') }}"
                                                        data-issue_place="{{ $profile->issue_place }}"
                                                        data-duplicate_date="{{ optional($profile->duplicate_date)->format('Y-m-d') }}"
                                                        data-duplicate_place="{{ $profile->duplicate_place }}"
                                                        data-address="{{ $profile->address }}"
                                                        data-phone="{{ $profile->phone }}"
                                                        data-email="{{ $profile->email }}"
                                                        data-blood_group="{{ $profile->blood_group }}"
                                                        data-size="{{ $profile->size }}"
                                                        data-father_name="{{ $profile->father_name }}"
                                                        data-mother_name="{{ $profile->mother_name }}"
                                                        data-marital_status="{{ $profile->marital_status }}"
                                                        data-fallback_address="{{ $profile->fallback_address }}"
                                                        data-driver_license="{{ $profile->driver_license }}"
                                                        data-practiced_sport="{{ $profile->practiced_sport }}"
                                                        data-hobbies="{{ $profile->hobbies }}">
                                                        Modifier
                                                    </button>
                                                </div>
                                                <hr class="my-3">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Nom') }}
                                                            </p>
                                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->name ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Prénoms') }}
                                                            </p>
                                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->firstname ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Date de naissance') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ optional($profile->birth_date)->format('d/m/Y') ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Lieu de naissance') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->birth_place ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Genre') }}
                                                            </p>
                                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->gender ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Carte d\'identité nationale') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->national_id ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Date de délivrance') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ optional($profile->issue_date)->format('d/m/Y') ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Lieu de délivrance') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->issue_place ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Date de duplicata') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ optional($profile->duplicate_date)->format('d/m/Y') ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Lieu de duplicata') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->duplicate_place ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Adresse actuelle') }}
                                                            </p>
                                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->address ?? '-' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Contact téléphonique') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->phone ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Adresse email') }}
                                                            </p>
                                                            <p class="mt-1 text-sm text-primary">
                                                                <a href="mailto:{{ $profile->email }}"
                                                                    class="underline">{{ $profile->email ?? '-' }}</a>
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Groupe sanguin') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->blood_group ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Taille (en cm)') }}
                                                            </p>
                                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->size ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Nom du père') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->father_name ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Nom de la mère') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->mother_name ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Situation matrimoniale') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->marital_status ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Adresse de repli') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->fallback_address ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Permis de conduire') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->driver_license ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Sports pratiqués') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->practiced_sport ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Centres d\'intérêts') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->hobbies ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Renseignements militaires -->
                                        @include('personnel.profile.partials.templates.military-modal')
                                        <div class="tab-pane fade {{ $tab == 'military_detail' ? 'show active' : '' }}" id="v-pills-military-status" role="tabpanel"
                                            aria-labelledby="v-pills-military-status-tab">
                                            <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Renseignements militaires') }}</h3>
                                                    <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#militaryModal"
                                                        data-action="{{ route('military_details.update', ['profile' => $profile->id, 'id' => $profile->militaryDetail->id]) }}"
                                                        data-method="PUT"
                                                        data-title="Modification de renseignements militaires"
                                                        data-army="{{ $profile->militaryDetail->army }}"
                                                        data-position="{{ $profile->militaryDetail->position }}"
                                                        data-position_date="{{ optional($profile->militaryDetail->position_date)->format('Y-m-d') }}"
                                                        data-position_reference="{{ $profile->militaryDetail->position_reference }}"
                                                        data-military_registration_number="{{ $profile->militaryDetail->military_registration_number }}"
                                                        data-military_id_card_number="{{ $profile->militaryDetail->military_id_card_number }}"
                                                        data-finance_registration_number="{{ $profile->militaryDetail->finance_registration_number }}"
                                                        data-recruitment_origin="{{ $profile->militaryDetail->recruitment_origin }}"
                                                        data-recruitment_promotion="{{ $profile->militaryDetail->recruitment_promotion }}"
                                                        data-service_entry_date="{{ optional($profile->militaryDetail->service_entry_date)->format('Y-m-d') }}"
                                                        data-corps_assignment="{{ $profile->militaryDetail->corps_assignment }}"
                                                        data-unit_id="{{ $profile->militaryDetail->unit_id }}"
                                                        data-rank_id="{{ $profile->militaryDetail->rank_id }}"
                                                        data-rank_date="{{ optional($profile->militaryDetail->rank_date)->format('Y-m-d') }}"
                                                        data-current_function="{{ $profile->militaryDetail->current_function }}"
                                                        data-specialty="{{ $profile->militaryDetail->specialty }}"
                                                        data-exact_assignment="{{ $profile->militaryDetail->exact_assignment }}"
                                                        data-interruption_start_date="{{ optional($profile->militaryDetail->interruption_start_date)->format('Y-m-d') }}"
                                                        data-interruption_end_date="{{ optional($profile->militaryDetail->interruption_end_date)->format('Y-m-d') }}"
                                                        data-military_status="{{ $profile->militaryDetail->military_status }}"
                                                        data-military_status_reference="{{ $profile->militaryDetail->military_status_reference }}"
                                                        data-military_driver_license="{{ $profile->militaryDetail->military_driver_license }}"
                                                        data-other_information="{{ $profile->militaryDetail->other_information }}">
                                                        Modifier
                                                    </button>
                                                </div>
                                                <hr class="my-3">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Armée') }}
                                                            </p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->army ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Position') }}
                                                            </p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->position ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Date de position') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ optional($profile->militaryDetail->position_date)->format('d/m/Y') ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Référence de position') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->position_reference ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Numéro d\'enregistrement militaire') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->military_registration_number ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Numéro de carte militaire') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->military_id_card_number ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Numéro d\'enregistrement financier') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->finance_registration_number ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Origine du recrutement') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->recruitment_origin ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Promotion de recrutement') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->recruitment_promotion ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Date d\'entrée en service') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ optional($profile->militaryDetail->service_entry_date)->format('d/m/Y') ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Affectation au corps') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->corps_assignment ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Affectation à l\'unité') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profileUnit->unit_name ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Grade') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profileRank->rank_abbreviate ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Date de nomination') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ optional($profile->militaryDetail->rank_date)->format('d/m/Y') ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Fonction actuelle') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->current_function ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Spécialité') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->specialty ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Affectation exacte') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->exact_assignment ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Date de début d\'interruption') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ optional($profile->militaryDetail->interruption_start_date)->format('d/m/Y') ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Date de fin d\'interruption') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ optional($profile->militaryDetail->interruption_end_date)->format('d/m/Y') ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Statut militaire') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->military_status ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Référence du statut militaire') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->military_status_reference ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Permis de conduire militaire') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->military_driver_license ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Autres informations') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $profile->militaryDetail->other_information ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Conjoint(e) -->
                                        @include('personnel.profile.partials.templates.spouse-modal')
                                        <div class="tab-pane fade {{ $tab == 'spouse_details' ? 'show active' : '' }}" id="v-pills-spouse" role="tabpanel"
                                            aria-labelledby="v-pills-spouse-tab">
                                            @forelse ($profile->spouseDetails as $spouse)
                                                <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                    <div class="d-flex justify-content-between">
                                                        <h3 class="text-lg font-medium text-gray-900">
                                                            {{ __('Renseignements conjoint(e)') }}</h3>
                                                            <div class="dropdown">
                                                                <button class="btn" type="button" id="spouseDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                                                                    <i class="fas fa-ellipsis-vertical"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="spouseDropdown">
                                                                    <li>
                                                                        <button type="button" class="dropdown-item"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#spouseModal"
                                                                            data-action="{{ route('spouse_details.update', ['profile' => $profile->id, 'id' => $spouse->id]) }}"
                                                                            data-method="PUT"
                                                                            data-title="{{ $spouse->spouse_title == 'Monsieur' ? 'Modification renseignements du conjoint' : 'Modification renseignements de la conjointe' }}"
                                                                            data-spouse_title="{{ $spouse->spouse_title }}"
                                                                            data-spouse_name="{{ $spouse->spouse_name }}"
                                                                            data-spouse_maiden_name="{{ optional($spouse)->spouse_maiden_name }}"
                                                                            data-spouse_firstname="{{ optional($spouse)->spouse_firstname }}"
                                                                            data-spouse_birth_date="{{ optional(optional($spouse)->spouse_birth_date)->format('Y-m-d') }}"
                                                                            data-spouse_birth_place="{{ optional($spouse)->spouse_birth_place }}"
                                                                            data-spouse_profession="{{ optional($spouse)->spouse_profession }}"
                                                                            data-marriage_authorization="{{ optional($spouse)->marriage_authorization }}">
                                                                            Modifier
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <form action="{{ route('spouse_details.destroy', ['profile' => $profile->id, 'id' => $spouse->id]) }}" method="POST"
                                                                            class="d-inline"
                                                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ $spouse->spouse_name .' '.$spouse->spouse_firstname }} ?')">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="dropdown-item">
                                                                                Supprimer
                                                                            </button>
                                                                        </form>
                                                                  </li>
                                                                </ul>
                                                            </div>
                                                    </div>
                                                    <hr class="my-3">
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm font-medium text-gray-900">
                                                            {{ __('Titre') }}</p>
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ $spouse->spouse_title ?? '-' }}</p>
                                                    </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Nom du conjoint(e)') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $spouse->spouse_name ?? '-' }}</p>
                                                        </div>
                                                        @if ($spouse->spouse_title == 'Madame')
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                        {{ __('Nom de jeune fille du conjoint(e)') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                        {{ $spouse->spouse_maiden_name ?? '-' }}</p>
                                                            </div>
                                                        @endif
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Prénom du conjoint(e)') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $spouse->spouse_firstname ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Date de naissance du conjoint(e)') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                    {{ optional($spouse->spouse_birth_date)->format('d/m/Y') ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Lieu de naissance du conjoint(e)') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $spouse->spouse_birth_place ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Profession du conjoint(e)') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $spouse->spouse_profession ?? '-' }}</p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Autorisation de mariage') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $spouse->marriage_authorization ?? '-' }}</p>
                                                        </div>
                                                </div>
                                            @empty
                                                <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]"><h3 class="text-lg font-medium text-gray-900">
                                                    <div class="d-flex justify-content-between">
                                                        <h3 class="text-lg font-medium text-gray-900">
                                                            {{ __('Renseignements conjoint(e)') }}</h3>
                                                        <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#spouseModal"
                                                            data-action="{{ route('spouse_details.store', ['profile' => $profile->id]) }}"
                                                            data-method="POST"
                                                            data-title="Ajout de conjoint(e)">
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                    <hr class="my-3">
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ __('Aucun conjoint(e) enregistré') }}</p>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>

                                        <!-- Enfant(s) -->
                                        @include('personnel.profile.partials.templates.child-modal')
                                        <div class="tab-pane fade {{ $tab == 'children_details' ? 'show active' : '' }}" id="v-pills-children" role="tabpanel"
                                            aria-labelledby="v-pills-children-tab">
                                            <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Enfant(s)') }}
                                                    </h3>
                                                    <div class="dropdown">
                                                        <button class="btn" type="button" id="childDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                                                            <i class="fas fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="childDropdown">
                                                            <li>
                                                                <button type="button" class="dropdown-item"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#childModal"
                                                                    data-action="{{ route('children_details.store', ['profile' => $profile->id]) }}"
                                                                    data-method="POST"
                                                                    data-title="Ajout d'un enfant">
                                                                    Ajouter
                                                                </button>
                                                            </li>
                                                            @if(!$profile->childrenDetails->isEmpty() && $profile->childrenDetails->count()>1)
                                                                <li>
                                                                    <form action="{{ route('children_details.destroyAll', ['profile' => $profile->id]) }}" method="POST"
                                                                        class="d-inline"
                                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer tous les enfants de {{ $profile->name .' '. $profile->firstname }} ?')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="dropdown-item">
                                                                            Supprimer tout
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <hr class="my-3">
                                                @forelse ($profile->childrenDetails as $child)
                                                    <div class="row g-3">
                                                        <div class="col-md-3">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Nom et prénoms') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $child->child_full_name ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Date de naissance') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ optional($child->child_birth_date)->format('d/m/Y') ?? '-' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Lieu de naissance') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $child->child_birth_place ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Genre') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $child->child_gender ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Situation de l\'enfant') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $child->child_status ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2 text-end">
                                                                <div class="dropdown">
                                                                    <button class="btn" type="button" id="childFieldDropdown{{ $child->id }}" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                                                                        <i class="fas fa-ellipsis-vertical"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="childFieldDropdown{{ $child->id }}">
                                                                        <li>
                                                                            <button type="button" class="dropdown-item"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#childModal"
                                                                                data-action="{{ route('children_details.update', ['profile' => $profile->id, 'id' => $child->id]) }}"
                                                                                data-method="PUT"
                                                                                data-title="Modification d'un enfant"
                                                                                data-full_name="{{ $child->child_full_name }}"
                                                                                data-birth_date="{{ $child->child_birth_date->format('Y-m-d') }}"
                                                                                data-birth_place="{{ $child->child_birth_place }}"
                                                                                data-gender="{{ $child->child_gender }}"
                                                                                data-status="{{ $child->child_status }}">
                                                                                Modifier
                                                                            </button>
                                                                        </li>
                                                                        <li>
                                                                            <form action="{{ route('children_details.destroy', ['profile' => $profile->id, 'id' => $child->id]) }}" method="POST"
                                                                                class="d-inline"
                                                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ $child->child_full_name }} ?')">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="dropdown-item">
                                                                                    Supprimer
                                                                                </button>
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-2">
                                                @empty
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ __('Aucun enfant enregistré') }}</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                        <!-- Parcours académique -->
                                        @include('personnel.profile.partials.templates.academic-modal')
                                        <div class="tab-pane fade {{ $tab == 'academic_paths' ? 'show active' : '' }}" id="v-pills-education" role="tabpanel"
                                            aria-labelledby="v-pills-education-tab">
                                            <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Parcours académique') }}</h3>
                                                    <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#academicModal"
                                                        data-action="{{ route('academic_paths.store', ['profile' => $profile->id]) }}"
                                                        data-method="POST"
                                                        data-title="Ajout d'un parcours">
                                                        Ajouter
                                                    </button>
                                                </div>
                                                <hr class="my-3">
                                                @forelse ($profile->academicPaths as $education)
                                                    <div class="row g-3">
                                                        <div class="col-md-3">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Etablissement fréquenté') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $education->school_name ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Période') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $education->duration ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Diplômes, certificats ou attestations obtenus') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $education->diploma ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2 text-end">
                                                                <form action="{{ route('academic_paths.destroy', ['profile' => $profile->id, 'id' => $education->id]) }}" method="POST"
                                                                    class="d-inline"
                                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce parcours ?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" title="Supprimer"
                                                                        class="btn btn-sm btn-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                                <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#academicModal"
                                                                    data-action="{{ route('academic_paths.update', ['profile' => $profile->id, 'id' => $education->id]) }}"
                                                                    data-method="PUT"
                                                                    data-title="Modification d'un parcours"
                                                                    data-school_name="{{ $education->school_name }}"
                                                                    data-duration="{{ $education->duration }}"
                                                                    data-diploma="{{ $education->diploma }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-2">
                                                @empty
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ __('Aucune information académique enregistrée') }}
                                                        </p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                        <!-- Parcours militaire -->
                                        @include('personnel.profile.partials.templates.academy-modal')
                                        <div class="tab-pane fade {{ $tab == 'military_paths' ? 'show active' : '' }}" id="v-pills-military-path" role="tabpanel"
                                            aria-labelledby="v-pills-military-path-tab">
                                            <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Parcours militaire') }}</h3>
                                                    <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#academyModal"
                                                        data-action="{{ route('military_paths.store', ['profile' => $profile->id]) }}"
                                                        data-method="POST"
                                                        data-title="Ajout d'un parcours">
                                                        Ajouter
                                                    </button>
                                                </div>
                                                <hr class="my-3">
                                                @forelse ($profile->militaryPaths as $military)
                                                    <div class="row g-3">
                                                        <div class="col-md-3">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Centre ou école') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $military->academy_name ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Période') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $military->academy_duration ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Diplômes, certificats ou attestations obtenus') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $military->academy_diploma ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2 text-end">
                                                                <form action="{{ route('military_paths.destroy', ['profile' => $profile->id, 'id' => $military->id]) }}" method="POST"
                                                                    class="d-inline"
                                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce parcours ?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" title="Supprimer"
                                                                        class="btn btn-sm btn-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                                <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#academyModal"
                                                                    data-action="{{ route('military_paths.update', ['profile' => $profile->id, 'id' => $military->id]) }}"
                                                                    data-method="PUT"
                                                                    data-title="Modification d'un parcours"
                                                                    data-academy_name="{{ $military->academy_name }}"
                                                                    data-academy_duration="{{ $military->academy_duration }}"
                                                                    data-academy_diploma="{{ $military->academy_diploma }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-2">
                                                @empty
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ __('Aucune information militaire enregistrée') }}
                                                        </p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                        <!-- Parcours professionnel -->
                                        @include('personnel.profile.partials.templates.career-modal')
                                        <div class="tab-pane fade {{ $tab == 'professional_careers' ? 'show active' : '' }}" id="v-pills-professional-path" role="tabpanel"
                                            aria-labelledby="v-pills-professional-path-tab">
                                            <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Parcours professionnel') }}</h3>
                                                    <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#careerModal"
                                                        data-action="{{ route('professional_careers.store', ['profile' => $profile->id]) }}"
                                                        data-method="POST"
                                                        data-title="Ajout d'un parcours">
                                                        Ajouter
                                                    </button>
                                                </div>
                                                <hr class="my-3">
                                                @forelse ($profile->professionalCareers as $professional)
                                                    <div class="row g-3">
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Lieu d\'emploi') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $professional->company_name ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Emploi tenu') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $professional->job_title ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Début d\'affectation') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ optional($professional->start_date)->format('d/m/Y') ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Fin d\'affectation') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ optional($professional->end_date)->format('d/m/Y') ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Référence') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $professional->description ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2 text-end">
                                                                <form action="{{ route('professional_careers.destroy', ['profile' => $profile->id, 'id' => $professional->id]) }}" method="POST"
                                                                    class="d-inline"
                                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce parcours ?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" title="Supprimer"
                                                                        class="btn btn-sm btn-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                                <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#careerModal"
                                                                    data-action="{{ route('professional_careers.update', ['profile' => $profile->id, 'id' => $professional->id]) }}"
                                                                    data-method="PUT"
                                                                    data-title="Modification d'un parcours"
                                                                    data-company_name="{{ $professional->company_name }}"
                                                                    data-job_title="{{ $professional->job_title }}"
                                                                    data-start_date="{{ optional($professional->start_date)->format('Y-m-d') }}"
                                                                    data-end_date="{{ optional($professional->end_date)->format('Y-m-d') }}"
                                                                    data-description="{{ $professional->description }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-2">
                                                @empty
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ __('Aucune information professionnelle enregistrée') }}
                                                        </p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                        <!-- Grades successifs -->
                                        @include('personnel.profile.partials.templates.rank-modal')
                                        <div class="tab-pane fade {{ $tab == 'rank_histories' ? 'show active' : '' }}" id="v-pills-rank-history" role="tabpanel"
                                            aria-labelledby="v-pills-rank-history-tab">
                                            <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Grades successifs') }}</h3>
                                                    <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#rankModal"
                                                        data-action="{{ route('rank_histories.store', ['profile' => $profile->id]) }}"
                                                        data-method="POST"
                                                        data-title="Ajout d'un grade">
                                                        Ajouter
                                                    </button>
                                                </div>
                                                <hr class="my-3">
                                                @forelse ($profile->rankHistories as $rank)
                                                    <div class="row g-3">
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Grade') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $rank->history_rank ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Date d\'effet') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ optional($rank->history_promotion_date)->format('d/m/Y') ?? '-' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Référence') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $rank->history_rank_reference ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2 text-end">
                                                                <form action="{{ route('rank_histories.destroy', ['profile' => $profile->id, 'id' => $rank->id]) }}" method="POST"
                                                                    class="d-inline"
                                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce grade ?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" title="Supprimer"
                                                                        class="btn btn-sm btn-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                                <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#rankModal"
                                                                    data-action="{{ route('rank_histories.update', ['profile' => $profile->id, 'id' => $rank->id]) }}"
                                                                    data-method="PUT"
                                                                    data-title="Modification d'un grade"
                                                                    data-history_rank="{{ $rank->history_rank }}"
                                                                    data-history_promotion_date="{{ optional($rank->history_promotion_date)->format('Y-m-d') }}"
                                                                    data-history_rank_reference="{{ $rank->history_rank_reference }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-2">
                                                @empty
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ __('Aucun grade enregistré') }}</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                        <!-- Décorations successives -->
                                        @include('personnel.profile.partials.templates.award-modal')
                                        <div class="tab-pane fade {{ $tab == 'honorary_distinctions' ? 'show active' : '' }}" id="v-pills-aware-history" role="tabpanel"
                                            aria-labelledby="v-pills-aware-history-tab">
                                            <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Décorations successives') }}</h3>
                                                    <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#awardModal"
                                                        data-action="{{ route('honorary_distinctions.store', ['profile' => $profile->id]) }}"
                                                        data-method="POST"
                                                        data-title="Ajout d'une distinction honorifique">
                                                        Ajouter
                                                    </button>
                                                </div>
                                                <hr class="my-3">
                                                @forelse ($profile->honoraryDistinctions as $award)
                                                    <div class="row g-3">
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Intitulé') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $award->honorary_title ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Promotion') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $award->honorary_promotion ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Référence') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $award->honorary_reference ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2 text-end">
                                                                <form action="{{ route('honorary_distinctions.destroy', ['profile' => $profile->id, 'id' => $award->id]) }}" method="POST"
                                                                    class="d-inline"
                                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette distinction ?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" title="Supprimer"
                                                                        class="btn btn-sm btn-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                                <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#awardModal"
                                                                    data-action="{{ route('honorary_distinctions.update', ['profile' => $profile->id, 'id' => $award->id]) }}"
                                                                    data-method="PUT"
                                                                    data-title="Modification d'une distinction"
                                                                    data-honorary_title="{{ $award->honorary_title }}"
                                                                    data-honorary_promotion="{{ $award->honorary_promotion }}"
                                                                    data-honorary_reference="{{ $award->honorary_reference }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-2">
                                                @empty
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ __('Aucune décoration enregistrée') }}</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                        <!-- Campagnes militaires -->
                                        @include('personnel.profile.partials.templates.campaign-modal')
                                        <div class="tab-pane fade {{ $tab == 'campaign_histories' ? 'show active' : '' }}" id="v-pills-campaign-history" role="tabpanel"
                                            aria-labelledby="v-pills-campaign-history-tab">
                                            <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Campagnes militaires') }}</h3>
                                                    <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#campaignModal"
                                                        data-action="{{ route('campaign_histories.store', ['profile' => $profile->id]) }}"
                                                        data-method="POST"
                                                        data-title="Ajout d'une campagne">
                                                        Ajouter
                                                    </button>
                                                </div>
                                                <hr class="my-3">
                                                @forelse ($profile->militaryCampaigns as $campaign)
                                                    <div class="row g-3">
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Intitulé') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $campaign->campaign_title ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Période') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $campaign->campaign_period ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Référence') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $campaign->campaign_reference ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="my-2 text-end">
                                                                <form action="{{ route('campaign_histories.destroy', ['profile' => $profile->id, 'id' => $campaign->id]) }}" method="POST"
                                                                    class="d-inline"
                                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette campagne ?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" title="Supprimer"
                                                                        class="btn btn-sm btn-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                                <button type="button" class="btn btn-sm btn-warning" title="Editer"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#campaignModal"
                                                                    data-action="{{ route('campaign_histories.update', ['profile' => $profile->id, 'id' => $campaign->id]) }}"
                                                                    data-method="PUT"
                                                                    data-title="Modification d'une campagne"
                                                                    data-campaign_title="{{ $campaign->campaign_title }}"
                                                                    data-campaign_period="{{ $campaign->campaign_period }}"
                                                                    data-campaign_locations="{{ $campaign->campaign_locations }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-2">
                                                @empty
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ __('Aucune campagne militaire enregistrée') }}</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Permissions -->
                            <div class="tab-pane fade" id="nav-perm" role="tabpanel"
                                aria-labelledby="nav-perm-tab">
                                Congés et permissions
                            </div>

                            <!-- Paramètres -->
                            <div class="tab-pane fade" id="nav-role" role="tabpanel"
                                aria-labelledby="nav-role-tab">Parametres</div>

                            <!-- Décompte -->
                            <div class="tab-pane fade" id="nav-service-status" role="tabpanel"
                                aria-labelledby="nav-service-status-tab">
                                <div class="row g-3">
                                    <div class="col-md-10">
                                        <div class="d-flex align-items-start">
                                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                              <button class="nav-link active text-start" id="v-pills-serv-stat-tab" data-bs-toggle="pill" data-bs-target="#v-pills-serv-stat" type="button" role="tab" aria-controls="v-pills-serv-stat" aria-selected="true">Etat de service</button>
                                              <button class="nav-link text-start" id="v-pills-perm-stat-tab" data-bs-toggle="pill" data-bs-target="#v-pills-perm-stat" type="button" role="tab" aria-controls="v-pills-perm-stat" aria-selected="false">Congés et permissions</button>
                                              <button class="nav-link text-start" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
                                              <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
                                            </div>
                                            <div class="tab-content w-100" id="v-pills-tabContent">
                                                <!-- Etat de service -->
                                                <div class="tab-pane fade show active" id="v-pills-serv-stat" role="tabpanel" aria-labelledby="v-pills-serv-stat-tab">
                                                    <div id="etatService" class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                        <h3 class="text-lg font-medium text-gray-900">
                                                            {{ __('Etat de service') }}</h3>
                                                        <hr class="my-3">
                                                        <div class="row g-3">
                                                            <div class="col-md-3">
                                                                <div class="my-2">
                                                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                                                        {{ __('Age') }}</p>
                                                                    <p id="age" class="mt-1 text-sm text-gray-600">
                                                                        {{ $age ? floor($age) . ' ans' : '-' }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="my-2">
                                                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                                                        {{ __('Ancienneté de service') }}</p>
                                                                    <p id="serviceSeniority" class="mt-1 text-sm text-gray-600">
                                                                        @if ($serviceSeniority)
                                                                            {{ floor($serviceSeniority / 365) }} {{ __('an' . (floor($serviceSeniority / 365) > 1 ? 's' : '')) }},
                                                                            {{ floor(($serviceSeniority % 365) / 30) }} {{ __('mois' . (floor(($serviceSeniority % 365) / 30) > 1 ? '' : '')) }},
                                                                            {{ ($serviceSeniority % 365) % 30 }} {{ __('jour' . (($serviceSeniority % 365) % 30 > 1 ? 's' : '')) }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="my-2">
                                                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                                                        {{ __('Ancienneté de port de grade') }}</p>
                                                                    <p id="rankSeniority" class="mt-1 text-sm text-gray-600">
                                                                        @if ($rankSeniority)
                                                                            {{ floor($rankSeniority / 365) }} {{ __('an' . (floor($rankSeniority / 365) > 1 ? 's' : '')) }},
                                                                            {{ floor(($rankSeniority % 365) / 30) }} {{ __('mois' . (floor(($rankSeniority % 365) / 30) > 1 ? '' : '')) }},
                                                                            {{ ($rankSeniority % 365) % 30 }} {{ __('jour' . (($rankSeniority % 365) % 30 > 1 ? 's' : '')) }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="my-2">
                                                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                                                        {{ __('Date de fin de carrière') }}</p>
                                                                    <p id="careerEndDate" class="mt-1 text-sm text-gray-600">
                                                                        {{ $careerEndDate ? $careerEndDate->format('d/m/Y') : '-' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Congés et permissions -->
                                                <div class="tab-pane fade" id="v-pills-perm-stat" role="tabpanel" aria-labelledby="v-pills-perm-stat-tab">...</div>

                                                <!-- Messages -->
                                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>

                                                <!-- Settings -->
                                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <form id="referenceDateForm">
                                            <div class="mb-3">
                                                <x-input-label for="reference_date" :value="__('Date de référence')" />
                                                <x-text-input id="reference_date" name="reference_date" type="date" :value="now()->format('Y-m-d')" />
                                            </div>
                                        </form>
                                    </div>
                                </div>



                                {{-- <div class="d-flex align-items-start">
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button class="nav-link active text-start" id="v-pills-service-stat-tab" data-bs-toggle="pill" data-bs-target="#v-pills-service-stat" type="button" role="tab" aria-controls="v-pills-service-stat" aria-selected="true">Etat de service</button>
                                        <button class="nav-link text-start" id="v-pills-perm-stat-tab" data-bs-toggle="pill" data-bs-target="#v-pills-perm-stat" type="button" role="tab" aria-controls="v-pills-perm-stat" aria-selected="false">Congés et permissions</button>
                                        <button class="nav-link text-start" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
                                        <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
                                    </div>
                                    <div class="tab-contentn w-100" id="v-pills-tabContent">
                                        <!-- Etat de service -->
                                        <div class="tab-pane fade show active" id="v-pills-service-stat" role="tabpanel" aria-labelledby="v-pills-service-stat-tab">
                                            <div id="etatService" class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                <h3 class="text-lg font-medium text-gray-900">
                                                    {{ __('Etat de service') }}</h3>
                                                <hr class="my-3">
                                                <div class="row g-3">
                                                    <div class="col-md-3">
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Age') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ floor($age) ?? '-' }} ans</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Ancienneté de service') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                @if ($serviceSeniority)
                                                                    {{ floor($serviceSeniority / 365) }} {{ __('an' . (floor($serviceSeniority / 365) > 1 ? 's' : '')) }},
                                                                    {{ floor(($serviceSeniority % 365) / 30) }} {{ __('mois' . (floor(($serviceSeniority % 365) / 30) > 1 ? '' : '')) }},
                                                                    {{ ($serviceSeniority % 365) % 30 }} {{ __('jour' . (($serviceSeniority % 365) % 30 > 1 ? 's' : '')) }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Ancienneté de port de grade') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                @if ($rankSeniority)
                                                                    {{ floor($rankSeniority / 365) }} {{ __('an' . (floor($rankSeniority / 365) > 1 ? 's' : '')) }},
                                                                    {{ floor(($rankSeniority % 365) / 30) }} {{ __('mois' . (floor(($rankSeniority % 365) / 30) > 1 ? '' : '')) }},
                                                                    {{ ($rankSeniority % 365) % 30 }} {{ __('jour' . (($rankSeniority % 365) % 30 > 1 ? 's' : '')) }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="my-2">
                                                            <p class="mt-1 text-sm font-medium text-gray-900">
                                                                {{ __('Date de fin de carrière') }}</p>
                                                            <p class="mt-1 text-sm text-gray-600">
                                                                {{ $careerEndDate ? $careerEndDate->format('d/m/Y') : '-' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Congés et permissions -->
                                        <div class="tab-pane fade" id="v-pills-perm-stat" role="tabpanel" aria-labelledby="v-pills-perm-stat-tab">Congés et permissions</div>

                                        <!-- Messages -->
                                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">Messages</div>

                                        <!-- Settings -->
                                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">Settings</div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast -->
    @if(session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="fas fa-check-circle text-success px-2"></i>
                    <strong class="me-auto">Bravo !</strong>
                    <small>A l'instant</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>

        <!-- Script to trigger the toast -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const toastElement = document.getElementById('liveToast');
                const toast = new bootstrap.Toast(toastElement);
                toast.show(); // Automatically display the toast
            });
        </script>
    @endif
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileId = {{ $profile->id }};
        const referenceDateInput = document.getElementById('reference_date');

        referenceDateInput.addEventListener('change', function () {
            updateEtatService(profileId);
        });

        function updateEtatService(profileId) {
            const referenceDate = referenceDateInput.value;

            if (!referenceDate) {
                alert('Veuillez sélectionner une date de référence.');
                return;
            }

            fetch(`/personnel/profile/${profileId}/update-calculations`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                body: JSON.stringify({ reference_date: referenceDate }),
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('age').textContent = data.age
                    ? `${Math.floor(data.age)} an${Math.floor(data.age) > 1 ? 's' : '-'}`
                    : '-';
                document.getElementById('serviceSeniority').textContent = data.serviceSeniority
                    ? `${Math.floor(data.serviceSeniority / 365)} an${Math.floor(data.serviceSeniority / 365) > 1 ? 's' : ''}, ${Math.floor((data.serviceSeniority % 365) / 30)} mois, ${data.serviceSeniority % 365 % 30} jour${data.serviceSeniority % 365 % 30 > 1 ? 's' : ''}`
                    : '-';
                document.getElementById('rankSeniority').textContent = data.rankSeniority
                    ? `${Math.floor(data.rankSeniority / 365)} an${Math.floor(data.rankSeniority / 365) > 1 ? 's' : ''}, ${Math.floor((data.rankSeniority % 365) / 30)} mois, ${data.rankSeniority % 365 % 30} jour${data.rankSeniority % 365 % 30 > 1 ? 's' : ''}`
                    : '-';
                document.getElementById('careerEndDate').textContent = data.careerEndDate ?? '-';
            })
            .catch(error => console.error('Erreur lors de la mise à jour :', error));
        }
    });
</script>

