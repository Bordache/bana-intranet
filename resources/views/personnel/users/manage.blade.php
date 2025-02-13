<x-app-layout>
    <x-slot name="header">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb"
            class="d-flex justify-content-between align-items-center text-sm">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('personnel.index') }}">Personnel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Paramètres</li>
            </ol>
        </nav>
        <h2 class="pt-3 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rôles d\'utilisateurs') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">

        <!-- Liste des utilisateurs et de leurs rôles -->
        @include('admin.users.manage-modal')
        <div class="card d-flex space-between">
            <div class="card-header d-flex justify-content-between">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignRoleModal">
                    <i class="fas fa-plus me-2"></i>Assigner un rôle
                </button>
                <form action="{{ route('users.manage.search') }}" method="GET" class="d-flex">
                    <x-text-input id="search" name="search" class="w-auto" type="text"
                        value="{{ $search }}" placeholder="Entrer un mot clé ..."/>
                    <button type="submit" class="mx-2 btn btn-sm btn-primary">Rechercher</button>
                </form>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="assignRoleModal" tabindex="-1" aria-labelledby="assignRoleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('users.assignRole') }}" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="assignRoleModalLabel">Nouvelle attribution</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">Utilisateur</label>
                                    <select name="user_id" class="form-control" required>
                                        @foreach ($allUsers as $allUser)
                                            <option value="{{ $allUser->id }}">{{ $allUser->grade }} {{ $allUser->name }} {{ $allUser->firstname }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="domain_id" class="form-label">Domaine</label>
                                    <select name="domain_id" class="form-control" required>
                                        @foreach ($domains as $domain)
                                            <option value="{{ $domain->id }}">{{ $domain->domain_description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Rôle</label>
                                    <select name="role_id" class="form-control" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.manage-users-table')
            </div>
        </div>
    </div>
</x-app-layout>
