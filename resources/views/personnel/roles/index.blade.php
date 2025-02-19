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
            {{ __('Rôles et permissions') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="accordion" id="accordionFlushRole">
                @forelse ($domains as $key => $domain)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading_{{ crc32($key) }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ crc32($key) }}" aria-expanded="false" aria-controls="flush-collapse{{ crc32($key) }}">
                                {{ $domain->domain_description }}
                            </button>
                        </h2>
                        <div id="flush-collapse{{ crc32($key) }}" class="accordion-collapse collapse" aria-labelledby="flush-heading_{{ crc32($key) }}" data-bs-parent="#accordionFlushRole">
                            <div class="accordion-body">
                                <table class="table table-striped table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                                            <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                            <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modifié le</th>
                                            <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modifier</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($domain->roles as $key => $role)
                                            @php
                                                $roleDomain = $domain->roleDomains->where('role_id', $role->id)->first();
                                            @endphp
                                            <tr>
                                                <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $role->name }}</td>
                                                <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $roleDomain ? $roleDomain->domain_description : 'Aucune description' }}</td>
                                                <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $rolePermissions->where('role_id', $role->id)->where('domain_id', $domain->id)->first() ? $rolePermissions->where('role_id', $role->id)->where('domain_id', $domain->id)->first()->updated_at->format('d/m/Y H:i') : 'Jamais'}}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('personnel.role-permissions.edit', ['role_id' => $role->id, 'domain_id' => $domain->id]) }}"
                                                        class="fas fa-pen" title="Modifier">
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">Aucune permission trouvée.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
