@if (!$users->isEmpty())
    <table class="table align-middle">
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Grade</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Utilisateur</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Identifiant</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Domaine</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Rôle</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Modifié le</th>

                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @php
                    $validRoles = optional($user->userRoles)->filter(fn($r) => optional($r->role)->name !== 'Super administrateur' || optional($user->userRoles)->count() === 1);
                    $userDomains = $validRoles->pluck('domain_id')->unique();
                    if (!$isAdmin && isset($domain)) {
                        $userDomains = $userDomains->filter(fn($d) => $d === $domain->id);
                        $validRoles = $validRoles->filter(fn($r) => $r->domain_id === $domain->id);
                    }
                    $rowspan = count($userDomains);
                    $firstRow = true;
                @endphp

                @foreach ($userDomains as $domain_id)
                    @php
                    $domain = $domains->firstWhere('id', $domain_id);
                    $userRole = $validRoles->firstWhere('domain_id', $domain_id);
                    @endphp

                    <tr>
                        @if ($firstRow)
                        <td class="px-6 whitespace-nowrap text-sm text-gray-900" rowspan="{{ $rowspan }}">
                            {!! highlight($user->militaryDetail?->rank?->rank_abbreviate ?? 'Aucun', $search) !!}
                        </td>
                        <td class="px-6 whitespace-nowrap text-sm text-gray-900" rowspan="{{ $rowspan }}">
                            {!! highlight($user->name, $search) !!} {!! highlight($user->firstname, $search) !!}
                        </td>
                        <td class="px-6 whitespace-nowrap text-sm text-gray-900" rowspan="{{ $rowspan }}">
                            {!! highlight($user->username, $search) !!}
                        </td>
                        @endif

                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                            {!! highlight($domain?->domain_description ?? 'Aucun', $search) !!}
                        </td>
                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                            {!! highlight($userRole ? $userRole->role->name : 'Aucun', $search) !!}
                        </td>
                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                            {{ $userRole ? $userRole->updated_at->format('d/m/Y H:i') : null }}
                        </td>

                        <td>
                            <div class="dropdown">
                                <button class="btn" type="button" id="userMenuDropdown{{ $user->id }}" data-bs-toggle="dropdown"
                                    aria-expanded="false" style="border: none; background: transparent;">
                                    <i class="fas fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="userMenuDropdown{{ $user->id }}">
                                    <li>
                                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#userRoleModal" data-action="{{ route('users.assignRole') }}"
                                            data-method="POST" data-title="Attribution de rôle" data-user_id="{{ $user->id }}"
                                            data-user_username="{{ $user->username }}" data-domain_id="{{ $domain->id ?? null }}"
                                            data-domain_name="{{ $domain->domain_description ?? null }}"
                                            data-role_id="{{ $userRole ? $userRole->role->id : null }}">
                                            Modifier ce rôle
                                        </button>
                                    </li>
                                    <li>
                                        @if ($userRole)
                                        <form action="{{ route('users.removeRole') }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer le rôle {{ $userRole->role->name }} de {{ $user->username }} ?')">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <input type="hidden" name="domain_id" value="{{ $domain->id ?? null }}">
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
@else
    <div class="alert alert-info">
        Aucun utilisateur trouvé.
    </div>
@endif
