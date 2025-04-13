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

        <!-- Liste des utilisateurs -->
        <div class="card d-flex space-between">
            <div class="card-header d-flex justify-content-between">
                <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex">
                    <x-text-input id="search" name="search" class="w-auto" type="text"
                        value="{{ request('search') }}" placeholder="Entrer un mot clé ..." />
                    <button type="submit" class="mx-2 btn btn-sm btn-primary">Rechercher</button>
                </form>
            </div>
            <div class="card-body">
                @if ($users->isNotEmpty())
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Identifiant</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unité</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Domaine</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dernière connexion</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adresse IP</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @php
                                    $lastLogin = $user->logs->where('event_name', 'login')->sortByDesc('created_at')->first();
                                @endphp
                                <tr>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {!! highlight($user->rank_abbreviate ?? 'Aucun', request('search')) !!}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {!! highlight($user->name, request('search')) !!} {!! highlight($user->firstname, request('search')) !!}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {!! highlight($user->username, request('search')) !!}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {!! highlight($user->unit_abbreviate, request('search')) !!}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {!! highlight($user->domain_description ?? '<span class="text-white rounded-pill bg-primary p-2">Tous domaines</span>', request('search')) !!}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                       {{ $lastLogin ? optional($lastLogin->created_at)->format('d/m/Y H:i') : 'Jamais' }}
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {{ $lastLogin ? $lastLogin->ip_address : '-' }}
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
                                                    <form action="{{ route('admin.users.reset-password') }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir réinitialiser le mot de passe de {{ $user->rank_abbreviate . ' ' . $user->name . ' ' . $user->firstname }} ?')">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <button type="submit" class="dropdown-item">
                                                            Réinitialiser mot de passe
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.users.suspend') }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Êtes-vous sûr de suspendre le compte de {{ $user->rank_abbreviate . ' ' . $user->name . ' ' . $user->firstname }} ?')">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <button type="submit" class="dropdown-item">
                                                            Suspendre cet utilisateur
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.users.destroy') }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ $user->rank_abbreviate . ' ' . $user->name . ' ' . $user->firstname }} ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            Supprimer cet utilisateur
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                @else
                    <div class="alert alert-info">
                        Aucun utilisateur trouvé.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
