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
            <div class="p-4 sm:p-8 bg-white">
                <div class="container">
                    <div class="row g-3">
                        <!-- Photo et Nom -->
                        <div class="d-flex justify-content-between align-items-center">
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
                                            <button type="submit"
                                                class="btn btn-sm btn-danger w-100">Supprimer</button>
                                        </form>
                                    </li>
                                </ul>

                            </div>
                        </div>

                        <!-- Informations personnelles -->
                        <div class="tab-pane fade show active" id="nav-rens" role="tabpanel"
                                aria-labelledby="nav-rens-tab">
                                <div class="d-flex align-items-start">
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <button class="nav-link active btn-sm text-start" id="v-pills-civil-status-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-civil-status" type="button"
                                            role="tab" aria-controls="v-pills-civil-status"
                                            aria-selected="true">Etat civil</button>
                                        <button class="nav-link text-start btn-sm" id="v-pills-military-status-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-military-status"
                                            type="button" role="tab" aria-controls="v-pills-military-status"
                                            aria-selected="false">Renseignements militaires</button>
                                        <button class="nav-link text-start btn-sm" id="v-pills-spouse-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-spouse" type="button"
                                            role="tab" aria-controls="v-pills-spouse"
                                            aria-selected="false">Conjoint(e)</button>
                                        <button class="nav-link text-start btn-sm" id="v-pills-children-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-children" type="button"
                                            role="tab" aria-controls="v-pills-children"
                                            aria-selected="false">Enfant(s)</button>
                                        <button class="nav-link text-start btn-sm" id="v-pills-education-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-education" type="button"
                                            role="tab" aria-controls="v-pills-education"
                                            aria-selected="false">Parcours académique</button>
                                        <button class="nav-link text-start btn-sm" id="v-pills-military-path-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-military-path"
                                            type="button" role="tab" aria-controls="v-pills-military-path"
                                            aria-selected="false">Parcours militaire</button>
                                        <button class="nav-link text-start btn-sm" id="v-pills-professional-path-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-professional-path"
                                            type="button" role="tab" aria-controls="v-pills-professional-path"
                                            aria-selected="false">Parcours professionnel</button>
                                        <button class="nav-link text-start btn-sm" id="v-pills-rank-history-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-rank-history"
                                            type="button" role="tab" aria-controls="v-pills-rank-history"
                                            aria-selected="false">Grades successifs</button>
                                        <button class="nav-link text-start btn-sm" id="v-pills-aware-history-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-aware-history"
                                            type="button" role="tab" aria-controls="v-pills-aware-history"
                                            aria-selected="false">Décorations successives</button>
                                        <button class="nav-link text-start btn-sm" id="v-pills-campaign-history-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-campaign-history"
                                            type="button" role="tab" aria-controls="v-pills-campaign-history"
                                            aria-selected="false">Campagnes militaires</button>
                                    </div>
                                    <div class="tab-content w-100" id="v-pills-tabContent">

                                        <!-- Etat civil -->
                                        <div class="tab-pane fade show active" id="v-pills-civil-status" role="tabpanel"
                                            aria-labelledby="v-pills-civil-status-tab">
                                            @include('personnel.profile.partials.editprofile.personnal-information-edit-form')
                                        </div>

                                        <!-- Renseignements militaires -->
                                        <div class="tab-pane fade" id="v-pills-military-status" role="tabpanel"
                                            aria-labelledby="v-pills-military-status-tab">
                                            @include('personnel.profile.partials.editprofile.military-detail-edit-form')
                                        </div>

                                        <!-- Conjoint(e) -->
                                        <div class="tab-pane fade" id="v-pills-spouse" role="tabpanel"
                                            aria-labelledby="v-pills-spouse-tab">
                                            <div class="border border-gray-200 p-3 mb-4">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Renseignements conjoint(e)') }}</h3>
                                                    <a href="{{ route('personnel.edit', $profile->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        {{ $profile->spouseDetails->isEmpty() ? 'Ajouter' : 'Modifier' }}
                                                    </a>
                                                </div>
                                                <hr class="my-3">
                                                @forelse ($profile->spouseDetails as $spouse)
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm font-medium text-gray-900">
                                                            {{ __('Nom du conjoint(e)') }}</p>
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ $spouse->spouse_name ?? '-' }}</p>
                                                    </div>
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm font-medium text-gray-900">
                                                            {{ __('Nom de jeune fille du conjoint(e)') }}</p>
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ $spouse->spouse_maiden_name ?? '-' }}</p>
                                                    </div>
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
                                                @empty
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ __('Aucun conjoint(e) enregistré') }}</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                        <!-- Enfant(s) -->
                                        <div class="tab-pane fade" id="v-pills-children" role="tabpanel"
                                            aria-labelledby="v-pills-children-tab">
                                            <div class="border border-gray-200 p-3 mb-4">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Enfant(s)') }}
                                                    </h3>
                                                    <a href="{{ route('personnel.edit', $profile->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        {{ $profile->childrenDetails->isEmpty() ? 'Ajouter' : 'Modifier' }}
                                                    </a>
                                                </div>
                                                <hr class="my-3">
                                                @forelse ($profile->childrenDetails as $child)
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm font-medium text-gray-900">
                                                            {{ __('Nom et prénoms') }}</p>
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ $child->child_full_name ?? '-' }}</p>
                                                    </div>
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm font-medium text-gray-900">
                                                            {{ __('Date de naissance') }}</p>
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ optional($child->child_birth_date)->format('d/m/Y') ?? '-' }}
                                                        </p>
                                                    </div>
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm font-medium text-gray-900">
                                                            {{ __('Lieu de naissance') }}</p>
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ $child->child_birth_place ?? '-' }}</p>
                                                    </div>
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm font-medium text-gray-900">
                                                            {{ __('Genre') }}</p>
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ $child->child_gender ?? '-' }}</p>
                                                    </div>
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm font-medium text-gray-900">
                                                            {{ __('Situation de l\'enfant') }}</p>
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ $child->child_status ?? '-' }}</p>
                                                    </div>

                                                @empty
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ __('Aucun enfant enregistré') }}</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                        <!-- Parcours académique -->
                                        <div class="tab-pane fade" id="v-pills-education" role="tabpanel"
                                            aria-labelledby="v-pills-education-tab">
                                            <div class="border border-gray-200 p-3 mb-4">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Parcours académique') }}</h3>
                                                    <a href="{{ route('personnel.edit', $profile->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        {{ $profile->academicPaths->isEmpty() ? 'Ajouter' : 'Modifier' }}
                                                    </a>
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
                                                        <div class="col-md-6">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Diplômes, certificats ou attestations obtenus') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $education->diploma ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                        <div class="tab-pane fade" id="v-pills-military-path" role="tabpanel"
                                            aria-labelledby="v-pills-military-path-tab">
                                            <div class="border border-gray-200 p-3 mb-4">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Parcours militaire') }}</h3>
                                                    <a href="{{ route('personnel.edit', $profile->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        {{ $profile->militaryPaths->isEmpty() ? 'Ajouter' : 'Modifier' }}
                                                    </a>
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
                                                        <div class="col-md-3">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Période') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $military->academy_duration ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Diplômes, certificats ou attestations obtenus') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $military->academy_diploma ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                        <div class="tab-pane fade" id="v-pills-professional-path" role="tabpanel"
                                            aria-labelledby="v-pills-professional-path-tab">
                                            <div class="border border-gray-200 p-3 mb-4">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Parcours professionnel') }}</h3>
                                                    <a href="{{ route('personnel.edit', $profile->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        {{ $profile->professionalCareers->isEmpty() ? 'Ajouter' : 'Modifier' }}
                                                    </a>
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
                                                        <div class="col-md-4">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Référence') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $professional->description ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                        <div class="tab-pane fade" id="v-pills-rank-history" role="tabpanel"
                                            aria-labelledby="v-pills-rank-history-tab">
                                            <div class="border border-gray-200 p-3 mb-4">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Grades successifs') }}</h3>
                                                    <a href="{{ route('personnel.edit', $profile->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        {{ $profile->rankHistories->isEmpty() ? 'Ajouter' : 'Modifier' }}
                                                    </a>
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
                                                        <div class="col-md-3">
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
                                                    </div>
                                                @empty
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ __('Aucun grade enregistré') }}</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                        <!-- Décorations successives -->
                                        <div class="tab-pane fade" id="v-pills-aware-history" role="tabpanel"
                                            aria-labelledby="v-pills-aware-history-tab">
                                            <div class="border border-gray-200 p-3 mb-4">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Décorations successives') }}</h3>
                                                    <a href="{{ route('personnel.edit', $profile->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        {{ $profile->honoraryDistinctions->isEmpty() ? 'Ajouter' : 'Modifier' }}
                                                    </a>
                                                </div>
                                                <hr class="my-3">
                                                @forelse ($profile->honoraryDistinctions as $award)
                                                    <div class="row g-3">
                                                        <div class="col-md-3">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Intitulé') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $award->honorary_title ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
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
                                                    </div>
                                                @empty
                                                    <div class="my-2">
                                                        <p class="mt-1 text-sm text-gray-600">
                                                            {{ __('Aucune décoration enregistrée') }}</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                        <!-- Campagnes militaires -->
                                        <div class="tab-pane fade" id="v-pills-campaign-history" role="tabpanel"
                                            aria-labelledby="v-pills-campaign-history-tab">
                                            <div class="border border-gray-200 p-3 mb-4">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="text-lg font-medium text-gray-900">
                                                        {{ __('Campagnes militaires') }}</h3>
                                                    <a href="{{ route('personnel.edit', $profile->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        {{ $profile->militaryCampaigns->isEmpty() ? 'Ajouter' : 'Modifier' }}
                                                    </a>
                                                </div>
                                                <hr class="my-3">
                                                @forelse ($profile->militaryCampaigns as $campaign)
                                                    <div class="row g-3">
                                                        <div class="col-md-3">
                                                            <div class="my-2">
                                                                <p class="mt-1 text-sm font-medium text-gray-900">
                                                                    {{ __('Intitulé') }}</p>
                                                                <p class="mt-1 text-sm text-gray-600">
                                                                    {{ $campaign->campaign_title ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
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
                                                    </div>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Supprime les espaces ou sauts de ligne superflus
    document.addEventListener("DOMContentLoaded", () => {
        const textareaInputs = document.querySelectorAll('textarea');
        textareaInputs.forEach(textarea => {
                textarea.value = textarea.value.trim();
        });
    });

    function cleanTextareaInput(fieldId) {
        const textarea = document.getElementById(fieldId);
        if (textarea) {
            textarea.value = textarea.value.trim();
        }
    }
</script>

