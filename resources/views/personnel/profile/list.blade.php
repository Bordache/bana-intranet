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
            {{ __('Liste intégrale') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 pb-5">
        <div class="card">
            <div class="card-header">
                @include('personnel.profile.partials.templates.profile-search-nav')
            </div>

            <div class="card-body p-0">
                @if ($militaryDetails->isEmpty())
                    <div class="alert alert-info">Aucune information.</div>
                @else
                    <table class="table table-striped table-hover table-sm text-sm align-middle mb-0">
                        <thead>
                            <tr class="align-middle">
                                <th><input class="form-check-input ms-1 mb-1" type="checkbox" id="checkAll" onclick="toggleCheckboxes(this)"></th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NR</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Grade</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom et prénoms</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Matricule</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Unité</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fonction</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Modifié le</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($militaryDetails as $detail)
                                <tr>
                                    <td><input class="form-check-input profile-checkbox checkItem ms-1 mb-1" type="checkbox" value="{{ $detail->id }}"></td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {{ $loop->iteration }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {{ $detail->rank_abbreviate }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {{ $detail->name . ' ' . $detail->firstname }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {{ $detail->military_registration_number }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {{ $detail->unit_abbreviate }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {{ $detail->current_function }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                                        {{ $detail->profile_updated_at ? optional(Carbon\Carbon::parse($detail->profile_updated_at))->format('d/m/Y H:i:s') : 'Non spécifié' }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn" type="button"
                                                id="profileMenuDropdown{{ $detail->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false" style="border: none; background: transparent;">
                                                <i class="fas fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-lg-end"
                                                aria-labelledby="profileMenuDropdown{{ $detail->id }}">
                                                <li>
                                                    <a href="{{ route('personnel.show', $detail->id) }}"
                                                        class="dropdown-item">Afficher</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('personnel.destroy', $detail->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ $detail->name . ' ' . $detail->firstname }} ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Supprimer</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($militaryDetails->total() > $perPage)
                        <div class="p-3">
                            {{ $militaryDetails->appends(request()->query())->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <a href="{{ route('personnel.create') }}"
        class="btn btn-primary position-fixed bottom-3 end-3 rounded-circle shadow d-flex align-items-center justify-content-center" title="Ajouter nouveau"
        style="width: 46px; height: 46px;">
            <i class="fas fa-user-plus"></i>
    </a>


</x-app-layout>
