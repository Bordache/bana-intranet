<div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
    <div class="d-flex justify-content-between">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Parcours académique') }}</h3>
        <div class="dropdown">
            <button class="btn" type="button" id="academicDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                <i class="fas fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="academicDropdown">
                <li>
                    <button type="button" class="dropdown-item"
                        data-bs-toggle="modal"
                        data-bs-target="#academicModal"
                        data-action="{{ route('academic_paths.store', ['profile' => $profile->id]) }}"
                        data-method="POST"
                        data-title="Ajout d'un parcours">
                        Ajouter
                    </button>
                </li>
                @if(!$profile->academicPaths->isEmpty() && $profile->academicPaths->count()>1)
                    <li>
                        <form action="{{ route('academic_paths.destroyAll', ['profile' => $profile->id]) }}" method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer tous les parcours académiques ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item">Supprimer tout</button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <hr class="my-3">
    @forelse ($profile->academicPaths as $education)
        <div class="row g-3">
            <div class="col-md-3">
                <div class="my-2">
                    <p class="text-sm font-medium text-gray-900">{{ __('Établissement fréquenté') }}</p>
                    <p class="text-gray-600">{{ $education->school_name ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="my-2">
                    <p class="text-sm font-medium text-gray-900">{{ __('Période') }}</p>
                    <p class="text-gray-600">{{ $education->duration ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="my-2">
                    <p class="text-sm font-medium text-gray-900">{{ __('Diplômes, certificats ou attestations obtenus') }}</p>
                    <p class="text-gray-600">{{ $education->diploma ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-1 text-end">
                <div class="dropdown">
                    <button class="btn" type="button" id="academicFieldDropdown{{ $education->id }}" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                        <i class="fas fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="academicFieldDropdown{{ $education->id }}">
                        <li>
                            <button type="button" class="dropdown-item"
                                data-bs-toggle="modal"
                                data-bs-target="#academicModal"
                                data-action="{{ route('academic_paths.update', ['profile' => $profile->id, 'id' => $education->id, 'auth' => $auth ?? false]) }}"
                                data-method="PUT"
                                data-title="Modification d'un parcours"
                                data-school_name="{{ $education->school_name }}"
                                data-duration="{{ $education->duration }}"
                                data-diploma="{{ $education->diploma }}">
                                Modifier
                            </button>
                        </li>
                        <li>
                            <form action="{{ route('academic_paths.destroy', ['profile' => $profile->id, 'id' => $education->id]) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce parcours ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item">Supprimer</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-3">
    @empty
        <div class="my-2">
            <p class="text-sm text-gray-600">{{ __('Aucune information académique enregistrée') }}</p>
        </div>
    @endforelse
</div>
