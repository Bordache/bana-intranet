<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion du personnel') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <nav class="d-flex justify-content-between align-items-center text-sm" aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('personnel.index') }}">Base de données</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('personnel.list') }}">Liste du personnel</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Informations du profil
                    </li>
                </ol>
            </nav>
            <main class="mt-6">
                <!-- Photo et Nom -->
                <div class="d-flex justify-content-between align-items-center mb-4">
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
                            <p class="text-muted mb-0">{{ $profileRank->rank_name }}</p>
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
                <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                    {{-- Informations générales --}}
                    <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                        <div class="pt-3 sm:pt-5 w-100">
                            <div class="d-flex justify-content-between">
                                <h2 class="text-xl font-semibold text-black dark:text-white">{{ __('Informations générales')}}</h2>
                                <a href="{{ route('personnel.edit', $profile->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                            </div>

                            <div class="mt-4 text-sm/relaxed">
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Nom') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->name ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Prénom') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->firstname ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de naissance') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ optional($profile->birth_date)->format('d/m/Y') ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Lieu de naissance') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->birth_place ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Genre') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->gender ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('ID national') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->national_id ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date d\'émission') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ optional($profile->issue_date)->format('d/m/Y') ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Lieu d\'émission') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->issue_place ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de duplicata') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ optional($profile->duplicate_date)->format('d/m/Y') ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Lieu de duplicata') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->duplicate_place ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Adresse') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->address ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Téléphone') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->phone ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Email') }}</p>
                                    <p class="mt-1 text-sm text-primary">
                                        <a href="mailto:{{ $profile->email }}" class="underline">{{ $profile->email ?? '-' }}</a>
                                    </p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Groupe sanguin') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->blood_group ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Taille') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->size ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Nom du père') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->father_name ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Nom de la mère') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->mother_name ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('État civil') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->marital_status ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Adresse secondaire') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->fallback_address ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Permis de conduire') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->driver_license ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Sport pratiqué') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->practiced_sport ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Hobbies') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->hobbies ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Renseignements militaires --}}
                    <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                        <div class="pt-3 sm:pt-5 w-100">
                            <div class="d-flex justify-content-between">
                                <h2 class="text-xl font-semibold text-black dark:text-white">{{ __('Renseignements militaires')}}</h2>
                                <a href="{{ route('personnel.edit', $profile->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                            </div>
                            <div class="mt-4 text-sm/relaxed">
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Armée') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->army ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Position') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->position ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de position') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->position_date)->format('d/m/Y') ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Référence de position') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->position_reference ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Grade') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profileRank->rank_name ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de nomination') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->rank_date)->format('d/m/Y') ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Fonction actuelle') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->current_function ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Numéro d\'enregistrement militaire') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_registration_number ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Numéro de carte militaire') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_id_card_number ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Numéro d\'enregistrement financier') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->finance_registration_number ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Origine du recrutement') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->recruitment_origin ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Promotion de recrutement') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->recruitment_promotion ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date d\'entrée en service') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->service_entry_date)->format('d/m/Y') ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Affectation au corps') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->corps_assignment ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Affectation à l\'unité') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->unit_assignment ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Spécialité') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->specialty ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Affectation exacte') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->exact_assignment ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de début d\'interruption') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->interruption_start_date)->format('d/m/Y') ?? '-'}}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Date de fin d\'interruption') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ optional($profile->militaryDetail->interruption_end_date)->format('d/m/Y') ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Statut militaire') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_status ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Référence du statut militaire') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_status_reference ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Permis de conduire militaire') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->military_driver_license ?? '-' }}</p>
                                </div>
                                <div class="my-3">
                                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Autres informations') }}</p>
                                    <p class="mt-1 text-sm text-gray-600">{{ $profile->militaryDetail->other_information ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a
                        href="https://laravel-news.com"
                        class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                    >
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g fill="#FF2D20"><path d="M8.75 4.5H5.5c-.69 0-1.25.56-1.25 1.25v4.75c0 .69.56 1.25 1.25 1.25h3.25c.69 0 1.25-.56 1.25-1.25V5.75c0-.69-.56-1.25-1.25-1.25Z"/><path d="M24 10a3 3 0 0 0-3-3h-2V2.5a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2V20a3.5 3.5 0 0 0 3.5 3.5h17A3.5 3.5 0 0 0 24 20V10ZM3.5 21.5A1.5 1.5 0 0 1 2 20V3a.5.5 0 0 1 .5-.5h14a.5.5 0 0 1 .5.5v17c0 .295.037.588.11.874a.5.5 0 0 1-.484.625L3.5 21.5ZM22 20a1.5 1.5 0 1 1-3 0V9.5a.5.5 0 0 1 .5-.5H21a1 1 0 0 1 1 1v10Z"/><path d="M12.751 6.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 7.3v-.5a.75.75 0 0 1 .751-.753ZM12.751 10.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 11.3v-.5a.75.75 0 0 1 .751-.753ZM4.751 14.047h10a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-10A.75.75 0 0 1 4 15.3v-.5a.75.75 0 0 1 .751-.753ZM4.75 18.047h7.5a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-7.5A.75.75 0 0 1 4 19.3v-.5a.75.75 0 0 1 .75-.753Z"/></g></svg>
                        </div>

                        <div class="pt-3 sm:pt-5">
                            <h2 class="text-xl font-semibold text-black dark:text-white">Demande d'approbation</h2>

                            <p class="mt-4 text-sm/relaxed">
                                Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.
                            </p>
                        </div>

                        <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                    </a>

                    <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <g fill="#FF2D20">
                                    <path
                                        d="M16.597 12.635a.247.247 0 0 0-.08-.237 2.234 2.234 0 0 1-.769-1.68c.001-.195.03-.39.084-.578a.25.25 0 0 0-.09-.267 8.8 8.8 0 0 0-4.826-1.66.25.25 0 0 0-.268.181 2.5 2.5 0 0 1-2.4 1.824.045.045 0 0 0-.045.037 12.255 12.255 0 0 0-.093 3.86.251.251 0 0 0 .208.214c2.22.366 4.367 1.08 6.362 2.118a.252.252 0 0 0 .32-.079 10.09 10.09 0 0 0 1.597-3.733ZM13.616 17.968a.25.25 0 0 0-.063-.407A19.697 19.697 0 0 0 8.91 15.98a.25.25 0 0 0-.287.325c.151.455.334.898.548 1.328.437.827.981 1.594 1.619 2.28a.249.249 0 0 0 .32.044 29.13 29.13 0 0 0 2.506-1.99ZM6.303 14.105a.25.25 0 0 0 .265-.274 13.048 13.048 0 0 1 .205-4.045.062.062 0 0 0-.022-.07 2.5 2.5 0 0 1-.777-.982.25.25 0 0 0-.271-.149 11 11 0 0 0-5.6 2.815.255.255 0 0 0-.075.163c-.008.135-.02.27-.02.406.002.8.084 1.598.246 2.381a.25.25 0 0 0 .303.193 19.924 19.924 0 0 1 5.746-.438ZM9.228 20.914a.25.25 0 0 0 .1-.393 11.53 11.53 0 0 1-1.5-2.22 12.238 12.238 0 0 1-.91-2.465.248.248 0 0 0-.22-.187 18.876 18.876 0 0 0-5.69.33.249.249 0 0 0-.179.336c.838 2.142 2.272 4 4.132 5.353a.254.254 0 0 0 .15.048c1.41-.01 2.807-.282 4.117-.802ZM18.93 12.957l-.005-.008a.25.25 0 0 0-.268-.082 2.21 2.21 0 0 1-.41.081.25.25 0 0 0-.217.2c-.582 2.66-2.127 5.35-5.75 7.843a.248.248 0 0 0-.09.299.25.25 0 0 0 .065.091 28.703 28.703 0 0 0 2.662 2.12.246.246 0 0 0 .209.037c2.579-.701 4.85-2.242 6.456-4.378a.25.25 0 0 0 .048-.189 13.51 13.51 0 0 0-2.7-6.014ZM5.702 7.058a.254.254 0 0 0 .2-.165A2.488 2.488 0 0 1 7.98 5.245a.093.093 0 0 0 .078-.062 19.734 19.734 0 0 1 3.055-4.74.25.25 0 0 0-.21-.41 12.009 12.009 0 0 0-10.4 8.558.25.25 0 0 0 .373.281 12.912 12.912 0 0 1 4.826-1.814ZM10.773 22.052a.25.25 0 0 0-.28-.046c-.758.356-1.55.635-2.365.833a.25.25 0 0 0-.022.48c1.252.43 2.568.65 3.893.65.1 0 .2 0 .3-.008a.25.25 0 0 0 .147-.444c-.526-.424-1.1-.917-1.673-1.465ZM18.744 8.436a.249.249 0 0 0 .15.228 2.246 2.246 0 0 1 1.352 2.054c0 .337-.08.67-.23.972a.25.25 0 0 0 .042.28l.007.009a15.016 15.016 0 0 1 2.52 4.6.25.25 0 0 0 .37.132.25.25 0 0 0 .096-.114c.623-1.464.944-3.039.945-4.63a12.005 12.005 0 0 0-5.78-10.258.25.25 0 0 0-.373.274c.547 2.109.85 4.274.901 6.453ZM9.61 5.38a.25.25 0 0 0 .08.31c.34.24.616.561.8.935a.25.25 0 0 0 .3.127.631.631 0 0 1 .206-.034c2.054.078 4.036.772 5.69 1.991a.251.251 0 0 0 .267.024c.046-.024.093-.047.141-.067a.25.25 0 0 0 .151-.23A29.98 29.98 0 0 0 15.957.764a.25.25 0 0 0-.16-.164 11.924 11.924 0 0 0-2.21-.518.252.252 0 0 0-.215.076A22.456 22.456 0 0 0 9.61 5.38Z"
                                    />
                                </g>
                            </svg>
                        </div>

                        <div class="pt-3 sm:pt-5">
                            <h2 class="text-xl font-semibold text-black dark:text-white">Demande d'approbation</h2>

                            <p class="mt-4 text-sm/relaxed">
                                Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Forge</a>, <a href="https://vapor.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Vapor</a>, <a href="https://nova.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Nova</a>, <a href="https://envoyer.io" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Envoyer</a>, and <a href="https://herd.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Herd</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://laravel.com/docs/billing" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Cashier</a>, <a href="https://laravel.com/docs/dusk" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Dusk</a>, <a href="https://laravel.com/docs/broadcasting" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Echo</a>, <a href="https://laravel.com/docs/horizon" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Horizon</a>, <a href="https://laravel.com/docs/sanctum" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Sanctum</a>, <a href="https://laravel.com/docs/telescope" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Telescope</a>, and more.
                            </p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
