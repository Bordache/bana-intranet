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
            {{ __('Utilisateurs') }}
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
                        value="{{ $search }}" />
                    <button type="submit" class="mx-2 btn btn-sm btn-primary">Rechercher</button>
                </form>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="assignRoleModal" tabindex="-1" aria-labelledby="assignRoleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('personnel.users.assignRole') }}" method="POST">
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
                                            <option value="{{ $allUser->id }}">{{ $allUser->name }}
                                                ({{ $allUser->email }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="domain_id" class="form-label">Rôle</label>
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
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Grade</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Utilisateur</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Identifiant</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Domaine</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rôle</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Modifié le</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @php
                                $userDomains = $user->userRoles->pluck('domain_id')->unique(); // Récupérer les domaines uniques de l'utilisateur
                                $rowspan = count($userDomains); // Nombre de lignes nécessaires pour fusionner les cellules
                                $firstRow = true; // Détermine si on est sur la première ligne de l'utilisateur
                            @endphp

                            @foreach ($userDomains as $domain_id)
                                @php
                                    $domain = $domains->firstWhere('id', $domain_id); // Trouver le domaine correspondant
                                    $userRole = $user->roles->firstWhere('pivot.domain_id', $domain_id);
                                @endphp

                                <tr>
                                    @if ($firstRow)
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900"
                                            rowspan="{{ $rowspan }}">
                                            {!! highlight($user->militaryDetail?->rank?->rank_abbreviate ?? 'Aucun', $search) !!}
                                        </td>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900"
                                            rowspan="{{ $rowspan }}">
                                            {!! highlight($user->name, $search) !!} {!! highlight($user->firstname, $search) !!}
                                        </td>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900"
                                            rowspan="{{ $rowspan }}">
                                            {!! highlight($user->username, $search) !!}
                                        </td>
                                    @endif

                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {!! highlight($domain?->domain_description ?? 'Aucun', $search) !!}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {!! highlight($userRole ? $userRole->name : 'Aucun', $search) !!}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {{ $userRole ? $userRole->pivot->updated_at->format('d/m/Y H:i') : null }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn" type="button"
                                                id="userMenuDropdown{{ $user->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false" style="border: none; background: transparent;">
                                                <i class="fas fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-lg-end"
                                                aria-labelledby="userMenuDropdown{{ $user->id }}">
                                                <li>
                                                    <button type="button" class="dropdown-item"
                                                        data-bs-toggle="modal" data-bs-target="#userRoleModal"
                                                        data-action="{{ route('users.assignRole') }}"
                                                        data-method="POST" data-title="Attribution de rôle"
                                                        data-user_id="{{ $user->id }}"
                                                        data-user_username="{{ $user->username }}"
                                                        data-domain_id="{{ $domain->id ?? null }}"
                                                        data-domain_name="{{ $domain->domain_description ?? null}}"
                                                        data-role_id="{{ $userRole ? $userRole->id : null }}">
                                                        Modifier ce rôle
                                                    </button>
                                                </li>
                                                <li>
                                                    @if ($userRole)
                                                        <form action="{{ route('users.removeRole') }}" method="POST"
                                                            class="d-inline"
                                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer le role {{ $userRole->name }} de {{ $user->username }} ?')">
                                                            @csrf
                                                            <input type="hidden" name="user_id"
                                                                value="{{ $user->id }}">
                                                            <input type="hidden" name="domain_id"
                                                                value="{{ $domain->id ?? null }}">
                                                            <button type="submit" class="dropdown-item">
                                                                Supprimer ce rôle
                                                            </button>
                                                        </form>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @php $firstRow = false; @endphp
                            @endforeach
                        @endforeach
                    </tbody>

                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

@php
    function highlight($text, $search)
    {
        if (!$search) {
            return $text;
        }
        return preg_replace('/(' . preg_quote($search, '/') . ')/i', '<mark>$1</mark>', $text);
    }
@endphp
