<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des utilisateurs') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">
                {{ __('Modifier les rôles de l\'utilisateur') }}
            </h2>

            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        {{ __('Nom et prénoms') }}
                    </label>
                    <p class="mt-1 text-sm text-gray-900">
                        {{ $user->name . ' ' . $user->firstname }}
                    </p>
                </div>

                <div class="mb-4">
                    <label for="roles" class="block text-sm font-medium text-gray-700">
                        {{ __('Rôles') }}
                    </label>
                    <div class="mt-2 space-y-2">
                        @foreach ($roles as $role)
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    name="roles[]"
                                    value="{{ $role->name }}"
                                    id="role-{{ $role->id }}"
                                    class="h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                    @if($user->roles->pluck('name')->contains($role->name)) checked @endif
                                >
                                <label for="role-{{ $role->id }}" class="ml-2 text-sm text-gray-900">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('users.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                        {{ __('Annuler') }}
                    </a>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        {{ __('Enregistrer les modifications') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
