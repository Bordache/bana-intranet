<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Gestion du personnel') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="d-flex justify-content-between align-items-center text-sm">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="{{ route('personnel.index') }}">Base de données</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Liste du personnel</li>
                </ol>
            </nav>
            <div class="p-4 sm:p-8 bg-white">
                <div class="mx-auto">
                    @forelse ($groupedMilitaryDetails as $unit => $details)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $unit ?? 'Non spécifié' }}</h2>
                        </div>
                        <div class="mt-6">
                            <table class="table table-striped table-hover table-sm text-sm">
                                <thead >
                                    <tr>
                                        <th>#</th>
                                        <th>Grade</th>
                                        <th>Nom</th>
                                        <th>Prénoms</th>
                                        <th>Matricule</th>
                                        <th>Fonction</th>
                                        <th>Modifié le</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $detail->rank_abbreviate }}</td>
                                                    <td>{{ $detail->profile->name }}</td>
                                                    <td>{{ $detail->profile->firstname}}</td>
                                                    <td>{{ $detail->military_registration_number}}</td>
                                                    <td>{{ $detail->current_function}}</td>
                                                    <td>
                                                        {{ $detail->profile->updated_at ? \Carbon\Carbon::parse($detail->profile->updated_at)->format('d/m/Y H:i:s') : 'Non spécifié' }}
                                                    </td>

                                                    <td>
                                                        <!-- Boutons d'action -->
                                                        <a href="{{ route('personnel.show', $detail->profile->id) }}" class="btn btn-sm btn-info">Afficher Profil</a>
                                                        <a href="{{ route('personnel.edit', $detail->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                                        <form action="{{ route('personnel.destroy', $detail->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce détail ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @empty
                        <div class="alert alert-info">Aucun profil trouvé.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
