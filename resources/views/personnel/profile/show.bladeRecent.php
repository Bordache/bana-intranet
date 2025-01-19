<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion du personnel') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <nav class="d-flex justify-content-between align-items-center" aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
                <ol class="breadcrumb mb-0">
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
                                    {{-- @if($profile->photo)
                                        <img src="{{ $profile->photo }}" alt="Photo de profil" class="img-fluid w-100 h-100">
                                    @else --}}
                                        {{ strtoupper(substr($profile->name, 0, 1)) }}{{ strtoupper(substr($profile->firstname, 0, 1)) }}
                                    {{-- @endif --}}
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-1">{{ $profile->name }} {{ $profile->firstname }}</h5>
                                    <p class="text-muted mb-0">{{ $profile->rank_name }}</p>
                                </div>
                            </div>
                            <div>
                                <ul>
                                    <li class="mb-2">
                                        <a href="{{ route('personnel.create', ['recipient' => $profile->id]) }}" class="btn btn-sm btn-light d-flex align-items-center">
                                            <i class="fas fa-envelope me-2"></i> Envoyer message
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('personnel.destroy', $profile->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce détail ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger w-100">Supprimer</button>
                                        </form>
                                    </li>
                                </ul>

                            </div>
                        </div>

                        <!-- Navigation -->



                        <!-- Informations générales et Renseignements militaires côte à côte -->
                        <div class="row g-3">
                            <!-- Informations générales -->
                            <div class="col-md-6">
                                <div class="border border-gray-200 p-3 mb-4">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="text-lg font-medium text-gray-900">{{ __('Informations générales') }}</h3>
                                        <a href="{{ route('personnel.edit', $profile->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Nom') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->name ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Prénom') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->firstname ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de naissance') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ optional($profile->birth_date)->format('d/m/Y') ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Lieu de naissance') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->birth_place ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Genre') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->gender ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('ID national') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->national_id ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date d\'émission') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ optional($profile->issue_date)->format('d/m/Y') ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Lieu d\'émission') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->issue_place ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de duplicata') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ optional($profile->duplicate_date)->format('d/m/Y') ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Lieu de duplicata') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->duplicate_place ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Adresse') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->address ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Téléphone') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->phone ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Email') }}</p>
                                        <p class="mt-1 text-sm text-primary">
                                            <a href="mailto:{{ $profile->email }}" class="underline">{{ $profile->email ?? '-' }}</a>
                                        </p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Groupe sanguin') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->blood_group ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Taille') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->size ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Nom du père') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->father_name ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Nom de la mère') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->mother_name ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('État civil') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->marital_status ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Adresse secondaire') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->fallback_address ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Permis de conduire') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->driver_license ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Sport pratiqué') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->practiced_sport ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Hobbies') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->hobbies ?? '-' }}</p>
                                    </div>
                                </div>

                                <!-- Renseignements militaires -->
                                {{-- <div class="border border-gray-200 p-3 mb-4">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="text-lg font-medium text-gray-900">{{ __('Renseignements militaires') }}</h3>
                                            <a href="{{ route('personnel.edit', $profile->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Armée') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->army ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Position') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->position ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de position') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->position_date)->format('d/m/Y') ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Référence de position') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->position_reference ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Numéro d\'enregistrement militaire') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_registration_number ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Numéro de carte militaire') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_id_card_number ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Numéro d\'enregistrement financier') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->finance_registration_number ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Origine du recrutement') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->recruitment_origin ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Promotion de recrutement') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->recruitment_promotion ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date d\'entrée en service') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->service_entry_date)->format('d/m/Y') ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Affectation au corps') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->corps_assignment ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Affectation à l\'unité') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->unit_assignment ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('ID de grade') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->rank_id ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de grade') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->rank_date)->format('d/m/Y') ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Fonction actuelle') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->current_function ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Spécialité') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->specialty ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Affectation exacte') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->exact_assignment ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de début d\'interruption') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->interruption_start_date)->format('d/m/Y') ?? '-'}}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de fin d\'interruption') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->interruption_end_date)->format('d/m/Y') ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Statut militaire') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_status ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Référence du statut militaire') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_status_reference ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Permis de conduire militaire') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_driver_license ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Autres informations') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->other_information ?? '-' }}</p>
                                        </div>
                                </div> --}}

                                 <!-- Renseignements conjoint(e) -->
                                <div class="border border-gray-200 p-3 mb-4">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="text-lg font-medium text-gray-900">{{ __('Renseignements conjoint(e)') }}</h3>
                                        <a href="{{ route('personnel.edit', $profile->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                    </div>
                                    <div class="my-2">
                                       <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Nom du conjoint(e)') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->spouse_name ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Nom de jeune fille du conjoint(e)') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->spouse_maiden_name ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Prénom du conjoint(e)') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->spouse_firstname ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de naissance du conjoint(e)') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->spouse_birth_date ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Lieu de naissance du conjoint(e)') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->spouse_birth_place ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Profession du conjoint(e)') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->spouse_profession ?? '-' }}</p>
                                        </div>
                                        <div class="my-2">
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Autorisation de mariage') }}</p>
                                            <p class="mt-1 text-sm text-gray-600">{{ $profile->marriage_authorization ?? '-' }}</p>
                                        </div>

                                </div>
                            </div>

                            <!-- Renseignements militaires -->
                            <div class="col-md-6">
                                <div class="border border-gray-200 p-3">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="text-lg font-medium text-gray-900">{{ __('Renseignements militaires') }}</h3>
                                        <a href="{{ route('personnel.edit', $profile->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Armée') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->army ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Position') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->position ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de position') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->position_date)->format('d/m/Y') ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Référence de position') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->position_reference ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Numéro d\'enregistrement militaire') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_registration_number ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Numéro de carte militaire') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_id_card_number ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Numéro d\'enregistrement financier') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->finance_registration_number ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Origine du recrutement') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->recruitment_origin ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Promotion de recrutement') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->recruitment_promotion ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date d\'entrée en service') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->service_entry_date)->format('d/m/Y') ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Affectation au corps') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->corps_assignment ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Affectation à l\'unité') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->unit_assignment ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('ID de grade') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->rank_id ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de grade') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->rank_date)->format('d/m/Y') ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Fonction actuelle') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->current_function ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Spécialité') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->specialty ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Affectation exacte') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->exact_assignment ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de début d\'interruption') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->interruption_start_date)->format('d/m/Y') ?? '-'}}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de fin d\'interruption') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->interruption_end_date)->format('d/m/Y') ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Statut militaire') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_status ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Référence du statut militaire') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_status_reference ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Permis de conduire militaire') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_driver_license ?? '-' }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Autres informations') }}</p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->other_information ?? '-' }}</p>
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

