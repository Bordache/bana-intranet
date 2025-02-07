<div class="modal fade" id="campaignModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form id="campaignForm" method="POST" onsubmit="return validateCampaignForm(this);">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-lg font-medium text-gray-900" id="campaignModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pb-4 row g-3">

                    <!-- Campagne -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="campaign_title" :value="__('Intitulé')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Manoeuvre ou campagne militaire" role="img" aria-label="Manoeuvre ou campagne militaire"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="campaign_title" name="campaign_title" type="text"
                                        placeholder="Manoeuvre ou campagne militaire" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Période -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="campaign_period" :value="__('Période')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Période" role="img" aria-label="Période"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="campaign_period" name="campaign_period" type="text"
                                        placeholder="Entrer période" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Référence -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="campaign_locations" :value="__('Référence')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Document de référence" role="img" aria-label="Document de référence"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-textarea-input id="campaign_locations" name="campaign_locations" rows="3"
                                            placeholder="Document de référence"></x-textarea-input>
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

<!-- Configuration campaign modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const campaignModal = document.getElementById('campaignModal');
        const campaignForm = document.getElementById('campaignForm');

        campaignModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Bouton qui a déclenché le modal
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method');
            const title = button.getAttribute('data-title');

            // Mettre à jour l'action, la méthode, et le titre du formulaire
            campaignForm.setAttribute('action', action);
            campaignForm.setAttribute('method', method === 'POST' ? 'POST' : 'POST'); // PATCH via "_method"
            document.getElementById('campaignModalLabel').textContent = title;

            // Pré-remplir les champs si c'est une édition
            const campaign_title = button.getAttribute('data-campaign_title') || '';
            const campaign_period = button.getAttribute('data-campaign_period') || '';
            const campaign_locations = button.getAttribute('data-campaign_locations') || '';

            document.getElementById('campaign_title').value = campaign_title;
            document.getElementById('campaign_period').value = campaign_period;
            document.getElementById('campaign_locations').value = campaign_locations;


            let methodField = campaignForm.querySelector('input[name="_method"]');
            if (!methodField && method === 'PUT') {
                methodField = document.createElement('input');
                methodField.setAttribute('type', 'hidden');
                methodField.setAttribute('name', '_method');
                campaignForm.appendChild(methodField);
            }
            if (methodField) methodField.setAttribute('value', method);
        });

        campaignModal.addEventListener('hidden.bs.modal', function () {
            // Réinitialiser le formulaire après fermeture
            campaignForm.reset();
            campaignForm.removeAttribute('action');
            const methodField = campaignForm.querySelector('input[name="_method"]');
            if (methodField) methodField.remove();
            // Réinitialiser les erreurs
            campaignForm.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            campaignForm.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));
        });
    });
</script>

<!-- Script de validation des champs -->
<script>
    function validateCampaignForm(form) {
        let isValid = true;

        // Réinitialiser les messages d'erreur
        form.querySelectorAll('.error-message').forEach(e => e.textContent = '');
        form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

        // Champs à valider
        const fields = {
            'campaign_title': {
                value: form.campaign_title.value.trim(),
                rules: [
                    { test: v => !!v, message: "L'intitulé est requis." },
                    { test: v => v.length <= 255, message: "255 caractères max." }
                ]
            },
            'campaign_period': {
                value: form.campaign_period.value.trim(),
                rules: [
                    { test: v => v.length <= 255, message: "255 caractères max." }
                ]
            },
            'campaign_locations': {
                value: form.campaign_locations.value.trim(),
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
