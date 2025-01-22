<div class="modal fade" id="careerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form id="careerForm" method="POST" onsubmit="return validateCareerForm(this);">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-lg font-medium text-gray-900" id="careerModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pb-4 row g-3">

                    <!-- Lieu d'emploi -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="company_name" :value="__('Lieu d\'emploi')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu d'affectation" role="img" aria-label="Lieu d'affectation"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="company_name" name="company_name" type="text" placeholder="Entrer lieu d'emploi" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Fonction ou emploi -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="job_title" :value="__('Fonction ou emploi tenu')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Fonction ou emploi tenu" role="img" aria-label="Fonction ou emploi tenu"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="job_title" name="job_title" type="text" placeholder="Entrer fonction ou emploi" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Début d'affectation -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="start_date" :value="__('Début d\'affectation')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de début d'affectation" role="img" aria-label="Date de début d'affectation"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="start_date" name="start_date" type="date" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Fin d'affectation -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="end_date" :value="__('Fin d\'affectation')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de fin d'affectation" role="img" aria-label="Date de fin d'affectation"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="end_date" name="end_date" type="date" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Référence -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="description" :value="__('Référence')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décision ou décret" role="img" aria-label="Décision ou décret"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="description" name="description" type="text" placeholder="Entrer décision ou décret" />
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

<!-- Configuration career modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const careerModal = document.getElementById('careerModal');
        const careerForm = document.getElementById('careerForm');

        careerModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Bouton qui a déclenché le modal
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method');
            const title = button.getAttribute('data-title');

            // Mettre à jour l'action, la méthode, et le titre du formulaire
            careerForm.setAttribute('action', action);
            careerForm.setAttribute('method', method === 'POST' ? 'POST' : 'POST'); // PATCH via "_method"
            document.getElementById('careerModalLabel').textContent = title;

            // Pré-remplir les champs si c'est une édition
            const company_name = button.getAttribute('data-company_name') || '';
            const job_title = button.getAttribute('data-job_title') || '';
            const start_date = button.getAttribute('data-start_date') || '';
            const end_date = button.getAttribute('data-end_date') || '';
            const description = button.getAttribute('data-description') || '';

            document.getElementById('company_name').value = company_name;
            document.getElementById('job_title').value = job_title;
            document.getElementById('start_date').value = start_date;
            document.getElementById('end_date').value = end_date;
            document.getElementById('description').value = description;


            let methodField = careerForm.querySelector('input[name="_method"]');
            if (!methodField && method === 'PUT') {
                methodField = document.createElement('input');
                methodField.setAttribute('type', 'hidden');
                methodField.setAttribute('name', '_method');
                careerForm.appendChild(methodField);
            }
            if (methodField) methodField.setAttribute('value', method);
        });

        careerModal.addEventListener('hidden.bs.modal', function () {
            // Réinitialiser le formulaire après fermeture
            careerForm.reset();
            careerForm.removeAttribute('action');
            const methodField = careerForm.querySelector('input[name="_method"]');
            if (methodField) methodField.remove();
        });
    });
</script>

<!-- Script de validation des champs -->
<script>
    function validateCareerForm(form) {
        const isValidDate = (date) => !isNaN(new Date(date).getTime());
        let isValid = true;

        // Réinitialiser les messages d'erreur
        form.querySelectorAll('.error-message').forEach(e => e.textContent = '');
        form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

        // Champs à valider
        const fields = {
            'company_name': {
                value: form.company_name.value.trim(),
                rules: [
                    { test: v => !!v, message: "Le lieu d'emploi est requis." },
                    { test: v => v.length <= 255, message: "255 caractères max." }
                ]
            },
            'job_title': {
                value: form.job_title.value.trim(),
                rules: [
                    { test: v => v.length <= 255, message: "255 caractères max." }
                ]
            },
            'start_date': {
                value: form.start_date.value.trim(),
                rules: [
                    { test: v => !!v, message: "Date requise." },
                    { test: v => isValidDate(v), message: "Date invalide." }
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
