<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des utilisateurs') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <!-- Formulaire d'ajout de Super Admin -->
        <div class="card mb-4">
            <div class="card-header">Définir un Super Administrateur</div>
            <div class="card-body">
                <form action="{{ route('users.assignSuperAdmin') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Utilisateur</label>
                        <select name="user_id" class="form-control" required>
                            @foreach ($users as $user)
                                @if (!in_array($user->id, $superAdmins))
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter Super Admin</button>
                </form>
            </div>
        </div>

        <!-- Liste des Super Admins -->
        <div class="card">
            <div class="card-header">Liste des Super Administrateurs</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @if (in_array($user->id, $superAdmins))
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <form action="{{ route('users.removeSuperAdmin') }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Voulez-vous vraiment retirer ce Super Administrateur ?');">
                                                Retirer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
