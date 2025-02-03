<x-app-layout>
    <x-slot name="header">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb"
            class="d-flex justify-content-between align-items-center text-sm">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('personnel.index') }}">Personnel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profil</li>
            </ol>
        </nav>
        <h2 class="pt-3 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informations générales') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Fenêtre modale -->
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('personnel.search')}}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="searchModalLabel">Recherche personnalisée</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <!-- Critères -->
                                    <!-- Rang -->
                                    <div class="col-md-6">
                                        <label for="rank_id_search" class="form-label">Grade</label>
                                        <select id="rank_id_search" name="rank_id_search" class="form-control">
                                            <option value="">Choisir à la selection</option>
                                            @foreach($selectRanks as $rank)
                                                <option value="{{ $rank->id }}" title="{{ $rank->rank_abbreviate }}" >{{ $rank->rank_abbreviate }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Unité -->
                                    <div class="col-md-6">
                                        <label for="unit_id_search" class="form-label">Unité</label>
                                        <select id="unit_id_search" name="unit_id_search" class="form-control">
                                            <option value="">Choisir à la selection</option>
                                            @foreach($selectUnits as $unit)
                                                <option value="{{ $unit->id }}" title="{{ $unit->unit_abbreviate }}" >{{ $unit->unit_abbreviate }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Date d'entrée en service -->
                                    <div class="col-md-6">
                                        <label for="service_entry_date_start" class="form-label">Date d'entrée en service (Début)</label>
                                        <input type="date" id="service_entry_date_start" name="service_entry_date_start" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="service_entry_date_end" class="form-label">Date d'entrée en service (Fin)</label>
                                        <input type="date" id="service_entry_date_end" name="service_entry_date_end" class="form-control">
                                    </div>

                                    <!-- Diplômes académiques -->
                                    <div class="col-md-6">
                                        <label for="academic_diploma_search" class="form-label">Diplômes académiques</label>
                                        <input type="text" id="academic_diploma_search" name="academic_diploma_search" class="form-control" placeholder="Ex: Bacc, Licence, Master ...">
                                    </div>

                                    <!-- Diplômes militaires -->
                                    <div class="col-md-6">
                                        <label for="military_diploma_search" class="form-label">Diplômes militaires</label>
                                        <input type="text" id="military_diploma_search" name="military_diploma_search" class="form-control" placeholder="Ex: BE, BAT, EMS1 ...">
                                    </div>

                                    <!-- Distinctions honorifiques -->
                                    <div class="col-md-6">
                                        <label for="honorary_title_search" class="form-label">Distinctions honorifiques</label>
                                        <input type="text" id="honorary_title_search" name="honorary_title_search" class="form-control" placeholder="Ex: CHOMM, OFOMM, CHONM ...">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary" >Rechercher</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contenu -->
            <div class="p-4 sm:p-8 bg-white">
                <div class="container">
                    <div class="row g-3">
                        <!-- Photo et Nom -->
                        <div class="d-flex justify-content-between align-items-center bg-light bg-gradient">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center overflow-hidden"
                                    style="width: 100px; height: 100px; font-size: 36px; font-weight: bold; flex-shrink: 0;">
                                    {{-- @if ($profile->photo)
                                        <img src="{{ $profile->photo }}" alt="Photo de profil" class="img-fluid w-100 h-100">
                                    @else --}}
                                    {{ strtoupper(substr($profile->name, 0, 1)) }}{{ strtoupper(substr($profile->firstname, 0, 1)) }}
                                    {{-- @endif --}}
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-1">{{ $profile->name }} {{ $profile->firstname }}</h5>
                                    <p class="text-muted mb-0">{{ $profileRank->rank_name }}</p>
                                </div>
                            </div>
                            @if(auth()->user()->profile_id !== $profile->id)
                                <div>
                                    <ul>
                                        <li class="mb-2">
                                            <a href="{{ route('personnel.create', ['recipient' => $profile->id]) }}"
                                                class="btn btn-sm btn-light d-flex align-items-center">
                                                <i class="fas fa-envelope me-2"></i> Envoyer message
                                            </a>
                                        </li>

                                        <li>
                                            <form action="{{ route('personnel.destroy', $profile->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce détail ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Supprimer"
                                                    class="btn btn-sm btn-danger w-100">Supprimer</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- Navigation -->
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-rens-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-rens" type="button" role="tab" aria-controls="nav-rens"
                                    aria-selected="true">Informations</button>
                                <button class="nav-link" id="nav-perm-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-perm" type="button" role="tab" aria-controls="nav-perm"
                                    aria-selected="false">Congés et permissions</button>
                                <button class="nav-link" id="nav-role-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-role" type="button" role="tab" aria-controls="nav-role"
                                    aria-selected="false">Paramètres</button>
                                <button class="nav-link" id="nav-service-status-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-service-status" type="button" role="tab" aria-controls="nav-service-status"
                                    aria-selected="false">Décompte</button>
                            </div>
                        </nav>

                        <!-- Contents -->
                        <div class="tab-content" id="nav-tabContent">

                            <!-- Renseignements -->
                            <div class="tab-pane fade show active" id="nav-rens" role="tabpanel"
                                aria-labelledby="nav-rens-tab">
                                <div class="d-flex align-items-start">
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <button class="nav-link btn-sm text-start
                                        @if(!session('tab'))
                                            active
                                        @elseif(session('tab') == 'personnal_information')
                                            active
                                        @endif " id="v-pills-civil-status-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-civil-status" type="button"
                                            role="tab" aria-controls="v-pills-civil-status"
                                            aria-selected="true">Etat civil</button>
                                        <button class="nav-link text-start btn-sm {{ session('tab') == 'military_detail' ? 'active' : '' }}" id="v-pills-military-status-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-military-status"
                                            type="button" role="tab" aria-controls="v-pills-military-status"
                                            aria-selected="false">Renseignements militaires</button>
                                        <button class="nav-link text-start btn-sm {{ session('tab') == 'spouse_details' ? 'active' : '' }}" id="v-pills-spouse-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-spouse" type="button"
                                            role="tab" aria-controls="v-pills-spouse"
                                            aria-selected="false">Conjoint(e)</button>
                                        <button class="nav-link text-start btn-sm {{ session('tab') == 'children_details' ? 'active' : '' }}" id="v-pills-children-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-children" type="button"
                                            role="tab" aria-controls="v-pills-children"
                                            aria-selected="false">Enfant(s)</button>
                                        <button class="nav-link text-start btn-sm {{ session('tab') == 'academic_paths' ? 'active' : '' }}" id="v-pills-education-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-education" type="button"
                                            role="tab" aria-controls="v-pills-education"
                                            aria-selected="false">Parcours académique</button>
                                        <button class="nav-link text-start btn-sm {{ session('tab') == 'military_paths' ? 'active' : '' }}" id="v-pills-military-path-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-military-path"
                                            type="button" role="tab" aria-controls="v-pills-military-path"
                                            aria-selected="false">Parcours militaire</button>
                                        <button class="nav-link text-start btn-sm {{ session('tab') == 'professional_careers' ? 'active' : '' }}" id="v-pills-professional-path-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-professional-path"
                                            type="button" role="tab" aria-controls="v-pills-professional-path"
                                            aria-selected="false">Parcours professionnel</button>
                                        <button class="nav-link text-start btn-sm {{ session('tab') == 'rank_histories' ? 'active' : '' }}" id="v-pills-rank-history-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-rank-history"
                                            type="button" role="tab" aria-controls="v-pills-rank-history"
                                            aria-selected="false">Grades successifs</button>
                                        <button class="nav-link text-start btn-sm {{ session('tab') == 'honorary_distinctions' ? 'active' : '' }}" id="v-pills-aware-history-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-aware-history"
                                            type="button" role="tab" aria-controls="v-pills-aware-history"
                                            aria-selected="false">Décorations successives</button>
                                        <button class="nav-link text-start btn-sm {{ session('tab') == 'campaign_histories' ? 'active' : '' }}" id="v-pills-campaign-history-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-campaign-history"
                                            type="button" role="tab" aria-controls="v-pills-campaign-history"
                                            aria-selected="false">Campagnes militaires</button>
                                    </div>
                                    <div class="tab-content w-100" id="v-pills-tabContent">

                                        <!-- Etat civil -->

                                        <div class="tab-pane fade
                                        @if(!session('tab'))
                                            show active
                                        @elseif(session('tab') == 'personnal_information')
                                            show active
                                        @endif
                                        " id="v-pills-civil-status" role="tabpanel"
                                            aria-labelledby="v-pills-civil-status-tab">
                                            @include('personnel.profile.partials.views.civil-view')
                                            @include('personnel.profile.partials.templates.civil-modal')
                                        </div>

                                        <!-- Renseignements militaires -->

                                        <div class="tab-pane fade {{ session('tab') == 'military_detail' ? 'show active' : '' }}" id="v-pills-military-status" role="tabpanel"
                                            aria-labelledby="v-pills-military-status-tab">
                                            @include('personnel.profile.partials.views.military-view')
                                            @include('personnel.profile.partials.templates.military-modal')
                                        </div>

                                        <!-- Conjoint(e) -->

                                        <div class="tab-pane fade {{ session('tab') == 'spouse_details' ? 'show active' : '' }}" id="v-pills-spouse" role="tabpanel"
                                            aria-labelledby="v-pills-spouse-tab">
                                            @include('personnel.profile.partials.views.spouse-view')
                                            @include('personnel.profile.partials.templates.spouse-modal')
                                        </div>

                                        <!-- Enfant(s) -->

                                        <div class="tab-pane fade {{ session('tab') == 'children_details' ? 'show active' : '' }}" id="v-pills-children" role="tabpanel"
                                            aria-labelledby="v-pills-children-tab">
                                            @include('personnel.profile.partials.views.children-view')
                                            @include('personnel.profile.partials.templates.children-modal')
                                        </div>

                                        <!-- Parcours académique -->

                                        <div class="tab-pane fade {{ session('tab') == 'academic_paths' ? 'show active' : '' }}" id="v-pills-education" role="tabpanel"
                                            aria-labelledby="v-pills-education-tab">
                                            @include('personnel.profile.partials.views.school-view')
                                            @include('personnel.profile.partials.templates.school-modal')
                                        </div>

                                        <!-- Parcours militaire -->

                                        <div class="tab-pane fade {{ session('tab') == 'military_paths' ? 'show active' : '' }}" id="v-pills-military-path" role="tabpanel"
                                            aria-labelledby="v-pills-military-path-tab">
                                            @include('personnel.profile.partials.views.formation-view')
                                            @include('personnel.profile.partials.templates.formation-modal')
                                        </div>

                                        <!-- Parcours professionnel -->

                                        <div class="tab-pane fade {{ session('tab') == 'professional_careers' ? 'show active' : '' }}" id="v-pills-professional-path" role="tabpanel"
                                            aria-labelledby="v-pills-professional-path-tab">
                                            @include('personnel.profile.partials.views.career-view')
                                            @include('personnel.profile.partials.templates.career-modal')
                                        </div>

                                        <!-- Grades successifs -->

                                        <div class="tab-pane fade {{ session('tab') == 'rank_histories' ? 'show active' : '' }}" id="v-pills-rank-history" role="tabpanel"
                                            aria-labelledby="v-pills-rank-history-tab">
                                            @include('personnel.profile.partials.views.rank-view')
                                            @include('personnel.profile.partials.templates.rank-modal')
                                        </div>

                                        <!-- Décorations successives -->

                                        <div class="tab-pane fade {{ session('tab') == 'honorary_distinctions' ? 'show active' : '' }}" id="v-pills-aware-history" role="tabpanel"
                                            aria-labelledby="v-pills-aware-history-tab">
                                            @include('personnel.profile.partials.views.award-view')
                                            @include('personnel.profile.partials.templates.award-modal')
                                        </div>

                                        <!-- Campagnes militaires -->

                                        <div class="tab-pane fade {{ session('tab') == 'campaign_histories' ? 'show active' : '' }}" id="v-pills-campaign-history" role="tabpanel"
                                            aria-labelledby="v-pills-campaign-history-tab">
                                            @include('personnel.profile.partials.views.campaign-view')
                                            @include('personnel.profile.partials.templates.campaign-modal')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Permissions -->
                            <div class="tab-pane fade" id="nav-perm" role="tabpanel"
                                aria-labelledby="nav-perm-tab">
                                Congés et permissions
                            </div>

                            <!-- Paramètres -->
                            <div class="tab-pane fade" id="nav-role" role="tabpanel"
                                aria-labelledby="nav-role-tab">Parametres</div>

                            <!-- Décompte -->
                            <div class="tab-pane fade" id="nav-service-status" role="tabpanel"
                                aria-labelledby="nav-service-status-tab">
                                <div class="row g-3">
                                    <div class="col-md-10">
                                        <div class="d-flex align-items-start">
                                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                              <button class="nav-link active text-start" id="v-pills-serv-stat-tab" data-bs-toggle="pill" data-bs-target="#v-pills-serv-stat" type="button" role="tab" aria-controls="v-pills-serv-stat" aria-selected="true">Etat de service</button>
                                              <button class="nav-link text-start" id="v-pills-perm-stat-tab" data-bs-toggle="pill" data-bs-target="#v-pills-perm-stat" type="button" role="tab" aria-controls="v-pills-perm-stat" aria-selected="false">Congés et permissions</button>
                                              <button class="nav-link text-start" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
                                              <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
                                            </div>
                                            <div class="tab-content w-100" id="v-pills-tabContent">
                                                <!-- Etat de service -->
                                                <div class="tab-pane fade show active" id="v-pills-serv-stat" role="tabpanel" aria-labelledby="v-pills-serv-stat-tab">
                                                    <div id="etatService" class="border border-gray-200 p-3 mb-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                                                        <h3 class="text-lg font-medium text-gray-900">
                                                            {{ __('Etat de service') }}</h3>
                                                        <hr class="my-3">
                                                        <div class="row g-3">
                                                            <div class="col-md-3">
                                                                <div class="my-2">
                                                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                                                        {{ __('Age') }}</p>
                                                                    <p id="age" class="mt-1 text-sm text-gray-600">
                                                                        {{ $age ? floor($age) . ' ans' : '-' }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="my-2">
                                                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                                                        {{ __('Ancienneté de service') }}</p>
                                                                    <p id="serviceSeniority" class="mt-1 text-sm text-gray-600">
                                                                        @if ($serviceSeniority)
                                                                            {{ floor($serviceSeniority / 365) }} {{ __('an' . (floor($serviceSeniority / 365) > 1 ? 's' : '')) }},
                                                                            {{ floor(($serviceSeniority % 365) / 30) }} {{ __('mois' . (floor(($serviceSeniority % 365) / 30) > 1 ? '' : '')) }},
                                                                            {{ ($serviceSeniority % 365) % 30 }} {{ __('jour' . (($serviceSeniority % 365) % 30 > 1 ? 's' : '')) }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="my-2">
                                                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                                                        {{ __('Ancienneté de port de grade') }}</p>
                                                                    <p id="rankSeniority" class="mt-1 text-sm text-gray-600">
                                                                        @if ($rankSeniority)
                                                                            {{ floor($rankSeniority / 365) }} {{ __('an' . (floor($rankSeniority / 365) > 1 ? 's' : '')) }},
                                                                            {{ floor(($rankSeniority % 365) / 30) }} {{ __('mois' . (floor(($rankSeniority % 365) / 30) > 1 ? '' : '')) }},
                                                                            {{ ($rankSeniority % 365) % 30 }} {{ __('jour' . (($rankSeniority % 365) % 30 > 1 ? 's' : '')) }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="my-2">
                                                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                                                        {{ __('Date de fin de carrière') }}</p>
                                                                    <p id="careerEndDate" class="mt-1 text-sm text-gray-600">
                                                                        {{ $careerEndDate ? $careerEndDate->format('d/m/Y') : '-' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Congés et permissions -->
                                                <div class="tab-pane fade" id="v-pills-perm-stat" role="tabpanel" aria-labelledby="v-pills-perm-stat-tab">...</div>

                                                <!-- Messages -->
                                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>

                                                <!-- Settings -->
                                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <form id="referenceDateForm">
                                            <div class="mb-3">
                                                <x-input-label for="reference_date" :value="__('Date de référence')" />
                                                <x-text-input id="reference_date" name="reference_date" type="date" :value="now()->format('Y-m-d')" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast -->
    @if(session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="fas fa-check-circle text-success px-2"></i>
                    <strong class="me-auto">Bravo !</strong>
                    <small>A l'instant</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>

        <!-- Script to trigger the toast -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const toastElement = document.getElementById('liveToast');
                const toast = new bootstrap.Toast(toastElement);
                toast.show(); // Automatically display the toast
            });
        </script>
    @endif
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileId = {{ $profile->id }};
        const referenceDateInput = document.getElementById('reference_date');

        referenceDateInput.addEventListener('change', function () {
            updateEtatService(profileId);
        });

        function updateEtatService(profileId) {
            const referenceDate = referenceDateInput.value;

            if (!referenceDate) {
                alert('Veuillez sélectionner une date de référence.');
                return;
            }

            fetch(`/personnel/profile/${profileId}/update-calculations`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                body: JSON.stringify({ reference_date: referenceDate }),
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('age').textContent = data.age
                    ? `${Math.floor(data.age)} an${Math.floor(data.age) > 1 ? 's' : '-'}`
                    : '-';
                document.getElementById('serviceSeniority').textContent = data.serviceSeniority
                    ? `${Math.floor(data.serviceSeniority / 365)} an${Math.floor(data.serviceSeniority / 365) > 1 ? 's' : ''}, ${Math.floor((data.serviceSeniority % 365) / 30)} mois, ${data.serviceSeniority % 365 % 30} jour${data.serviceSeniority % 365 % 30 > 1 ? 's' : ''}`
                    : '-';
                document.getElementById('rankSeniority').textContent = data.rankSeniority
                    ? `${Math.floor(data.rankSeniority / 365)} an${Math.floor(data.rankSeniority / 365) > 1 ? 's' : ''}, ${Math.floor((data.rankSeniority % 365) / 30)} mois, ${data.rankSeniority % 365 % 30} jour${data.rankSeniority % 365 % 30 > 1 ? 's' : ''}`
                    : '-';
                document.getElementById('careerEndDate').textContent = data.careerEndDate ?? '-';
            })
            .catch(error => console.error('Erreur lors de la mise à jour :', error));
        }
    });
</script>

