<x-app-layout>
    <x-slot name="header" class="d-flex justify-content-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion du personnel') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <main class="mt-6">
                <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                    <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]" >
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                            <i class="fa-solid fa-database fa-xl"></i>
                        </div>
                        <div class="pt-3 sm:pt-5">
                            <h2 class="text-xl font-semibold text-black dark:text-white">{{ __('Base de données')}}</h2>
                            <div class="mt-4 text-sm/relaxed">
                                <ul>
                                    <li>
                                        <a href="{{ route('personnel.create') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Ajouter personnel</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('personnel.list') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Ajouter congé ou permission</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]" >
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                            <i class="fa-solid fa-sync-alt fa-xl"></i>
                        </div>
                        <div class="pt-3 sm:pt-5">
                            <h2 class="text-xl font-semibold text-black dark:text-white">{{ __('Mise à jour récente ')}}</h2>
                            <div class="mt-4 text-sm/relaxed">
                                <ul>
                                    @foreach ($profiles as $profile)
                                        <li>
                                            <a href="{{ route('personnel.show', ['id' => $profile->profile_id]) }}" class="rounded-sm hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">{{ $profile->rank_abbreviate .' '. $profile->name .' '. $profile->firstname }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]" >
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                            <i class="fa-solid fa-file-lines fa-xl"></i>
                        </div>
                        <div class="pt-3 sm:pt-5">
                            <h2 class="text-xl font-semibold text-black dark:text-white">{{ __('Vues ')}}</h2>
                            <div class="mt-4 text-sm/relaxed">
                                <ul>
                                    <li>
                                        <a href="{{ route('personnel.list') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Liste intégrale</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('personnel.listByUnit') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Liste par unité</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('personnel.listByRank') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Liste par grade</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('personnel.list') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Congés et permissions</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]" >
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                            <i class="fa-solid fa-cogs fa-xl"></i>
                        </div>
                        <div class="pt-3 sm:pt-5">
                            <h2 class="text-xl font-semibold text-black dark:text-white">{{ __('Paramètres')}}</h2>
                            <div class="mt-4 text-sm/relaxed">
                                <ul>
                                    <li>
                                        <a href="#" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Grades</a>
                                    </li>
                                    <li>
                                        <a href="#" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Unités et détachements</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('personnel.users.manage') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Rôles d'utilisateurs</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('personnel.roles.index') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Rôles et permissions</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('personnel.users.password.init') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Mots de passe initiaux</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('personnel.logs') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Rapport</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <a href="{{ route('personnel.create') }}"
        class="btn btn-primary position-fixed bottom-3 end-3 rounded-circle shadow d-flex align-items-center justify-content-center" title="Ajouter nouveau"
        style="width: 46px; height: 46px;">
            <i class="icon solid fa fa-user-plus"></i>
    </a>
</x-app-layout>

<!-- Script de recherche personnel -->
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchBtn = document.getElementById('searchBtn');
        const searchForm = document.getElementById('searchForm');

        searchBtn.addEventListener('click', function () {
            // Récupère les données du formulaire
            const formData = new FormData(searchForm);
            const searchParams = new URLSearchParams();

            formData.forEach((value, key) => {
                if (value) searchParams.append(key, value);
            });

            // Envoie une requête à l'API
            fetch(`/api/custom-search?${searchParams.toString()}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Affichez les résultats (à ajuster selon vos besoins)
                        alert('Recherche réussie : ' + JSON.stringify(data.results));
                    } else {
                        alert('Aucun résultat trouvé.');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue.');
                });
        });
    });
</script> --}}

{{-- Affichage resultat --}}
{{-- <script>
    document.getElementById('searchBtn').addEventListener('click', function () {
        const formData = new FormData(document.getElementById('searchForm'));
        const searchParams = new URLSearchParams();

        formData.forEach((value, key) => {
            if (value) searchParams.append(key, value);
        });

        // Appel AJAX pour effectuer la recherche
        fetch(`/api/custom-search?${searchParams.toString()}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const table = document.getElementById('resultsTable');
                    const tbody = table.querySelector('tbody');
                    tbody.innerHTML = ''; // Vider les anciennes données

                    // Ajouter les nouvelles lignes
                    data.results.forEach(profile => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${profile.name}</td>
                            <td>${profile.firstname}</td>
                            <td>${profile.rank || ''}</td>
                            <td>${profile.unit_assignment || ''}</td>
                            <td>${profile.academic_diploma || ''}</td>
                            <td>${profile.military_diploma || ''}</td>
                            <td>${profile.service_entry_date || ''}</td>
                        `;
                        tbody.appendChild(row);
                    });

                    // Afficher le tableau
                    table.style.display = 'table';
                } else {
                    alert('Aucun résultat trouvé.');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue.');
            });
    });
</script> --}}


