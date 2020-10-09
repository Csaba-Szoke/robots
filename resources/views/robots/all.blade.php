<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Robots overview</title>

        <style>
            table {
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 5px;
            }
        </style>
    </head>

    <body>
        <table>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Status</th>
                <th>Year</th>
                <th>Created at</th>
            </tr>
            @if ($robots)
                @foreach ($robots as $robot)
                    <tr>
                        <td>{{ $robot->name }}</td>
                        <td>{{ $robot->type ? $robot->type->name : '' }}</td>
                        <td>{{ $robot->status }}</td>
                        <td>{{ $robot->year }}</td>
                        <td>{{ $robot->created_at }}</td>
                    </tr>
                @endforeach
            @endif
        </table>
    </body>
</html>
