<x-app-layout>
    <div class="container">
        <h1>Modifier le rôle : {{ $role->name }}</h1>

        <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="form-label">Nom du Rôle</label>
                <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" id="description" value="{{ old('description', $role->description) }}" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="permissions" class="form-label">Permissions</label>
                <div class="form-check">
                    @foreach ($permissions as $permission)
                        <div>
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                @if ($role->hasPermissionTo($permission->name)) checked @endif>
                            {{ $permission->name }}
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>
