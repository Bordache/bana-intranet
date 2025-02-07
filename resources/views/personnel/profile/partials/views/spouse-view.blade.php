@forelse ($profile->spouseDetails as $spouse)
    <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
        <div class="d-flex justify-content-between">
            <h3 class="text-lg font-medium text-gray-900">
                {{ __('Renseignements conjoint(e)') }}</h3>
            <div class="dropdown">
                <button class="btn" type="button" id="spouseDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                    style="border: none; background: transparent;">
                    <i class="fas fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="spouseDropdown">
                    <li>
                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                            data-bs-target="#spouseModal"
                            data-action="{{ route('spouse_details.update', ['profile' => $profile->id, 'id' => $spouse->id, 'auth' => $auth ?? false]) }}"
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
                        <form
                            action="{{ route('spouse_details.destroy', ['profile' => $profile->id, 'id' => $spouse->id]) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ $spouse->spouse_name . ' ' . $spouse->spouse_firstname }} ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item">
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
    <div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
        <h3 class="text-lg font-medium text-gray-900">
            <div class="d-flex justify-content-between">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __('Renseignements conjoint(e)') }}</h3>
                <button type="button" class="btn btn-sm btn-warning" title="Editer" data-bs-toggle="modal"
                    data-bs-target="#spouseModal"
                    data-action="{{ route('spouse_details.store', ['profile' => $profile->id]) }}" data-method="POST"
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
