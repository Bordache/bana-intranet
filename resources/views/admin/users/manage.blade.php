<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <!-- Formulaire pour assigner un rôle à un utilisateur -->
        <div class="card mb-4">
            <div class="card-header">Attribuer un Rôle</div>
            <div class="card-body">
                <form action="{{ route('users.assignRole') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Utilisateur</label>
                        <select name="user_id" class="form-control" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label">Rôle</label>
                        <select name="role_id" class="form-control" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 {{ $param ? 'hidden' : '' }}">
                        <label for="domain_id" class="form-label">Domaine</label>
                        <select name="domain_id" class="form-control" required>
                            @foreach($domains as $domain)
                                <option value="{{ $domain->id }}">{{ ucfirst($domain->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Assigner Rôle</button>
                </form>
            </div>
        </div>

        <!-- Liste des utilisateurs et de leurs rôles -->
        <div class="card">
            <div class="card-header">Utilisateurs et leurs Rôles</div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Identifiant</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider {{ $param ? ' hidden' : '' }}">Domaine</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dernier accès au site</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @foreach ($domains as $domain)
                                @php
                                    $userRole = $user->roles->firstWhere('pivot.domain_id', $domain->id);
                                @endphp
                                <tr>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $user->militaryDetail?->rank?->rank_abbreviate ?? 'Aucun' }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $user->name. ' '.$user->firstname }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $user->username }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900 {{ $param ? ' hidden' : '' }}">{{ ucfirst($domain->name) }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $userRole ? $userRole->name : 'Aucun' }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        @if ($userRole)
                                            <form action="{{ route('users.removeRole') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <input type="hidden" name="domain_id" value="{{ $domain->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                            </form>
                                        @else
                                            <span class="text-muted">Aucun rôle</span>
                                        @endif
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
