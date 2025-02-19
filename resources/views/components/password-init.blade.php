<table class="table table-striped table-hover" id="dataTable">
    <thead>
        <tr>
            <th><input class="form-check-input ms-1 mb-1" type="checkbox" id="checkAll" onclick="toggleCheckboxes(this)"></th>
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
                Unité</th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Mot de passe initial</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usersPassword as $user)
            <tr>
                <td><input class="form-check-input profile-checkbox checkItem ms-1 mb-1" type="checkbox" value="{{ $user->id }}"></td>
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
                    {!! highlight($user->unit ?? '', $search ?? '') !!}
                </td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                    {{ $user->password }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $usersPassword->links() }}
