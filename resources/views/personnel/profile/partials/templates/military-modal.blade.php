<form id="militaryForm" method="POST">
    @csrf
    @method('PUT')
    <div class="modal fade" id="militaryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-lg font-medium text-gray-900" id="militaryModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="pb-4 row g-3">

                        <!-- Position -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="position" :value="__('Position')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Position actuelle" role="img" aria-label="Position actuelle"></i>
                                <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-select-input id="position" name="position">
                                    <option value=""  >{{ __('Choisir à la selection') }}</option>
                                    <option value="En activité" >{{ __('En activité') }}</option>
                                    <option value="En service détaché" >{{ __('En service détaché') }}</option>
                                    <option value="En réserve" >{{ __('En réserve') }}</option>
                                    <option value="A la retraite" >{{ __('A la retraite') }}</option>
                                </x-select-input>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Position Date -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="position_date" :value="__('Date de position')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de position actuelle" role="img" aria-label="Date de position actuelle"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="position_date" name="position_date" type="date" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Position Reference -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="position_reference" :value="__('Référence de position')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Référence de position" role="img" aria-label="Référence de position"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="position_reference" name="position_reference" type="text" placeholder="Entrer référence" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Army -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="army" :value="__('Armée')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Sélectionnez l'armée" role="img" aria-label="Sélectionnez l'armée"></i>
                                <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-select-input id="army" name="army" >
                                    <option value="" >{{ __('Choisir à la selection') }}</option>
                                    <option value="Terre" >{{ __('Terre') }}</option>
                                    <option value="Air" >{{ __('Air') }}</option>
                                    <option value="Mer" >{{ __('Mer') }}</option>
                                    <option value="Gendarmerie" >{{ __('Gendarmerie') }}</option>
                                    <option value="Autre" >{{ __('Autre') }}</option>
                                </x-select-input>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Corps Assignment -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="corps_assignment" :value="__('Corps')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Corps" role="img" aria-label="Corps"></i>
                                <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-select-input id="corps_assignment" name="corps_assignment">
                                    <option value="" >{{ __('Choisir à la selection') }}</option>
                                    <option value="BANA" >{{ __('BANA') }}</option>
                                    <option value="BIMA" >{{ __('BIMA') }}</option>
                                    <option value="CORMAR" >{{ __('CORMAR') }}</option>
                                    <option value="BATINF" >{{ __('BATINF') }}</option>
                                </x-select-input>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Unit Assignment -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="unit_id" :value="__('Unité d\'affectation')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Unité support d\'affectation" role="img" aria-label="Unité support d\'affectation"></i>
                                <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-select-input id="unit_id" name="unit_id" >
                                    <option value="" >{{ __('Choisir à la selection') }}</option>
                                    @foreach($selectUnits as $selectUnit)
                                        <option value="{{ $selectUnit->id }}" title="{{ $selectUnit->unit_abbreviate }}" >{{ $selectUnit->unit_name }}</option>
                                    @endforeach
                                </x-select-input>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Exact assignment -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="exact_assignment" :value="__('Lieu d\'emploi exacte (si en service détaché)')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu d'emploi exacte" role="img" aria-label="Lieu d'emploi exacte"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="exact_assignment" name="exact_assignment" type="text" placeholder="Entrer lieu d'emploi exacte" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Rank -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="rank_id" :value="__('Grade')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Rang militaire" role="img" aria-label="Rang militaire"></i>
                                <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-select-input id="rank_id" name="rank_id" >
                                    <option value="" >Choisir à la selection</option>
                                    @foreach($selectRanks as $selectRank)
                                        <option value="{{ $selectRank->id }}" title="{{ $selectRank->rank_abbreviate }}" >{{ $selectRank->rank_name }}</option>
                                    @endforeach
                                </x-select-input>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Rank Date -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="rank_date" :value="__('Date de nomination')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de nomination du grade actuel" role="img" aria-label="Date de nomination du grade actuel"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="rank_date" name="rank_date" type="date" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Military Registration Number -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="military_registration_number" :value="__('Numéro matricule militaire')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Numéro matricule militaire" role="img" aria-label="Numéro matricule militaire"></i>
                                <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="military_registration_number" name="military_registration_number" placeholder="Entrer le numéro matricule militaire" type="text"/>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Finance Registration Number -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="finance_registration_number" :value="__('Numéro matricule finance')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Numéro matricule finance" role="img" aria-label="Numéro matricule finance"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="finance_registration_number" name="finance_registration_number" type="text" placeholder="Entrer le numéro matricule finance" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Specialty -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="specialty" :value="__('Spécialité')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Spécialité militaire" role="img" aria-label="Spécialité militaire"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="specialty" name="specialty" type="text" placeholder="Entrer spécialité" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Current function -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="current_function" :value="__('Fonction actuelle')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Fonction ou emploi actuel" role="img" aria-label="Fonction ou emploi actuel"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="current_function" name="current_function" type="text" placeholder="Entrer fonction ou emploi actuel" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Service Entry Date -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="service_entry_date" :value="__('Date d\'entrée au service')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date d'entrée dans le service militaire" role="img" aria-label="Date d'entrée dans le service militaire"></i>
                                <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="service_entry_date" name="service_entry_date" type="date"/>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Recruitment origin -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="recruitment_origin" :value="__('Origine de recrutement')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu d'origine de recrutement" role="img" aria-label="Lieu d'origine de recrutement"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="recruitment_origin" name="recruitment_origin" type="text" placeholder="Entrer lieu de recrutement" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Recruitment_promotion -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="recruitment_promotion" :value="__('Classe d\'âge ou promotion')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Classe d'âge ou promotion" role="img" aria-label="Classe d'âge ou promotion"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="recruitment_promotion" name="recruitment_promotion" type="text" placeholder="Entrer classe d'âge ou promotion" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Interruption start Date -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="interruption_start_date" :value="__('Début d\'interruption')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date du début d'interruption" role="img" aria-label="Date du début d'interruption"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="interruption_start_date" name="interruption_start_date" type="date" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Interruption end Date -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="interruption_end_date" :value="__('Fin d\'interruption')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de fin d'interruption" role="img" aria-label="Date de fin d'interruption"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="interruption_end_date" name="interruption_end_date" type="date" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Military status -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="military_status" :value="__('Statut militaire')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Statut militaire" role="img" aria-label="Statut militaire"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-select-input id="military_status" name="military_status">
                                    <option value="" >{{ __('Choisir à la selection') }}</option>
                                    <option value="Officier de carrière" >{{ __('Officier de carrière') }}</option>
                                    <option value="SOC" title="Sous-officier de carrière" >{{ __('SOC') }}</option>
                                    <option value="HDRC" title="Homme du rang de carrière" >{{ __('HDRC') }}</option>
                                    <option value="Sous-contrat" title="Sous-contrat" >{{ __('Sous-contrat') }}</option>
                                </x-select-input>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Statut Reference -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="military_status_reference" :value="__('Référence statut')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Référence de statut militaire" role="img" aria-label="Référence de statut militaire"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="military_status_reference" name="military_status_reference" type="text" placeholder="Entrer référence" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Military ID Card Number -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="military_id_card_number" :value="__('Numéro carte militaire')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Numéro de carte militaire" role="img" aria-label="Numéro de carte militaire"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="military_id_card_number" name="military_id_card_number" type="text" placeholder="Entrer numéro de carte militaire" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Military driver licence -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="military_driver_license" :value="__('Permis militaire')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Permis militaire" role="img" aria-label="Permis militaire"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="military_driver_license" name="military_driver_license" type="text" placeholder="Entrer permis militaire" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Other informations -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="other_information" :value="__('Autres informations')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Autres informations" role="img" aria-label="Autres informations"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-textarea-input id="other_information" name="other_information" rows="3" placeholder="Entrer autres informations"></x-textarea-input>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                        <div class="d-flex justify-content-between w-100">
                            <div>
                                <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" role="img" aria-label="Requis"></i>
                                <span class="text-danger">Champs obligatoires</span>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Configuration military modal -->
<!-- Script de validation des champs -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const militaryModal = document.getElementById('militaryModal');
        const militaryForm = document.getElementById('militaryForm');

        const submitButton = militaryForm.querySelector('button[type="submit"]');

        // Masquer le bouton au départ
        submitButton.style.display = 'none';

        // Activer l'écoute des modifications
        militaryForm.addEventListener('input', function (event) {
            const hasChanged = Array.from(militaryForm.elements).some(input => {
                if (input.type === 'hidden' || input.type === 'submit' || input.disabled) {
                    return false;
                }
                return input.defaultValue !== input.value;
            });

            if (hasChanged) {
                submitButton.style.display = 'inline-block'; // Afficher le bouton
            } else {
                submitButton.style.display = 'none'; // Masquer le bouton
            }
        });


        // Gestion de l'ouverture du modal
        militaryModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method');
            const title = button.getAttribute('data-title');

            // Mettre à jour l'action, la méthode, et le titre du formulaire
            militaryForm.setAttribute('action', action);
            militaryForm.setAttribute('method', method === 'POST' ? 'POST' : 'POST');
            document.getElementById('militaryModalLabel').textContent = title;

            // Pré-remplir les champs
            const fields = [
                'army',
                'position',
                'position_date',
                'position_reference',
                'military_registration_number',
                'military_id_card_number',
                'finance_registration_number',
                'recruitment_origin',
                'recruitment_promotion',
                'service_entry_date',
                'corps_assignment',
                'unit_id',
                'rank_id',
                'rank_date',
                'current_function',
                'specialty',
                'exact_assignment',
                'interruption_start_date',
                'interruption_end_date',
                'military_status',
                'military_status_reference',
                'military_driver_license',
                'other_information'
            ];

            fields.forEach(field => {
                const value = button.getAttribute(`data-${field}`) || '';
                const input = document.getElementById(field);
                if (input) input.value = value;
            });

            // Gérer le champ `_method` pour PUT/PATCH
            let methodField = militaryForm.querySelector('input[name="_method"]');
            if (!methodField && method === 'PUT') {
                methodField = document.createElement('input');
                methodField.setAttribute('type', 'hidden');
                methodField.setAttribute('name', '_method');
                militaryForm.appendChild(methodField);
            }
            if (methodField) methodField.setAttribute('value', method);
        });

        // Réinitialisation à la fermeture du modal
        militaryModal.addEventListener('hidden.bs.modal', function () {
            submitButton.style.display = 'none'; // Masquer le bouton
            militaryForm.reset();
            militaryForm.removeAttribute('action');
            const methodField = militaryForm.querySelector('input[name="_method"]');
            if (methodField) methodField.remove();

            // Réinitialiser les erreurs
            militaryForm.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            militaryForm.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));
        });

        // Gestion de la soumission avec validation
        militaryForm.addEventListener('submit', async function (event) {
            event.preventDefault(); // Empêche la soumission par défaut

            const isValid = await validateMilitaryForm(militaryForm);

            if (isValid) {
                militaryForm.submit(); // Soumettre le formulaire si valide
            } else {
                console.log("Le formulaire contient des erreurs. Le modal ne sera pas fermé.");
            }
        });

        // Fonction de validation
        async function validateMilitaryForm(form) {
            let isValid = true;

            // Réinitialiser les messages d'erreur
            form.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

            const fields = {
                /* 'army': {
                    value: form.army.value.trim(),
                    rules: [
                        { test: v => !!v, message: "Ce champ est requis." }
                    ]
                },
                'position': {
                    value: form.position.value.trim(),
                    rules: [
                        { test: v => !!v, message: "Ce champ est requis." }
                    ]
                },
                'military_registration_number': {
                    value: form.military_registration_number.value.trim(),
                    rules: [
                        { test: v => !!v, message: "Le matricule militaire est requis." },
                        { test: v => v.length <= 6, message: "6 caractères max." }
                    ]
                },
                'service_entry_date': {
                    value: form.service_entry_date.value.trim(),
                    rules: [
                        { test: v => !!v, message: "La date d'entrée en service est requise." }
                    ]
                },
                'corps_assignment': {
                    value: form.corps_assignment.value.trim(),
                    rules: [
                        { test: v => !!v, message: "Le corps d'appartenance est requis." }
                    ]
                },
                'unit_id': {
                    value: form.unit_id.value.trim(),
                    rules: [
                        { test: v => !!v, message: "L'unité' d'appartenance est requis." }
                    ]
                },
                'rank_id': {
                    value: form.rank_id.value.trim(),
                    rules: [
                        { test: v => !!v, message: "Le grade est requis." }
                    ]
                } */
            };

            // Validation synchrone
            Object.entries(fields).forEach(([name, { value, rules }]) => {
                const input = form.querySelector(`[name="${name}"]`);
                rules.forEach(({ test, message }) => {
                    if (typeof test === 'function' && !test(value)) {
                        input.classList.add('is-invalid');
                        input.nextElementSibling.textContent = message;
                        isValid = false;
                    }
                });
            });

            // Validation asynchrone
            const asyncValidations = [];
            Object.entries(fields).forEach(([name, { value, rules }]) => {
                const input = form.querySelector(`[name="${name}"]`);
                rules.forEach(({ test, message }) => {
                    if (test instanceof Function && test.constructor.name === 'AsyncFunction') {
                        asyncValidations.push(
                            test(value).then(isValidAsync => {
                                if (!isValidAsync) {
                                    input.classList.add('is-invalid');
                                    input.nextElementSibling.textContent = message;
                                    isValid = false;
                                }
                            })
                        );
                    }
                });
            });

            await Promise.all(asyncValidations);

            return isValid;
        }
    });
</script>
