<div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
    <div class="d-flex justify-content-between">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Enfant(s)') }}
        </h3>
        <div class="dropdown">
            <button class="btn" type="button" id="childDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                style="border: none; background: transparent;">
                <i class="fas fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="childDropdown">
                <li>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#childModal"
                        data-action="{{ route('children_details.store', ['profile' => $profile->id]) }}"
                        data-method="POST" data-title="Ajout d'un enfant">
                        Ajouter
                    </button>
                </li>
                @if (!$profile->childrenDetails->isEmpty() && $profile->childrenDetails->count() > 1)
                    <li>
                        <form action="{{ route('children_details.destroyAll', ['profile' => $profile->id]) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer tous les enfants de {{ $profile->name . ' ' . $profile->firstname }} ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item">
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
            <div class="col-md-4">
                <div class="my-2">
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('Nom et prénoms') }}</p>
                    <p class="text-gray-600">
                        {{ $child->child_full_name ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-2">
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('Date de naissance') }}</p>
                    <p class="text-gray-600">
                        {{ optional($child->child_birth_date)->format('d/m/Y') ?? '-' }}
                    </p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-2">
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('Lieu de naissance') }}</p>
                    <p class="text-gray-600">
                        {{ $child->child_birth_place ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-1">
                <div class="my-2">
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('Genre') }}</p>
                    <p class="text-gray-600">
                        {{ $child->child_gender ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-2">
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('Situation de l\'enfant') }}</p>
                    <p class="text-gray-600">
                        {{ $child->child_status ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-1 text-end">
                <div class="dropdown">
                    <button class="btn" type="button" id="childFieldDropdown{{ $child->id }}"
                        data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                        <i class="fas fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end"
                        aria-labelledby="childFieldDropdown{{ $child->id }}">
                        <li>
                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#childModal"
                                data-action="{{ route('children_details.update', ['profile' => $profile->id, 'id' => $child->id, 'auth' => $auth ?? false]) }}"
                                data-method="PUT" data-title="Modification d'un enfant"
                                data-full_name="{{ $child->child_full_name }}"
                                data-birth_date="{{ $child->child_birth_date->format('Y-m-d') }}"
                                data-birth_place="{{ $child->child_birth_place }}"
                                data-gender="{{ $child->child_gender }}" data-status="{{ $child->child_status }}">
                                Modifier
                            </button>
                        </li>
                        <li>
                            <form
                                action="{{ route('children_details.destroy', ['profile' => $profile->id, 'id' => $child->id]) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ $child->child_full_name }} ?')">
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
        </div>
        <hr class="my-3">
    @empty
        <div class="my-2">
            <p class="text-sm text-gray-600">
                {{ __('Aucun enfant enregistré') }}</p>
        </div>
    @endforelse
</div>
