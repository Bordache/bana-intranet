<div class="modal fade" id="spouseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form id="spouseForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-lg font-medium text-gray-900" id="spouseModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pb-4 row g-3">

                       <!-- Titre -->
                       <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="spouse_title" :value="__('Titre civil')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Titre" role="img" aria-label="Titre"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-select-input id="spouse_title" name="spouse_title">
                                <option value=""  >{{ __('Choisir à la selection') }}</option>
                                <option value="Monsieur" >{{ __('Monsieur') }}</option>
                                <option value="Madame" >{{ __('Madame') }}</option>
                            </x-select-input>
                            <span class="error-message text-danger"></span>
                        </div>
                        <!-- Nom -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="spouse_name" :value="__('Nom')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom d'usage de l'époux(se)" role="img" aria-label="Nom d'usage de l'époux(se)"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="spouse_name" name="spouse_name" type="text" placeholder="Entrer nom"  />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Nom de jeune fille -->
                        <div class="col-md-4 d-flex pt-2 spouse_maiden_name_div">
                            <x-input-label for="spouse_maiden_name" :value="__('Nom de jeune fille')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2 spouse_maiden_name_div">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom de famille de l'épouse avant le mariage (si différent du nom d'usage)" role="img" aria-label="Nom de famille de l'épouse avant le mariage (si différent du nom d'usage)"></i>
                        </div>
                        <div class="col-md-7 text-start spouse_maiden_name_div">
                            <x-text-input id="spouse_maiden_name" name="spouse_maiden_name" type="text" placeholder="Entrer nom de jeune fille"/>
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Prénom(s) -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="spouse_firstname" :value="__('Prénom(s)')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Prénom(s) de naissance" role="img" aria-label="Prénom(s) de naissance"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="spouse_firstname" name="spouse_firstname" type="text" placeholder="Entrer prénom(s)"/>
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Date de naissance -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="spouse_birth_date" :value="__('Date de naissance')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de naissance" role="img" aria-label="Date de naissance"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="spouse_birth_date" name="spouse_birth_date" type="date" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Lieu de naissance -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="spouse_birth_place" :value="__('Lieu de naissance')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de naissance" role="img" aria-label="Lieu de naissance"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="spouse_birth_place" name="spouse_birth_place" type="text" placeholder="Entrer lieu de naissance" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Profession -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="spouse_profession" :value="__('Profession')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Profession ou activité" role="img" aria-label="Profession ou activité"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="spouse_profession" name="spouse_profession" type="text" placeholder="Entrer profession ou activité" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Autorisation de mariage -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="marriage_authorization" :value="__('Autorisation de mariage')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Autorisation de mariage" role="img" aria-label="Autorisation de mariage"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="marriage_authorization" name="marriage_authorization" type="text" placeholder="Entrer autorisation de mariage" />
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
        </form>
    </div>
</div>

<!-- Configuration spouse modal -->
<!-- Script de validation des champs -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const spouseModal = document.getElementById('spouseModal');
        const spouseForm = document.getElementById('spouseForm');

        const submitButton = spouseForm.querySelector('button[type="submit"]');

        const spouseTitleInput = spouseForm.querySelector('#spouse_title');
        const spouseMaidenNameDivs = spouseForm.querySelectorAll('.spouse_maiden_name_div');


        // Fonction pour gérer l'affichage ou le masquage des champs Nom de jeune fille
        function updateSpouseMaidenNameVisibility() {
            if (spouseTitleInput.value === 'Monsieur') {
                spouseMaidenNameDivs.forEach(div => div.classList.add('d-none'));
            } else {
                spouseMaidenNameDivs.forEach(div => div.classList.remove('d-none'));
            }
        }

        // Ajouter un écouteur d'événement pour détecter les changements sur le champ spouse_title
        spouseTitleInput.addEventListener('change', updateSpouseMaidenNameVisibility);

        // Masquer le bouton au départ
        submitButton.style.display = 'none';

        // Activer l'écoute des modifications
        spouseForm.addEventListener('input', function (event) {
            const hasChanged = Array.from(spouseForm.elements).some(input => {
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
        spouseModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method');
            const title = button.getAttribute('data-title');

            // Mettre à jour l'action, la méthode, et le titre du formulaire
            spouseForm.setAttribute('action', action);
            spouseForm.setAttribute('method', method === 'POST' ? 'POST' : 'POST');
            document.getElementById('spouseModalLabel').textContent = title;

            // Pré-remplir les champs
            const fields = [
                'spouse_title',
                'spouse_name',
                'spouse_maiden_name',
                'spouse_firstname',
                'spouse_birth_date',
                'spouse_birth_place',
                'spouse_profession',
                'marriage_authorization'
            ];

            fields.forEach(field => {
                const value = button.getAttribute(`data-${field}`) || '';
                const input = document.getElementById(field);
                if (input) input.value = value;
            });

            // Mettre à jour l'affichage de `spouse_maiden_name_div`
            updateSpouseMaidenNameVisibility();

            // Gérer le champ `_method` pour PUT/PATCH
            let methodField = spouseForm.querySelector('input[name="_method"]');
            if (!methodField && method === 'PUT') {
                methodField = document.createElement('input');
                methodField.setAttribute('type', 'hidden');
                methodField.setAttribute('name', '_method');
                spouseForm.appendChild(methodField);
            }
            if (methodField) methodField.setAttribute('value', method);
        });

        // Réinitialisation à la fermeture du modal
        spouseModal.addEventListener('hidden.bs.modal', function () {
            submitButton.style.display = 'none'; // Masquer le bouton
            spouseForm.reset();
            spouseForm.removeAttribute('action');
            const methodField = spouseForm.querySelector('input[name="_method"]');
            if (methodField) methodField.remove();

            // Réinitialiser les erreurs
            spouseForm.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            spouseForm.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

            // Réinitialiser l'affichage de `spouse_maiden_name_div`
            spouseMaidenNameDivs.forEach(div => div.classList.remove('d-none'));
        });

        // Gestion de la soumission avec validation
        spouseForm.addEventListener('submit', async function (event) {
            event.preventDefault(); // Empêche la soumission par défaut

            const isValid = await validateSpouseForm(spouseForm);

            if (isValid) {
                spouseForm.submit(); // Soumettre le formulaire si valide
            } else {
                console.log("Le formulaire contient des erreurs. Le modal ne sera pas fermé.");
            }
        });

        // Fonction de validation
        async function validateSpouseForm(form) {
            let isValid = true;

            // Réinitialiser les messages d'erreur
            form.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

            const fields = {
                'spouse_name': {
                    value: form.spouse_name.value.trim(),
                    rules: [
                        { test: v => !!v, message: "Le nom est requis." },
                        { test: v => /^[a-zA-ZÀ-ÿ\s\-\'\.]+$/.test(v), message: "Caractères non valides." },
                        { test: v => v.length <= 255, message: "255 caractères max." }
                    ]
                },
                'spouse_maiden_name': {
                    value: form.spouse_maiden_name.value.trim(),
                    rules: [
                        { test: v => v === '' || /^[a-zA-ZÀ-ÿ\s\-\'\.]+$/.test(v), message: "Caractères non valides." },
                        { test: v => v.length <= 255, message: "255 caractères max." }
                    ]
                },
                'spouse_firstname': {
                    value: form.spouse_firstname.value.trim(),
                    rules: [
                        { test: v => v === '' || /^[a-zA-ZÀ-ÿ\s\-\'\.]+$/.test(v), message: "Caractères non valides." },
                        { test: v => v.length <= 255, message: "255 caractères max." }
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
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const spouseModal = document.getElementById('spouseModal');
        const spouseForm = document.getElementById('spouseForm');
        const submitButton = spouseForm.querySelector('button[type="submit"]');
        const spouseTitleInput = spouseForm.querySelector('#spouse_title');
        const spouseMaidenNameDivs = spouseForm.querySelectorAll('.spouse_maiden_name_div');

        // Masquer le bouton au départ
        submitButton.style.display = 'none';

        // Fonction pour gérer l'affichage ou le masquage des champs Nom de jeune fille
        function updateSpouseMaidenNameVisibility() {
            if (spouseTitleInput.value === 'Monsieur') {
                // Masquer tous les éléments avec la classe spouse_maiden_name_div
                spouseMaidenNameDivs.forEach(div => div.classList.add('d-none'));
            } else {
                // Afficher tous les éléments avec la classe spouse_maiden_name_div
                spouseMaidenNameDivs.forEach(div => div.classList.remove('d-none'));
            }
        }

        // Ajouter un écouteur d'événement pour détecter les changements sur le champ spouse_title
        spouseTitleInput.addEventListener('change', updateSpouseMaidenNameVisibility);

        // Activer l'écoute des modifications dans le formulaire
        spouseForm.addEventListener('input', function () {
            const hasChanged = Array.from(spouseForm.elements).some(input => {
                if (input.type === 'hidden' || input.type === 'submit' || input.disabled) {
                    return false;
                }
                return input.defaultValue !== input.value;
            });

            submitButton.style.display = hasChanged ? 'inline-block' : 'none';
        });

        // Gestion de l'ouverture du modal
        spouseModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method') || 'POST';
            const title = button.getAttribute('data-title');

            // Mettre à jour l'action, la méthode et le titre du formulaire
            spouseForm.setAttribute('action', action);
            spouseForm.setAttribute('method', method);
            document.getElementById('spouseModalLabel').textContent = title;

            // Pré-remplir les champs
            const fields = [
                'spouse_title',
                'spouse_name',
                'spouse_maiden_name',
                'spouse_firstname',
                'spouse_birth_date',
                'spouse_birth_place',
                'spouse_profession',
                'marriage_authorization'
            ];

            fields.forEach(field => {
                const value = button.getAttribute(`data-${field}`) || '';
                const input = document.getElementById(field);
                if (input) input.value = value;
            });

            // Mettre à jour l'affichage de `spouse_maiden_name_div`
            updateSpouseMaidenNameVisibility();

            // Gérer le champ `_method` pour PUT/PATCH
            let methodField = spouseForm.querySelector('input[name="_method"]');
            if (!methodField && method !== 'POST') {
                methodField = document.createElement('input');
                methodField.setAttribute('type', 'hidden');
                methodField.setAttribute('name', '_method');
                spouseForm.appendChild(methodField);
            }
            if (methodField) methodField.setAttribute('value', method);
        });

        // Réinitialisation à la fermeture du modal
        spouseModal.addEventListener('hidden.bs.modal', function () {
            submitButton.style.display = 'none'; // Masquer le bouton
            spouseForm.reset();
            spouseForm.removeAttribute('action');
            const methodField = spouseForm.querySelector('input[name="_method"]');
            if (methodField) methodField.remove();

            // Réinitialiser les erreurs
            spouseForm.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            spouseForm.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

            // Réinitialiser l'affichage de `spouse_maiden_name_div`
            spouseMaidenNameDivs.forEach(div => div.classList.remove('d-none'));
        });

        // Gestion de la soumission avec validation
        spouseForm.addEventListener('submit', async function (event) {
            event.preventDefault(); // Empêche la soumission par défaut

            const isValid = await validateSpouseForm(spouseForm);

            if (isValid) {
                spouseForm.submit(); // Soumettre le formulaire si valide
            } else {
                console.log("Le formulaire contient des erreurs. Le modal ne sera pas fermé.");
            }
        });

        // Fonction de validation
        async function validateSpouseForm(form) {
            let isValid = true;

            // Réinitialiser les messages d'erreur
            form.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

            const fields = {
                'spouse_name': {
                    value: form.spouse_name.value.trim(),
                    rules: [
                        { test: v => !!v, message: "Le nom est requis." },
                        { test: v => /^[a-zA-ZÀ-ÿ\s\-\'\.]+$/.test(v), message: "Caractères non valides." },
                        { test: v => v.length <= 255, message: "255 caractères max." }
                    ]
                },
                'spouse_maiden_name': {
                    value: form.spouse_maiden_name.value.trim(),
                    rules: [
                        { test: v => v === '' || /^[a-zA-ZÀ-ÿ\s\-\'\.]+$/.test(v), message: "Caractères non valides." },
                        { test: v => v.length <= 255, message: "255 caractères max." }
                    ]
                },
                'spouse_firstname': {
                    value: form.spouse_firstname.value.trim(),
                    rules: [
                        { test: v => v === '' || /^[a-zA-ZÀ-ÿ\s\-\'\.]+$/.test(v), message: "Caractères non valides." },
                        { test: v => v.length <= 255, message: "255 caractères max." }
                    ]
                }
            };

            // Validation synchrone
            Object.entries(fields).forEach(([name, { value, rules }]) => {
                const input = form.querySelector(`[name="${name}"]`);
                rules.forEach(({ test, message }) => {
                    if (!test(value)) {
                        input.classList.add('is-invalid');
                        input.nextElementSibling.textContent = message;
                        isValid = false;
                    }
                });
            });

            return isValid;
        }
    });
</script> --}}

