<div class="modal fade" id="rankModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form id="rankForm" method="POST" onsubmit="return validateRankForm(this);">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-lg font-medium text-gray-900" id="rankModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pb-4 row g-3">

                    <!-- Grade -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="history_rank" :value="__('Grade')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Rang militaire" role="img" aria-label="Rang militaire"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-select-input id="history_rank" name="history_rank">
                                <option value="">Choisir à la sélection</option>
                                @foreach($selectRanks as $selectRank)
                                    <option value="{{ $selectRank->rank_abbreviate }}" title="{{ $selectRank->rank_abbreviate }}">{{ $selectRank->rank_name }}</option>
                                @endforeach
                            </x-select-input>
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Date d'effet -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="history_promotion_date" :value="__('Date d\'effet')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Pour compter de" role="img" aria-label="Pour compter de"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="history_promotion_date" name="history_promotion_date" type="date" />
                            <span class="error-message text-danger"></span>
                        </div>

                        <!-- Référence -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="history_rank_reference" :value="__('Référence')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décision ou décret" role="img" aria-label="Décision ou décret"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="history_rank_reference" name="history_rank_reference" type="text"
                                        placeholder="Entrer décision ou décret" />
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

<!-- Configuration rank modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rankModal = document.getElementById('rankModal');
        const rankForm = document.getElementById('rankForm');

        rankModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Bouton qui a déclenché le modal
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method');
            const title = button.getAttribute('data-title');

            // Mettre à jour l'action, la méthode, et le titre du formulaire
            rankForm.setAttribute('action', action);
            rankForm.setAttribute('method', method === 'POST' ? 'POST' : 'POST'); // PATCH via "_method"
            document.getElementById('rankModalLabel').textContent = title;

            // Pré-remplir les champs si c'est une édition
            const history_rank = button.getAttribute('data-history_rank') || '';
            const history_promotion_date = button.getAttribute('data-history_promotion_date') || '';
            const history_rank_reference = button.getAttribute('data-history_rank_reference') || '';

            document.getElementById('history_rank').value = history_rank;
            document.getElementById('history_promotion_date').value = history_promotion_date;
            document.getElementById('history_rank_reference').value = history_rank_reference;


            let methodField = rankForm.querySelector('input[name="_method"]');
            if (!methodField && method === 'PUT') {
                methodField = document.createElement('input');
                methodField.setAttribute('type', 'hidden');
                methodField.setAttribute('name', '_method');
                rankForm.appendChild(methodField);
            }
            if (methodField) methodField.setAttribute('value', method);
        });

        rankModal.addEventListener('hidden.bs.modal', function () {
            // Réinitialiser le formulaire après fermeture
            rankForm.reset();
            rankForm.removeAttribute('action');
            const methodField = rankForm.querySelector('input[name="_method"]');
            if (methodField) methodField.remove();
            // Réinitialiser les erreurs
            rankForm.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            rankForm.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));
        });
    });
</script>

<!-- Script de validation des champs -->
<script>
    function validateRankForm(form) {
        const isValidDate = (date) => !isNaN(new Date(date).getTime());
        let isValid = true;

        // Réinitialiser les messages d'erreur
        form.querySelectorAll('.error-message').forEach(e => e.textContent = '');
        form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

        // Champs à valider
        const fields = {
            'history_rank': {
                value: form.history_rank.value.trim(),
                rules: [
                    { test: v => !!v, message: "Le grade est requis." },
                    { test: v => v.length <= 255, message: "255 caractères max." }
                ]
            },
            'history_promotion_date': {
                value: form.history_promotion_date.value.trim(),
                rules: [
                    { test: v => !!v, message: "Date requise." },
                    { test: v => isValidDate(v), message: "Date invalide." }
                ]
            },
            'history_rank_reference': {
                value: form.history_rank_reference.value.trim(),
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
