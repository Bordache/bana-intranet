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
            {{ __('Journaux') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="card">
            <div class="card-header">
                <form action="{{ route('personnel.logs.search') }}" method="GET" class="d-flex">
                    <x-text-input id="search" name="search" class="w-auto" type="text" value="{{ $search ?? null }}" placeholder="Saisir mot clé ..."/>
                    <button type="submit" class="mx-2 btn btn-sm btn-primary">Rechercher</button>
                </form>
            </div>
            <div class="card-body">
                @include('components.logs')
            </div>
        </div>
    </div>
</x-app-layout>
