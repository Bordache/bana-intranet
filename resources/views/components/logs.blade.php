<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Heure</th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Utilisateur</th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Domaine</th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Evènement</th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Description</th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Adresse IP</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($logs as $log)
            <tr>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                    {{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                    {{ $log->user->username ?? '' }}</td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                    {{ $log->domain->domain_description ?? '-' }}</td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $log->event_name }}</td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $log->description }}</td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">{{ $log->ip_address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $logs->links() }}
