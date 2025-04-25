<!DOCTYPE html>
<html>
<head>
    <title>Report PDF</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 5px; border: 1px solid #ccc; font-size: 12px; }
    </style>
</head>
<body>
    <h2>All Reports</h2>
    <table>
        <thead>
            <tr>
                <th>Ticket #</th>
                <th>User</th>
                <th>Dept</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->ticket_number }}</td>
                    <td>{{ $report->user->name ?? '-' }}</td>
                    <td>{{ $report->department->name ?? '-' }}</td>
                    <td>{{ $report->date }}</td>
                    <td>{{ $report->ticket_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
