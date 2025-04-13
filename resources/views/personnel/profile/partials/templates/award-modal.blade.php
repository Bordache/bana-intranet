<div class="modal fade" id="awardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form id="awardForm" method="POST" onsubmit="return validateAwardForm(this);">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-lg font-medium text-gray-900" id="awardModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pb-4 row g-3">

                        <!-- Intitulé -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="honorary_title" :value="__('Intitulé')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décoration" role="img" aria-label="Décoration"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7">
                            <x-text-input id="honorary_title" name="honorary_title" type="text" placeholder="Entrer intitulé distinction" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Promotion -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="honorary_promotion" :value="__('Promotion')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Promotion" role="img" aria-label="Promotion"></i>
                        </div>
                        <div class="col-md-7">
                            <x-text-input id="honorary_promotion" name="honorary_promotion" type="text" placeholder="Entrer promotion" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Référence -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="honorary_reference" :value="__('Référence')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Référence" role="img" aria-label="Référence"></i>
                        </div>
                        <div class="col-md-7">
                            <x-text-input id="honorary_reference" name="honorary_reference" type="text" placeholder="Entrer référence" />
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

<!-- Configuration award modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const awardModal = document.getElementById('awardModal');
        const awardForm = document.getElementById('awardForm');

        awardModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Bouton qui a déclenché le modal
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method');
            const title = button.getAttribute('data-title');

            // Mettre à jour l'action, la méthode, et le titre du formulaire
            awardForm.setAttribute('action', action);
            awardForm.setAttribute('method', method === 'POST' ? 'POST' : 'POST'); // PATCH via "_method"
            document.getElementById('awardModalLabel').textContent = title;

            // Pré-remplir les champs si c'est une édition
            const honorary_title = button.getAttribute('data-honorary_title') || '';
            const honorary_promotion = button.getAttribute('data-honorary_promotion') || '';
            const honorary_reference = button.getAttribute('data-honorary_reference') || '';

            document.getElementById('honorary_title').value = honorary_title;
            document.getElementById('honorary_promotion').value = honorary_promotion;
            document.getElementById('honorary_reference').value = honorary_reference;


            let methodField = awardForm.querySelector('input[name="_method"]');
            if (!methodField && method === 'PUT') {
                methodField = document.createElement('input');
                methodField.setAttribute('type', 'hidden');
                methodField.setAttribute('name', '_method');
                awardForm.appendChild(methodField);
            }
            if (methodField) methodField.setAttribute('value', method);
        });

        awardModal.addEventListener('hidden.bs.modal', function () {
            // Réinitialiser le formulaire après fermeture
            awardForm.reset();
            awardForm.removeAttribute('action');
            const methodField = awardForm.querySelector('input[name="_method"]');
            if (methodField) methodField.remove();
            // Réinitialiser les erreurs
            awardForm.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            awardForm.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));
        });
    });
</script>

<!-- Script de validation des champs -->
<script>
    function validateAwardForm(form) {
        let isValid = true;

        // Réinitialiser les messages d'erreur
        form.querySelectorAll('.error-message').forEach(e => e.textContent = '');
        form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

        // Champs à valider
        const fields = {
            'honorary_title': {
                value: form.honorary_title.value.trim(),
                rules: [
                    { test: v => !!v, message: "L'intitulé est requis." },
                    { test: v => v.length <= 255, message: "255 caractères max." }
                ]
            },
            'honorary_promotion': {
                value: form.honorary_promotion.value.trim(),
                rules: [
                    { test: v => v.length <= 255, message: "255 caractères max." }
                ]
            },
            'honorary_reference': {
                value: form.honorary_reference.value.trim(),
                rules: [
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
