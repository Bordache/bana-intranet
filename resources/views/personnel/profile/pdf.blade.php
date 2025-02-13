<!DOCTYPE html>
<html>

<head>
    <title>Export PDF</title>

    @php
        $fontSize = (count($fields) > 12) ? '8px' : ((count($fields) > 6) ? '10px' : '12px');
    @endphp

    <style>
        body {
            font-size: {{ $fontSize }};
            /* Adapter la taille du texte */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Etat renseigné des militaires</h2>
    <table>
        <thead>
            <tr>
                @foreach ($fields as $label)
                    <th>{{ $label }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($profiles as $profile)
                <tr>
                    @foreach ($fields as $label)
                        <td>{{ $profile[$label] ?? 'N/A' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
