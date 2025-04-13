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
            {{ __('Super administrateurs du site') }}
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
                                    <option value="{{ $user->id }}">{{ $user->grade }} {{ $user->name }} {{ $user->firstname }} ({{ $user->username }})
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
                            <th>Grade</th>
                            <th>Nom et prénoms</th>
                            <th>Identifiant</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @if (in_array($user->id, $superAdmins))
                                <tr>
                                    <td>{{ $user->grade }}</td>
                                    <td>{{ $user->name }} {{ $user->firstname }}</td>
                                    <td>{{ $user->username }}</td>
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
