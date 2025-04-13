<div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
    <div class="d-flex justify-content-between">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Grades successifs') }}</h3>
        <div class="dropdown">
            <button class="btn" type="button" id="rankDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                <i class="fas fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="rankDropdown">
                <li>
                    <button type="button" class="dropdown-item"
                        data-bs-toggle="modal"
                        data-bs-target="#rankModal"
                        data-action="{{ route('rank_histories.store', ['profile' => $profile->id]) }}"
                        data-method="POST"
                        data-title="Ajout d'un grade">
                        Ajouter
                    </button>
                </li>
                @if(!$profile->rankHistories->isEmpty() && $profile->rankHistories->count()>1)
                    <li>
                        <form action="{{ route('rank_histories.destroyAll', ['profile' => $profile->id]) }}" method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer tous les grades ?')">
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
    @forelse ($profile->rankHistories as $rank)
        <div class="row g-3">
            <div class="col-md-3">
                <div class="my-2">
                    <p class="text-sm font-medium text-gray-900">{{ __('Grade') }}</p>
                    <p class="text-gray-600">{{ $rank->history_rank ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-2">
                    <p class="text-sm font-medium text-gray-900">{{ __('Date d\'effet') }}</p>
                    <p class="text-gray-600">{{ optional($rank->history_promotion_date)->format('d/m/Y') ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="my-2">
                    <p class="text-sm font-medium text-gray-900">{{ __('Référence') }}</p>
                    <p class="text-gray-600">{{ $rank->history_rank_reference ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-1 text-end">
                <div class="dropdown">
                    <button class="btn" type="button" id="rankFieldDropdown{{ $rank->id }}" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                        <i class="fas fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="rankFieldDropdown{{ $rank->id }}">
                        <li>
                            <button type="button" class="dropdown-item"
                                data-bs-toggle="modal"
                                data-bs-target="#rankModal"
                                data-action="{{ route('rank_histories.update', ['profile' => $profile->id, 'id' => $rank->id, 'auth' => $auth ?? false]) }}"
                                data-method="PUT"
                                data-title="Modification d'un grade"
                                data-history_rank="{{ $rank->history_rank }}"
                                data-history_promotion_date="{{ optional($rank->history_promotion_date)->format('Y-m-d') }}"
                                data-history_rank_reference="{{ $rank->history_rank_reference }}">
                                Modifier
                            </button>
                        </li>
                        <li>
                            <form action="{{ route('rank_histories.destroy', ['profile' => $profile->id, 'id' => $rank->id]) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce grade ?')">
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
            <p class="text-sm text-gray-600">{{ __('Aucun grade enregistré') }}</p>
        </div>
    @endforelse
</div>
