<div class="modal fade" id="userRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form id="userRoleForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-lg font-medium text-gray-900" id="userRoleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pb-4 row g-3">

                        <!-- Utilisateur -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="user_username" :value="__('Utilisateur')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Utilisateur"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="user_username" type="text" disabled />
                            <input type="hidden" id="user_id" name="user_id">
                        </div>

                        <!-- Domaine -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="domain_name" :value="__('Domaine')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Domaine"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-text-input id="domain_name" type="text" disabled />
                            <input type="hidden" id="domain_id" name="domain_id">
                        </div>

                        <!-- Rôle -->
                        <div class="col-md-4 d-flex pt-2">
                            <x-input-label for="role_id" :value="__('Rôle')" />
                        </div>
                        <div class="col-md-1 d-flex pt-2">
                            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Rôle"></i>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis"></i>
                        </div>
                        <div class="col-md-7 text-start">
                            <x-select-input id="role_id" name="role_id">
                                <option value="">{{ __('Choisir un rôle') }}</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </x-select-input>
                            <span class="error-message text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1"></i>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userRoleModal = document.getElementById('userRoleModal');
        const userRoleForm = document.getElementById('userRoleForm');
        const formMethod = document.getElementById('formMethod');

        userRoleModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Bouton qui a déclenché le modal
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method') || 'POST';
            const title = button.getAttribute('data-title');

            // Mettre à jour l'action et la méthode
            userRoleForm.setAttribute('action', action);
            formMethod.value = method.toUpperCase();

            document.getElementById('userRoleModalLabel').textContent = title;

            // Pré-remplir les champs
            document.getElementById('user_id').value = button.getAttribute('data-user_id') || '';
            document.getElementById('user_username').value = button.getAttribute('data-user_username') || '';
            document.getElementById('domain_id').value = button.getAttribute('data-domain_id') || '';
            document.getElementById('domain_name').value = button.getAttribute('data-domain_name') || '';
            document.getElementById('role_id').value = button.getAttribute('data-role_id') || '';
        });

        userRoleModal.addEventListener('hidden.bs.modal', function () {
            userRoleForm.reset();
            userRoleForm.removeAttribute('action');
        });
    });

    function validateUserRoleForm(form) {
        let isValid = true;

        // Réinitialiser les messages d'erreur
        form.querySelectorAll('.error-message').forEach(e => e.textContent = '');
        form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));

        // Vérification du rôle
        const roleInput = form.querySelector('#role_id');
        if (!roleInput.value.trim()) {
            roleInput.classList.add('is-invalid');
            roleInput.nextElementSibling.textContent = "Le rôle est requis.";
            isValid = false;
        }

        return isValid;
    }

</script>
