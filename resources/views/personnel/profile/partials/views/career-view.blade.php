<div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
    <div class="d-flex justify-content-between">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Parcours professionnel') }}</h3>
        <div class="dropdown">
            <button class="btn" type="button" id="careerDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                <i class="fas fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="careerDropdown">
                <li>
                    <button type="button" class="dropdown-item"
                        data-bs-toggle="modal"
                        data-bs-target="#careerModal"
                        data-action="{{ route('professional_careers.store', ['profile' => $profile->id]) }}"
                        data-method="POST"
                        data-title="Ajout d'un parcours">
                        Ajouter
                    </button>
                </li>
                @if(!$profile->professionalCareers->isEmpty() && $profile->professionalCareers->count()>1)
                    <li>
                        <form action="{{ route('professional_careers.destroyAll', ['profile' => $profile->id]) }}" method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer tous les parcours professionnels ?')">
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
    @forelse ($profile->professionalCareers as $professional)
        <div class="row g-3">
            <div class="col-md-2">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Lieu d\'emploi') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $professional->company_name ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Emploi tenu') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $professional->job_title ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Début d\'affectation') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ optional($professional->start_date)->format('d/m/Y') ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Fin d\'affectation') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ optional($professional->end_date)->format('d/m/Y') ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Référence') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $professional->description ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-1 text-end">
                <div class="dropdown">
                    <button class="btn" type="button" id="careerFieldDropdown{{ $professional->id }}" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                        <i class="fas fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="careerFieldDropdown{{ $professional->id }}">
                        <li>
                            <button type="button" class="dropdown-item"
                                data-bs-toggle="modal"
                                data-bs-target="#careerModal"
                                data-action="{{ route('professional_careers.update', ['profile' => $profile->id, 'id' => $professional->id, 'auth' => $auth ?? false]) }}"
                                data-method="PUT"
                                data-title="Modification d'un parcours"
                                data-company_name="{{ $professional->company_name }}"
                                data-job_title="{{ $professional->job_title }}"
                                data-start_date="{{ optional($professional->start_date)->format('Y-m-d') }}"
                                data-end_date="{{ optional($professional->end_date)->format('Y-m-d') }}"
                                data-description="{{ $professional->description }}">
                                Modifier
                            </button>
                        </li>
                        <li>
                            <form action="{{ route('professional_careers.destroy', ['profile' => $profile->id, 'id' => $professional->id]) }}" method="POST"
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
        <hr class="my-2">
    @empty
        <div class="my-2">
            <p class="mt-1 text-sm text-gray-600">{{ __('Aucune information professionnelle enregistrée') }}</p>
        </div>
    @endforelse
</div>
