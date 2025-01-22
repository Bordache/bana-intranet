<div class="modal fade" id="childModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form id="childForm" method="POST" onsubmit="return validateChildForm(this);">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-lg font-medium text-gray-900" id="childModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="children-path pb-4 row g-3">

                       <!-- Nom complet -->
                       <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="child_full_name" :value="__('Nom et prénom(s)')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom et prénoms" role="img" aria-label="Nom et prénoms"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="child_full_name" name="child_full_name" type="text"
                                        placeholder="Entrer nom et prénoms"/>
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Date de naissance -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="child_birth_date" :value="__('Date de naissance')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de naissance" role="img" aria-label="Date de naissance"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="child_birth_date" name="child_birth_date" type="date" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Lieu de naissance -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="child_birth_place" :value="__('Lieu de naissance')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de naissance" role="img" aria-label="Lieu de naissance"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="child_birth_place" name="child_birth_place" type="text"
                                        placeholder="Entrer lieu de naissance" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Genre -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="child_gender" :value="__('Genre')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Genre" role="img" aria-label="Genre"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-select-input id="child_gender" name="child_gender" >
                                <option value="">{{ __('Choisir à la sélection') }}</option>
                                <option value="Masculin">{{ __('Masculin') }}</option>
                                <option value="Féminin">{{ __('Féminin') }}</option>
                            </x-select-input>
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Statut de l'enfant -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="child_status" :value="__('Situation de l\'enfant')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Statut de l'enfant" role="img" aria-label="Statut de l'enfant"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-select-input id="child_status" name="child_status" >
                                <option value="">{{ __('Choisir à la sélection') }}</option>
                                <option value="Légitime">{{ __('Légitime') }}</option>
                                <option value="Reconnu">{{ __('Reconnu') }}</option>
                                <option value="Adopté">{{ __('Adopté') }}</option>
                                <option value="Non légitime">{{ __('Non légitime') }}</option>
                            </x-select-input>
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

<!-- Configuration child modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const childModal = document.getElementById('childModal');
        const childForm = document.getElementById('childForm');

        childModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Bouton qui a déclenché le modal
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method');
            const title = button.getAttribute('data-title');

            // Mettre à jour l'action, la méthode, et le titre du formulaire
            childForm.setAttribute('action', action);
            childForm.setAttribute('method', method === 'POST' ? 'POST' : 'POST'); // PATCH via "_method"
            document.getElementById('childModalLabel').textContent = title;

            // Pré-remplir les champs si c'est une édition
            const fullName = button.getAttribute('data-full_name') || '';
            const birthDate = button.getAttribute('data-birth_date') || '';
            const birthPlace = button.getAttribute('data-birth_place') || '';
            const gender = button.getAttribute('data-gender') || '';
            const status = button.getAttribute('data-status') || '';

            document.getElementById('child_full_name').value = fullName;
            document.getElementById('child_birth_date').value = birthDate;
            document.getElementById('child_birth_place').value = birthPlace;
            document.getElementById('child_gender').value = gender;
            document.getElementById('child_status').value = status;


            let methodField = childForm.querySelector('input[name="_method"]');
            if (!methodField && method === 'PUT') {
                methodField = document.createElement('input');
                methodField.setAttribute('type', 'hidden');
                methodField.setAttribute('name', '_method');
                childForm.appendChild(methodField);
            }
            if (methodField) methodField.setAttribute('value', method);
        });

        childModal.addEventListener('hidden.bs.modal', function () {
            // Réinitialiser le formulaire après fermeture
            childForm.reset();
            childForm.removeAttribute('action');
            const methodField = childForm.querySelector('input[name="_method"]');
            if (methodField) methodField.remove();
        });
    });
</script>

<!-- Script de validation des champs -->
<script>
    function validateChildForm(form) {
        const isValidDate = (date) => !isNaN(new Date(date).getTime());
        let isValid = true;

        // Réinitialiser les messages d'erreur
        form.querySelectorAll('.error-message').forEach(e => e.textContent = '');
        form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

        // Champs à valider
        const fields = {
            'child_full_name': {
                value: form.child_full_name.value.trim(),
                rules: [
                    { test: v => !!v, message: "Le nom complet est requis." },
                    { test: v => /^[a-zA-ZÀ-ÿ\s\-\'\.]+$/.test(v), message: "Caractères non valides." },
                    { test: v => v.length <= 255, message: "255 caractères max." }
                ]
            },
            'child_birth_date': {
                value: form.child_birth_date.value.trim(),
                rules: [
                    { test: v => !!v, message: "Date requise." },
                    { test: v => isValidDate(v), message: "Date invalide." }
                ]
            },
            'child_gender': {
                value: form.child_gender.value.trim(),
                rules: [
                    { test: v => !!v, message: "Veuillez sélectionner une option." }
                ]
            }
        };

        // Valider les champs
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
</script>
