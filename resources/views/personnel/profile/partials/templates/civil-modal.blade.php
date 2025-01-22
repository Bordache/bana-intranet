<form id="civilForm" method="POST">
    @csrf
    @method('PUT')
    <div class="modal fade" id="civilModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="text-lg font-medium text-gray-900" id="civilModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="pb-4 row g-3">

                        <!-- Gender -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="gender" :value="__('Genre')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Genre" role="img" aria-label="Genre"></i>
                            </div>
                            <div class="col-md-7 text-start ">
                                <x-select-input id="gender" name="gender">
                                    <option value="" >{{ __('Choisir à la selection') }}</option>
                                    <option value="Masculin" >{{ __('Masculin') }}</option>
                                    <option value="Féminin" >{{ __('Féminin') }}</option>
                                </x-select-input>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Name -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="name" :value="__('Nom')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom de naissance" role="img" aria-label="Nom de naissance"></i>
                                <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="name" name="name" type="text" placeholder="Entrer nom" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Firstname -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="firstname" :value="__('Prénom(s)')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Prénom(s) de naissance" role="img" aria-label="Prénom(s) de naissance"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="firstname" name="firstname" type="text" placeholder="Entrer prénom(s)" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Birth Date -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="birth_date" :value="__('Date de naissance')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de naissance" role="img" aria-label="Date de naissance"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="birth_date" name="birth_date" type="date" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Birth Place -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="birth_place" :value="__('Lieu de naissance')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de naissance" role="img" aria-label="Lieu de naissance"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="birth_place" name="birth_place" type="text" placeholder="Entrer lieu de naissance" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- National ID -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="national_id" :value="__('Numéro d\'identité nationale')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Numéro CIN" role="img" aria-label="Numéro CIN"></i>
                                <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <input type="number" id="last_national_id" hidden disabled />
                                <x-text-input id="national_id" name="national_id" type="number" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Issue Date -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="issue_date" :value="__('Date de délivrance')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de délivrance CIN" role="img" aria-label="Date de délivrance CIN"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="issue_date" name="issue_date" type="date" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Issue Place -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="issue_place" :value="__('Lieu de délivrance')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de délivrance CIN" role="img" aria-label="Lieu de délivrance CIN"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="issue_place" name="issue_place" type="text" placeholder="Entrer lieu de délivrance" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Duplicate Date -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="duplicate_date" :value="__('Date de duplication')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de duplicata CIN" role="img" aria-label="Date de duplicata CIN"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="duplicate_date" name="duplicate_date" type="date" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Duplicate Place -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="duplicate_place" :value="__('Lieu de duplication')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de duplicata CIN" role="img" aria-label="Lieu de duplicata CIN"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="duplicate_place" name="duplicate_place" type="text" placeholder="Entrer lieu de duplication" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Address -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="address" :value="__('Adresse actuelle')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Adresse actuelle" role="img" aria-label="Adresse actuelle"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-textarea-input id="address" name="address" rows="3" placeholder="Entrer adresse du domicille"></x-textarea-input>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="phone" :value="__('Numéro téléphone')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Numéro téléphone mobile" role="img" aria-label="Numéro téléphone mobile"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="phone" name="phone" type="tel" placeholder="Entrer numéro de téléphone" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Email -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="email" :value="__('Email')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Adresse électronique" role="img" aria-label="Adresse électronique"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="email" name="email" type="email" placeholder="Entrer adresse email" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Blood Group -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="blood_group" :value="__('Groupe sanguin')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Groupe sanguin" role="img" aria-label="Groupe sanguin"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="blood_group" name="blood_group" type="text" placeholder="Entrer groupe sanguin" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Size -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="size" :value="__('Taille (en cm)')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Taille en centimètre" role="img" aria-label="Taille en centimètre"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="size" name="size" type="number" placeholder="Entrer taille en centimètre" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Father Name -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="father_name" :value="__('Nom du père')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom du père biologique" role="img" aria-label="Nom du père biologique"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="father_name" name="father_name" type="text" placeholder="Entrer nom du père" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Mother Name -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="mother_name" :value="__('Nom de la mère')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom de la mère biologique" role="img" aria-label="Nom de la mère biologique"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="mother_name" name="mother_name" type="text" placeholder="Entrer nom de la mère" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Marital Status -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="marital_status" :value="__('Situation matrimoniale')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Situation matrimoniale" role="img" aria-label="Situation matrimoniale"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-select-input id="marital_status" name="marital_status" >
                                    <option value="" >{{ __('Choisir à la selection') }}</option>
                                    <option value="Célibataire">{{ __('Célibataire') }}</option>
                                    <option value="Marié(e)" >{{ __('Marié(e)') }}</option>
                                    <option value="Divorcé(e)" >{{ __('Divorcé(e)') }}</option>
                                    <option value="Veuf/Veuve" >{{ __('Veuf/Veuve') }}</option>
                                </x-select-input>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Fallback Address -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="fallback_address" :value="__('Adresse de repli')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Adresse de repli" role="img" aria-label="Adresse de repli"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-textarea-input id="fallback_address" name="fallback_address" rows="3" placeholder="Entrer adresse de repli"></x-textarea-input>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Driver licence -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="driver_license" :value="__('Permis de conduire')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Permis de conduire" role="img" aria-label="Permis de conduire"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-text-input id="driver_license" name="driver_license" type="text" placeholder="Entrer catégorie de permis de conduire" />
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Practiced sport -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="practiced_sport" :value="__('Sports pratiqués')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Sports pratiqués" role="img" aria-label="Sports pratiqués"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-textarea-input id="practiced_sport" name="practiced_sport" rows="3" placeholder="Entrer sports pratiqués"></x-textarea-input>
                                <span class="error-message text-danger"></span>
                            </div>

                            <!-- Hobbies -->
                            <div class="col-md-4 d-flex pt-2">
                                <x-input-label for="hobbies" :value="__('Centres d\'intérêts')" />
                            </div>
                            <div class="col-md-1 d-flex pt-2">
                                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Centres d'intérêts" role="img" aria-label="Centres d'intérêts"></i>
                            </div>
                            <div class="col-md-7 text-start">
                                <x-textarea-input id="hobbies" name="hobbies" rows="3" placeholder="Entrer centres d'intérêts"></x-textarea-input>
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

<!-- Configuration civil modal -->
<!-- Script de validation des champs -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const civilModal = document.getElementById('civilModal');
        const civilForm = document.getElementById('civilForm');

        // Gestion de l'ouverture du modal
        civilModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method');
            const title = button.getAttribute('data-title');

            // Mettre à jour l'action, la méthode, et le titre du formulaire
            civilForm.setAttribute('action', action);
            civilForm.setAttribute('method', method === 'POST' ? 'POST' : 'POST');
            document.getElementById('civilModalLabel').textContent = title;

            // Pré-remplir les champs
            const fields = [
                'name', 'firstname', 'gender', 'birth_date', 'birth_place', 'national_id', 'last_national_id',
                'issue_date', 'issue_place', 'duplicate_date', 'address', 'phone', 'email', 'blood_group', 'size',
                'father_name', 'mother_name', 'marital_status', 'fallback_address', 'driver_license',
                'practiced_sport', 'hobbies'
            ];

            fields.forEach(field => {
                const value = button.getAttribute(`data-${field}`) || '';
                const input = document.getElementById(field);
                if (input) input.value = value;
            });

            // Gérer le champ `_method` pour PUT/PATCH
            let methodField = civilForm.querySelector('input[name="_method"]');
            if (!methodField && method === 'PUT') {
                methodField = document.createElement('input');
                methodField.setAttribute('type', 'hidden');
                methodField.setAttribute('name', '_method');
                civilForm.appendChild(methodField);
            }
            if (methodField) methodField.setAttribute('value', method);
        });

        // Réinitialisation à la fermeture du modal
        civilModal.addEventListener('hidden.bs.modal', function () {
            civilForm.reset();
            civilForm.removeAttribute('action');
            const methodField = civilForm.querySelector('input[name="_method"]');
            if (methodField) methodField.remove();

            // Réinitialiser les erreurs
            civilForm.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            civilForm.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));
        });

        // Gestion de la soumission avec validation
        civilForm.addEventListener('submit', async function (event) {
            event.preventDefault(); // Empêche la soumission par défaut

            const isValid = await validateCivilForm(civilForm);

            if (isValid) {
                civilForm.submit(); // Soumettre le formulaire si valide
            } else {
                console.log("Le formulaire contient des erreurs. Le modal ne sera pas fermé.");
            }
        });

        // Fonction de validation
        async function validateCivilForm(form) {
            let isValid = true;

            // Réinitialiser les messages d'erreur
            form.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

            const fields = {
                'name': {
                    value: form.name.value.trim(),
                    rules: [
                        { test: v => !!v, message: "Le nom est requis." },
                        { test: v => /^[a-zA-ZÀ-ÿ\s\-\'\.]+$/.test(v), message: "Caractères non valides." },
                        { test: v => v.length <= 255, message: "255 caractères max." }
                    ]
                },
                'firstname': {
                    value: form.firstname.value.trim(),
                    rules: [
                        { test: v => v === '' || /^[a-zA-ZÀ-ÿ\s\-\'\.]+$/.test(v), message: "Caractères non valides." },
                    ]
                },
                'size': {
                    value: form.size.value.trim(),
                    rules: [
                        { test: v => v === '' || (!isNaN(v) && Number.isInteger(Number(v))), message: "La valeur doit être un entier." },
                        { test: v => v === '' || Number(v) >= 150, message: "La valeur ne doit pas être en dessous de 150." }
                    ]
                },
                'email': {
                    value: form.email.value.trim(),
                    rules: [
                        { test: v => v === '' || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v), message: "L'adresse e-mail n'est pas valide." }
                    ]
                },
                'national_id': {
                    value: form.national_id.value.trim(),
                    rules: [
                        { test: v => !!v, message: "L'identifiant national est requis." },
                        { test: v => /^\d+$/.test(v), message: "L'identifiant national doit être numérique." },
                        { test: v => v.length === 12, message: "L'identifiant national doit contenir exactement 12 chiffres." },
                        {
                            test: async v => {
                                if (v === form.last_national_id.value.trim()) {
                                    return true;
                                };
                                const response = await fetch(`/api/check-national-id/${v}`);
                                const result = await response.json();
                                return result.isUnique;
                            },
                            message: "L'identifiant national existe déjà."
                        }
                    ]
                }
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

