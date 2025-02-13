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
            {{ __('Mots de passe initiaux') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 pb-5">
        <div class="card">
            <div class="card-header">
                <form action="{{ route('admin.logs.search') }}" method="GET" class="d-flex">
                    <x-text-input id="search" name="search" class="w-auto" type="text" placeholder="Entrer mot clé ..." value="{{ $search ?? '' }}"/>
                    <button type="submit" class="mx-2 btn btn-sm btn-primary">Rechercher</button>
                </form>
            </div>
            <div class="card-body">
                @include('components.password-init')
            </div>
        </div>
    </div>
</x-app-layout>
