<x-app-layout>
    <x-slot name="header">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb"
            class="d-flex justify-content-between align-items-center text-sm">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('personnel.index') }}">Personnel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Views</li>
            </ol>
        </nav>
        <h2 class="pt-3 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Personnel par unite') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Liste -->
            <div class="accordion" id="accordionList">
                @forelse ($groupedMilitaryDetails as $unit => $details)
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading_{{ crc32($unit) }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ crc32($unit) }}" aria-expanded="false" aria-controls="collapse{{ crc32($unit) }}">
                        {{ $unit ?? 'Non spécifié' }}
                    </button>
                  </h2>
                  <div id="collapse{{ crc32($unit) }}" class="accordion-collapse collapse" aria-labelledby="heading_{{ crc32($unit) }}" data-bs-parent="#accordionList">
                    <div class="accordion-body">
                        <table class="table table-striped table-hover table-sm text-sm">
                            <thead>
                                <tr>
                                    <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NR</th>
                                    <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                                    <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom et prénoms</th>
                                    <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matricule</th>
                                    <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fonction</th>
                                    <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modifié le</th>
                                    <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $detail->rank_abbreviate }}</td>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $detail->profile->name. ' ' .$detail->profile->firstname }}</td>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $detail->military_registration_number }}</td>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $detail->current_function }}</td>
                                        <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                            {{ $detail->profile->updated_at ? optional($detail->profile->updated_at)->format('d/m/Y H:i:s') : 'Non spécifié' }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn" type="button" id="profileMenuDropdown{{ $detail->profile->id }}"
                                                    data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: transparent;">
                                                    <i class="fas fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-lg-end"
                                                    aria-labelledby="profileMenuDropdown{{ $detail->profile->id }}">
                                                    <li>
                                                        <a href="{{ route('personnel.show', $detail->profile->id) }}"
                                                            class="dropdown-item">Afficher</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('personnel.destroy', $detail->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ $detail->profile->name. ' '.$detail->profile->firstname }} ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="dropdown-item">Supprimer</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                @empty
                    <div class="alert alert-info">Aucun profil trouvé.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
