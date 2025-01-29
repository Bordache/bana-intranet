<div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
    <div class="d-flex justify-content-between">
        <h3 class="text-lg font-medium text-gray-900">
            {{ __('Renseignements militaires') }}</h3>

        <div class="dropdown">
            <button class="btn" type="button" id="militaryDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                style="border: none; background: transparent;">
                <i class="fas fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="militaryDropdown">
                <li>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#militaryModal"
                        data-action="{{ route('military_details.update', ['profile' => $profile->id, 'id' => $profile->militaryDetail->id]) }}"
                        data-method="PUT" data-title="Modification de renseignements militaires"
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
                </li>
            </ul>
        </div>
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
