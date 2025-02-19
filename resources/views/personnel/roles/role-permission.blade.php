<x-app-layout>
    <x-slot name="header">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb"
            class="d-flex justify-content-between align-items-center text-sm">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('personnel.index') }}">Personnel</a></li>
                <li class="breadcrumb-item" aria-current="page">Paramètres</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('personnel.roles.index') }}">Rôles et permissions</a></li>
            </ol>
        </nav>
        <h2 class="pt-3 font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Modification du rôle "') . $role->name . __('"') !!}
            <a tabindex="0" class="fas fa-circle-question text-primary" role="button" data-bs-toggle="popover"
                data-bs-trigger="focus"
                data-bs-content="Un rôle est un ensemble de permissions définies pour la totalité d’un système, et que l’on peut attribuer à des utilisateurs déterminés dans des contextes déterminés."></a>

        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-white p-4">
            <form action="{{ route('personnel.role-permissions.store') }}" method="POST" class="row g-3">
                @csrf
                <input type="hidden" name="role_id" value="{{ $role->id }}">
                <input type="hidden" name="domain_id" value="{{ $domain->id }}">

                <!-- Contenu -->
                <!-- Domaine -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="domainName" :value="__('Domaine')" />
                </div>
                <div class="col-md-8">
                    <x-text-input id="domainName" type="text" :value="$domain->domain_description" class="w-auto" disabled />
                </div>

                <!-- Role -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="roleName" :value="__('Role')" />
                </div>
                <div class="col-md-8">
                    <x-text-input id="roleName" type="text" :value="$role->name" class="w-auto" disabled />
                </div>


                <!-- Description role-->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="domain_description" :value="__('Description du rôle')" />
                </div>
                <div class="col-md-8">
                    <x-textarea-input id="domain_description" name="domain_description" rows="3"
                        placeholder="Décrire ce rôle dans le domaine défini.">
                        {{ $roleDomain ? $roleDomain->domain_description : '' }}
                    </x-textarea-input>
                </div>

                <!-- Capacités -->
                <div class="col-md-4">
                    <x-input-label :value="__('Capacité')" />
                </div>
                <div class="col-md-8">
                    <x-input-label :value="__('Permission')" />
                </div>
                <hr>

                @foreach ($objects as $object)
                    <table class="table table-striped table-hover align-middle">
                        <tbody>
                            <tr>
                                <td class="fw-bold" colspan="2">
                                    Objet : {{ $object->object_description }}
                                </td>
                            </tr>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td class="px-6 whitespace-nowrap text-gray-900 col-md-4 text-sm">
                                        <div class="d-flex flex-column">
                                            <span class="text-primary text-capitalize-first">{{ $permission->permission_description }}</span>
                                            <span class="">{{ $permission->name }}_{{ $object->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900 col-md-8">
                                        <input class="form-check-input m-0" type="checkbox"
                                            name="permissions[{{ $object->id }}][]" value="{{ $permission->id }}"
                                            {{ in_array($permission->id, $existingPermissions[$object->id] ?? []) ? 'checked' : '' }}>
                                        <label class="form-check-label">Autorisé</label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
                <div class="container-fluid sticky-bottom bg-white py-3">
                    <button type="submit" class="btn btn-primary mt-3 w-auto">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let domain_id = {{ $domain->id }};
            let role_id = {{ $role->id }};
            let domain_description = "{{ $roleDomain->domain_description ?? '' }}";

            fetch(`/admin/roles/get-objects-permissions?domain_id=${domain_id}`)
                .then(response => response.json())
                .then(data => {
                    let container = document.getElementById('permissions-container');
                    if (!container) return;

                    container.innerHTML = '';

                    data.objects.forEach(object => {
                        let objectDiv = document.createElement('div');
                        objectDiv.classList.add('mb-3', 'p-2', 'border', 'rounded');
                        objectDiv.innerHTML = `<strong>${object.name}</strong><br>`;

                        data.permissions.forEach(permission => {
                            let checked = (data.existingPermissions[object.id] || []).includes(permission.id) ? 'checked' : '';

                            objectDiv.innerHTML += `
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="permissions[${object.id}][]" value="${permission.id}" ${checked}>
                                    <label class="form-check-label">${permission.name}</label>
                                </div>
                            `;
                        });

                        container.appendChild(objectDiv);
                    });
                })
                .catch(error => console.error("Erreur lors de la récupération des permissions :", error));
        });
    </script>


    <!-- Popover -->
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
        var popover = new bootstrap.Popover(document.querySelector('.popover-dismiss'), {
            trigger: 'focus'
        })
    </script>
    </div>
</x-app-layout>
