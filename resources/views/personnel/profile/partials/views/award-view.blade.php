<div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
    <div class="d-flex justify-content-between">
        <h3 class="text-lg font-medium text-gray-900">
            {{ __('Décorations successives') }}</h3>
        <div class="dropdown">
            <button class="btn" type="button" id="awardDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                style="border: none; background: transparent;">
                <i class="fas fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="awardDropdown">
                <li>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#awardModal"
                        data-action="{{ route('honorary_distinctions.store', ['profile' => $profile->id]) }}"
                        data-method="POST" data-title="Ajout d'une distinction honorifique">
                        Ajouter
                    </button>
                </li>
                @if (!$profile->honoraryDistinctions->isEmpty() && $profile->honoraryDistinctions->count() > 1)
                    <li>
                        <form action="{{ route('honorary_distinctions.destroyAll', ['profile' => $profile->id]) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer toutes les distinctions honorifiques de {{ $profile->name . ' ' . $profile->firstname }} ?')">
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
    @forelse ($profile->honoraryDistinctions as $award)
        <div class="row g-3">
            <div class="col-md-3">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ __('Intitulé') }}</p>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ $award->honorary_title ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ __('Promotion') }}</p>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ $award->honorary_promotion ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ __('Référence') }}</p>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ $award->honorary_reference ?? '-' }}</p>
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
                                data-bs-target="#awardModal"
                                data-action="{{ route('honorary_distinctions.update', ['profile' => $profile->id, 'id' => $award->id]) }}"
                                data-method="PUT" data-title="Modification d'une distinction"
                                data-honorary_title="{{ $award->honorary_title }}"
                                data-honorary_promotion="{{ $award->honorary_promotion }}"
                                data-honorary_reference="{{ $award->honorary_reference }}">
                                Modifier
                            </button>
                        </li>
                        <li>
                            <form
                                action="{{ route('honorary_distinctions.destroy', ['profile' => $profile->id, 'id' => $award->id]) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette distinction ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Supprimer" class="dropdown-item">
                                    Supprimer
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-2">
    @empty
        <div class="my-2">
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Aucune décoration enregistrée') }}</p>
        </div>
    @endforelse
</div>
