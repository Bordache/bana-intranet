<div class="modal fade" id="academyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form id="academyForm" method="POST" onsubmit="return validateacademyForm(this);">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-lg font-medium text-gray-900" id="academyModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pb-4 row g-3">

                    <!-- Établissement fréquenté -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="academy_name" :value="__('Centre ou école')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Ecole, collège, lycée, institut, université ..." role="img" aria-label="Ecole, collège, lycée, institut, université ..."></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="academy_name" name="academy_name" type="text"
                                        placeholder="Entrer nom du centre ou école fréquenté" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Période -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="academy_duration" :value="__('Période')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Période" role="img" aria-label="Période"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="academy_duration" name="academy_duration" type="text"
                                        placeholder="Entrer période" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Diplômes -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="academy_diploma" :value="__('Sanctions')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Sanctions d'études" role="img" aria-label="Sanctions d'études"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-textarea-input id="academy_diploma" name="academy_diploma" rows="3"
                                            placeholder="Entrer diplômes, certificats ou attestations obtenus"></x-textarea-input>
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

<!-- Configuration academy modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const academyModal = document.getElementById('academyModal');
        const academyForm = document.getElementById('academyForm');

        academyModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Bouton qui a déclenché le modal
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method');
            const title = button.getAttribute('data-title');

            // Mettre à jour l'action, la méthode, et le titre du formulaire
            academyForm.setAttribute('action', action);
            academyForm.setAttribute('method', method === 'POST' ? 'POST' : 'POST'); // PATCH via "_method"
            document.getElementById('academyModalLabel').textContent = title;

            // Pré-remplir les champs si c'est une édition
            const academyName = button.getAttribute('data-academy_name') || '';
            const academyDuration = button.getAttribute('data-academy_duration') || '';
            const academyDiploma = button.getAttribute('data-academy_diploma') || '';

            document.getElementById('academy_name').value = academyName;
            document.getElementById('academy_duration').value = academyDuration;
            document.getElementById('academy_diploma').value = academyDiploma;


            let methodField = academyForm.querySelector('input[name="_method"]');
            if (!methodField && method === 'PUT') {
                methodField = document.createElement('input');
                methodField.setAttribute('type', 'hidden');
                methodField.setAttribute('name', '_method');
                academyForm.appendChild(methodField);
            }
            if (methodField) methodField.setAttribute('value', method);
        });

        academyModal.addEventListener('hidden.bs.modal', function () {
            // Réinitialiser le formulaire après fermeture
            academyForm.reset();
            academyForm.removeAttribute('action');
            const methodField = academyForm.querySelector('input[name="_method"]');
            if (methodField) methodField.remove();
            // Réinitialiser les erreurs
            academyForm.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            academyForm.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));
        });
    });
</script>

<!-- Script de validation des champs -->
<script>
    function validateacademyForm(form) {
        let isValid = true;

        // Réinitialiser les messages d'erreur
        form.querySelectorAll('.error-message').forEach(e => e.textContent = '');
        form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

        // Champs à valider
        const fields = {
            'academy_name': {
                value: form.academy_name.value.trim(),
                rules: [
                    { test: v => !!v, message: "Le nom de l'école ou du centre est requis." },
                    { test: v => v.length <= 255, message: "255 caractères max." }
                ]
            },
            'academy_duration': {
                value: form.academy_duration.value.trim(),
                rules: [
                    { test: v => !!v, message: "La période du stage ou de la formation est requise." },
                    { test: v => v.length <= 255, message: "255 caractères max." }
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
