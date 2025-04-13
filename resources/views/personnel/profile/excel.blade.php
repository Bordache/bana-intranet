<table>
    <thead>
        <tr>
            @foreach ($columns as $label)
                <th>{{ $label }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($profiles as $profile)
            <tr>
                @foreach ($columns as $label)
                    <td>{{ $profile[$label] }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
