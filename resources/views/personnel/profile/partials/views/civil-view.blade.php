<div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
    <div class="d-flex justify-content-between">
        <h3 class="text-lg font-medium text-gray-900">
            {{ __('Etat civil') }}</h3>
        <div class="dropdown">
            <button class="btn" type="button" id="civilDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                style="border: none; background: transparent;">
                <i class="fas fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="civilDropdown">
                <li>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#civilModal"
                        data-action="{{ route('personnel.update', ['id' => $profile->id, 'auth' => $auth ?? false ]) }}" data-method="PUT"
                        data-title="Modification d'état civil" data-name="{{ $profile->name }}"
                        data-firstname="{{ $profile->firstname }}"
                        data-birth_date="{{ optional($profile->birth_date)->format('Y-m-d') }}"
                        data-birth_place="{{ $profile->birth_place }}" data-gender="{{ $profile->gender }}"
                        data-national_id="{{ $profile->national_id }}"
                        data-last_national_id="{{ $profile->national_id }}"
                        data-issue_date="{{ optional($profile->issue_date)->format('Y-m-d') }}"
                        data-issue_place="{{ $profile->issue_place }}"
                        data-duplicate_date="{{ optional($profile->duplicate_date)->format('Y-m-d') }}"
                        data-duplicate_place="{{ $profile->duplicate_place }}" data-address="{{ $profile->address }}"
                        data-phone="{{ $profile->phone }}" data-email="{{ $profile->email }}"
                        data-blood_group="{{ $profile->blood_group }}" data-size="{{ $profile->size }}"
                        data-father_name="{{ $profile->father_name }}" data-mother_name="{{ $profile->mother_name }}"
                        data-marital_status="{{ $profile->marital_status }}"
                        data-fallback_address="{{ $profile->fallback_address }}"
                        data-driver_license="{{ $profile->driver_license }}"
                        data-practiced_sport="{{ $profile->practiced_sport }}" data-hobbies="{{ $profile->hobbies }}">
                        Modifier
                    </button>
                </li>
            </ul>
        </div>
    </div>
    <hr class="my-3">
    <div class="row g-3">
        <div class="col-md-6">
            <div class="my-2">
                <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Genre') }}
                </p>
                <p class="mt-1 text-sm text-gray-600">{{ $profile->gender ?? '-' }}
                </p>
            </div>
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
                    <a href="mailto:{{ $profile->email }}" class="underline">{{ $profile->email ?? '-' }}</a>
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
