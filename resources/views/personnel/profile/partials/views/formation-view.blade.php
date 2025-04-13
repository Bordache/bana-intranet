<div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
    <div class="d-flex justify-content-between">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Parcours militaire') }}</h3>
        <div class="dropdown">
            <button class="btn" type="button" id="militaryDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                <i class="fas fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="militaryDropdown">
                <li>
                    <button type="button" class="dropdown-item"
                        data-bs-toggle="modal"
                        data-bs-target="#academyModal"
                        data-action="{{ route('military_paths.store', ['profile' => $profile->id]) }}"
                        data-method="POST"
                        data-title="Ajout d'un parcours">
                        Ajouter
                    </button>
                </li>
                @if(!$profile->militaryPaths->isEmpty() && $profile->militaryPaths->count()>1)
                    <li>
                        <form action="{{ route('military_paths.destroyAll', ['profile' => $profile->id]) }}" method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer tous les parcours militaires ?')">
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
    @forelse ($profile->militaryPaths as $military)
        <div class="row g-3">
            <div class="col-md-3">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Centre ou école') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $military->academy_name ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Période') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $military->academy_duration ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Diplômes, certificats ou attestations obtenus') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $military->academy_diploma ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-1 text-end">
                <div class="dropdown">
                    <button class="btn" type="button" id="militaryFieldDropdown{{ $military->id }}" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                        <i class="fas fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="militaryFieldDropdown{{ $military->id }}">
                        <li>
                            <button type="button" class="dropdown-item"
                                data-bs-toggle="modal"
                                data-bs-target="#academyModal"
                                data-action="{{ route('military_paths.update', ['profile' => $profile->id, 'id' => $military->id, 'auth' => $auth ?? false]) }}"
                                data-method="PUT"
                                data-title="Modification d'un parcours"
                                data-academy_name="{{ $military->academy_name }}"
                                data-academy_duration="{{ $military->academy_duration }}"
                                data-academy_diploma="{{ $military->academy_diploma }}">
                                Modifier
                            </button>
                        </li>
                        <li>
                            <form action="{{ route('military_paths.destroy', ['profile' => $profile->id, 'id' => $military->id]) }}" method="POST"
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
            <p class="text-sm text-gray-600">{{ __('Aucun parcours enregistré') }}</p>
        </div>
    @endforelse
</div>
