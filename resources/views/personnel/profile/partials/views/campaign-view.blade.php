<div class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
    <div class="d-flex justify-content-between">
        <h3 class="text-lg font-medium text-gray-900">{{ __('Campagnes militaires') }}</h3>
        <div class="dropdown">
            <button class="btn" type="button" id="campaignDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                <i class="fas fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="campaignDropdown">
                <li>
                    <button type="button" class="dropdown-item"
                        data-bs-toggle="modal"
                        data-bs-target="#campaignModal"
                        data-action="{{ route('campaign_histories.store', ['profile' => $profile->id]) }}"
                        data-method="POST"
                        data-title="Ajout d'une campagne">
                        Ajouter
                    </button>
                </li>
                @if(!$profile->militaryCampaigns->isEmpty() && $profile->militaryCampaigns->count()>1)
                    <li>
                        <form action="{{ route('campaign_histories.destroyAll', ['profile' => $profile->id]) }}" method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer toutes les campagnes militaires ?')">
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
    @forelse ($profile->militaryCampaigns as $campaign)
        <div class="row g-3">
            <div class="col-md-3">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Intitulé') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $campaign->campaign_title ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Période') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $campaign->campaign_period ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="my-2">
                    <p class="mt-1 text-sm font-medium text-gray-900">{{ __('Référence') }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ $campaign->campaign_reference ?? '-' }}</p>
                </div>
            </div>
            <div class="col-md-1 text-end">
                <div class="dropdown">
                    <button class="btn" type="button" id="campaignFieldDropdown{{ $campaign->id }}" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                        <i class="fas fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="campaignFieldDropdown{{ $campaign->id }}">
                        <li>
                            <button type="button" class="dropdown-item"
                                data-bs-toggle="modal"
                                data-bs-target="#campaignModal"
                                data-action="{{ route('campaign_histories.update', ['profile' => $profile->id, 'id' => $campaign->id, 'auth' => $auth ?? false]) }}"
                                data-method="PUT"
                                data-title="Modification d'une campagne"
                                data-campaign_title="{{ $campaign->campaign_title }}"
                                data-campaign_period="{{ $campaign->campaign_period }}"
                                data-campaign_reference="{{ $campaign->campaign_reference }}">
                                Modifier
                            </button>
                        </li>
                        <li>
                            <form action="{{ route('campaign_histories.destroy', ['profile' => $profile->id, 'id' => $campaign->id]) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette campagne ?')">
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
            <p class="mt-1 text-sm text-gray-600">{{ __('Aucune campagne militaire enregistrée') }}</p>
        </div>
    @endforelse
</div>
