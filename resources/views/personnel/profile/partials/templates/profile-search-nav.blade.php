
<div class="d-flex justify-content-between">
    <div class="d-flex">
        <form action="{{ route('personnel.search') }}" method="GET" class="d-flex justify-content-between">
            <x-text-input id="search" name="search" class="w-auto" type="text"
                placeholder="Entrer mot clé ..." value="{{ $search ?? '' }}" />
            <div class="btn-group ms-2" role="group" aria-label="Button group with nested dropdown">
                <button type="submit" class="btn btn-primary">Rechercher</button>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <li>
                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#searchModal">
                                Recherche multicritère
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
    @if ($expand)
        <div class="text-end">
            <button class="btn btn-secondary" id="expandAllBtn">Tout déplier</button>
            <button class="btn btn-secondary d-none" id="drapeAllBtn">Tout replier</button>
        </div>
    @else
        <div class="btn-group ms-2" role="group" aria-label="Button group with nested dropdown">
            <button id="exportButton" class="btn btn-success"><i class="fas fa-file-export"></i> Exporter</button>
            <div class="btn-group" role="group">
                <button id="btnGroupDropExport" type="button" class="btn btn-success dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                </button>
                <ul class="dropdown-menu p-3 w-max-content" aria-labelledby="btnGroupDropExport">
                    @php
                    $availableFields = [
                        'rank_abbreviate' => 'Grade',
                        'name' => 'Nom',
                        'firstname' => 'Prénoms',
                        'military_registration_number' => 'Matricule',
                        'finance_registration_number' => 'Matricule finance',
                        'unit_abbreviate' => 'Unité',
                        'current_function' => 'Fonction',
                        'specialty' => 'Spécialité',
                        'birth_date' => 'Date de naissance',
                        'rank_date' => 'Date de nomination',
                        'service_entry_date' => 'Date d’entrée en service',
                        'recruitment_promotion' => 'Classe/promotion',
                        'national_id' => 'Numéro CIN',
                        'issue_date' => 'Date CIN',
                        'issue_place' => 'Lieu CIN',
                        'academicPaths.diploma' => 'Diplômes Académiques',
                        'militaryPaths.academy_diploma' => 'Diplômes Militaires',
                        'honoraryDistinctions.honorary_title' => 'Distinctions Honorifiques',
                        'militaryCampaigns.campaign_title' => 'Campagnes Militaires'
                    ];
                @endphp
                    <li class="d-flex">
                        <input type="checkbox" class="form-check-input mb-1" onclick="toggleFieldsCheckboxes(this)">
                        <label class="form-check-label ps-1"> Cocher/décocher toutes<br>les colonnes</label>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    @foreach ($availableFields as $field => $label)
                    <li class="align-middle">
                        <input type="checkbox" class="form-check-input mb-1 export-field" value="{{ $field }}">
                        <label class="form-check-label">{{ $label }}</label>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

</div>

<!-- Modal custom search -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('personnel.customSearch') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Recherche multicritère</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Critères -->

                        <!-- Rank -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="rank_abbreviate" :value="__('Grade')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Grade ou titre" role="img" aria-label="Grade ou titre"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="rank_abbreviate" name="rank_abbreviate" type="text" placeholder="Entrer grade ou titre" />
                        </div>

                        <!-- Unit -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="unit_abbreviate" :value="__('Unité ou lieu d\'emploi')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Unité ou lieu d'affectation" role="img" aria-label="Unité ou lieu d'affectation"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="unit_abbreviate" name="unit_abbreviate" type="text" placeholder="Entrer unité ou lieu d'emploi" />
                        </div>

                        <!-- Service Entry Date -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="service_entry_date_before" :value="__('Date d\'entrée au service')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1"
                                title="Date d'entrée dans le service militaire" role="img"
                                aria-label="Date d'entrée dans le service militaire"></i>
                        </div>
                        <div class="col-md-3">
                            <x-text-input id="service_entry_date_before" name="service_entry_date_before"
                                type="date" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <p> à </p>
                        </div>
                        <div class="col-md-3">
                            <x-text-input id="service_entry_date_after" name="service_entry_date_after"
                                type="date" />
                        </div>

                        <!-- Diplome -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="academic_diploma" :value="__('Diplômes civils')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1"
                                title="Diplômes ou certificats ou attestations civils" role="img"
                                aria-label="Diplômes ou certificats ou attestations civils"></i>
                        </div>
                        <div class="col-md-7">
                            <x-textarea-input id="academic_diploma" name="academic_diploma" rows="3 "
                                placeholder="Entrer diplômes ou certificats ou attestations civils"></x-textarea-input>
                        </div>

                        <!-- Diplome militaire -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="military_diploma" :value="__('Diplômes militaires')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1"
                                title="Diplômes ou certificats ou attestations militaires" role="img"
                                aria-label="Diplômes ou certificats ou attestations militaires"></i>
                        </div>
                        <div class="col-md-7">
                            <x-textarea-input id="military_diploma" name="military_diploma" rows="3 "
                                placeholder="Entrer diplômes ou certificats ou attestations militaires"></x-textarea-input>
                        </div>

                        <!-- Diplome militaire -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="honorary_title" :value="__('Distinctions honorifiques')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décoration" role="img"
                                aria-label="Décoration"></i>
                        </div>
                        <div class="col-md-7">
                            <x-textarea-input id="honorary_title" name="honorary_title" rows="3 "
                                placeholder="Entrer une distinction honorifique"></x-textarea-input>
                        </div>

                        <!-- Campagne militaire -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="campaign_title" :value="__('Campagnes militaires')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Campagne ou manoeuvre militaire" role="img"
                                aria-label="Campagne ou manoeuvre militaire"></i>
                        </div>
                        <div class="col-md-7">
                            <x-textarea-input id="campaign_title" name="campaign_title" rows="3 "
                                placeholder="Entrer une campagne ou manoeuvre militaire"></x-textarea-input>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Coche et décoche des inputs checkbox de la liste -->
<script>
    function toggleFieldsCheckboxes(masterCheckbox) {
        // Récupère tous les checkboxes de la table
        const checkboxes = document.querySelectorAll('.export-field');

        // Pour chaque checkbox, on met son état selon l'état du masterCheckbox
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = masterCheckbox.checked;
        });
    }
</script>
