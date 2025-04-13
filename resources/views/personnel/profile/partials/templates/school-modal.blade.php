<div class="modal fade" id="academicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form id="academicForm" method="POST" onsubmit="return validateAcademicForm(this);">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-lg font-medium text-gray-900" id="academicModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pb-4 row g-3">

                    <!-- Établissement fréquenté -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="school_name" :value="__('Etablissement fréquenté')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Ecole, collège, lycée, institut, université ..." role="img" aria-label="Ecole, collège, lycée, institut, université ..."></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="school_name" name="school_name" type="text"
                                        placeholder="Entrer nom de l'établissement fréquenté" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Période -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="duration" :value="__('Période')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Période" role="img" aria-label="Période"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="duration" name="duration" type="text"
                                        placeholder="Entrer période" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Diplômes -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="diploma" :value="__('Sanctions')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Sanctions d'études" role="img" aria-label="Sanctions d'études"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-textarea-input id="diploma" name="diploma" rows="3"
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

<!-- Configuration academic modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const academicModal = document.getElementById('academicModal');
        const academicForm = document.getElementById('academicForm');

        academicModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Bouton qui a déclenché le modal
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method');
            const title = button.getAttribute('data-title');

            // Mettre à jour l'action, la méthode, et le titre du formulaire
            academicForm.setAttribute('action', action);
            academicForm.setAttribute('method', method === 'POST' ? 'POST' : 'POST'); // PATCH via "_method"
            document.getElementById('academicModalLabel').textContent = title;

            // Pré-remplir les champs si c'est une édition
            const schoolName = button.getAttribute('data-school_name') || '';
            const schoolDuration = button.getAttribute('data-duration') || '';
            const schoolDiploma = button.getAttribute('data-diploma') || '';

            document.getElementById('school_name').value = schoolName;
            document.getElementById('duration').value = schoolDuration;
            document.getElementById('diploma').value = schoolDiploma;


            let methodField = academicForm.querySelector('input[name="_method"]');
            if (!methodField && method === 'PUT') {
                methodField = document.createElement('input');
                methodField.setAttribute('type', 'hidden');
                methodField.setAttribute('name', '_method');
                academicForm.appendChild(methodField);
            }
            if (methodField) methodField.setAttribute('value', method);
        });

        academicModal.addEventListener('hidden.bs.modal', function () {
            // Réinitialiser le formulaire après fermeture
            academicForm.reset();
            academicForm.removeAttribute('action');
            const methodField = academicForm.querySelector('input[name="_method"]');
            if (methodField) methodField.remove();
            // Réinitialiser les erreurs
            academicForm.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            academicForm.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));
        });
    });
</script>

<!-- Script de validation des champs -->
<script>
    function validateAcademicForm(form) {
        let isValid = true;

        // Réinitialiser les messages d'erreur
        form.querySelectorAll('.error-message').forEach(e => e.textContent = '');
        form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

        // Champs à valider
        const fields = {
            'school_name': {
                value: form.school_name.value.trim(),
                rules: [
                    { test: v => !!v, message: "Le nom de l'établissement est requis." },
                    { test: v => v.length <= 255, message: "255 caractères max." }
                ]
            },
            'duration': {
                value: form.duration.value.trim(),
                rules: [
                    { test: v => !!v, message: "La période d'enseignement est requise." },
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
