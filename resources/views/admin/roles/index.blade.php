<x-app-layout>
    <x-slot name="header">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb"
            class="d-flex justify-content-between align-items-center text-sm">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Administration</a></li>
                <li class="breadcrumb-item active" aria-current="page">Paramètres globaux</li>
            </ol>
        </nav>
        <h2 class="pt-3 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rôles et permissions') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        @foreach ($domains as $domain)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">{{ $domain->domain_description }}</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Rôle</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($domain->roles as $role)
                                @php
                                    $roleDomain = $role->pivot;
                                @endphp
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $roleDomain->domain_description }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editRoleModal" data-role_domain_id="{{ $roleDomain->id }}"
                                            data-domain_description="{{ $roleDomain->domain_description }}"
                                            data-role_name="{{ $role->name }}">
                                            Modifier
                                        </button>

                                        <form action="{{ route('admin.roles.delete') }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <input type="hidden" name="role_domain_id" value="{{ $roleDomain->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Supprimer ce rôle ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal d'édition -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel">Modifier le rôle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <form action="{{ route('admin.roles.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="role_domain_id" id="role_domain_id">
                        <div class="mb-3">
                            <label for="role_name" class="form-label">Rôle</label>
                            <input type="text" class="form-control" id="role_name" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="domain_description" class="form-label">Description</label>
                            <input type="text" class="form-control" name="domain_description" id="domain_description"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editRoleModal = document.getElementById('editRoleModal');
        editRoleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            document.getElementById('role_domain_id').value = button.getAttribute(
            'data-role_domain_id');
            document.getElementById('domain_description').value = button.getAttribute(
                'data-domain_description');
            document.getElementById('role_name').value = button.getAttribute('data-role_name');
        });
    });
</script>
