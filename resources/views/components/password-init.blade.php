<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <input type="checkbox" wire:model="selectAll" class="form-checkbox h-5 w-5 text-indigo-600 border-gray-300 rounded" />
            </th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Grade</th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nom</th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Prénoms</th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Identifiant</th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Mot de passe initial</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usersPassword as $user)
            <tr>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                    <input type="checkbox" wire:model="selectedUsers" value="{{ $user->id }}" class="form-checkbox h-5 w-5 text-indigo-600 border-gray-300 rounded" />
                </td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                    {!! highlight($user->grade ?? '', $search ?? '') !!}
                </td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                    {!! highlight($user->user_name ?? '', $search ?? '') !!}
                </td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                    {!! highlight($user->user_firstname ?? '', $search ?? '') !!}
                </td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                    {!! highlight($user->user_username ?? '', $search ?? '') !!}
                </td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                    {{ $user->password }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $usersPassword->links() }}
