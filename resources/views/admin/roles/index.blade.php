<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <!-- Liste des rôles avec gestion des permissions par domaine -->
        <div class="card">
            <div class="card-header">Liste des Rôles (hors Super Administrateur)</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Permissions par Domaine</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>
                                    <form action="{{ route('roles.update') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                                        <input type="text" name="name" value="{{ $role->name }}" required>
                                        <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
                                    </form>
                                </td>
                                <td>
                                    @foreach($domains as $domain)
                                        <strong>{{ ucfirst($domain->name) }}</strong>
                                        @foreach($domain->objets as $objet)
                                            <div>
                                                <strong>{{ ucfirst($objet->name) }}</strong>
                                                <form action="{{ route('roles.updatePermissions') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                                                    <input type="hidden" name="domain" value="{{ $domain->name }}">
                                                    <input type="hidden" name="objet" value="{{ $objet->name }}">

                                                    @foreach($permissions as $permission)
                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                            @if($role->permissions->where('pivot.domain', $domain->name)->where('pivot.objet', $objet->name)->contains('id', $permission->id)) checked @endif>
                                                        {{ $permission->name }}
                                                    @endforeach

                                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Mettre à jour</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('roles.destroy') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Voulez-vous vraiment supprimer ce rôle ?');">
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
    </div>
</x-app-layout>
