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
                    {!! highlight($log->user->username ?? '' , $search) !!}</td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">
                    {!! highlight($log->domain->domain_description ?? '-' , $search) !!}</td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">{!! highlight($log->event_name , $search) !!}</td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">{!! highlight($log->description , $search) !!}</td>
                <td class="px-6 whitespace-nowrap text-sm text-gray-900">{!! highlight($log->ip_address , $search) !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $logs->appends(request()->query())->links() }}




