<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Attendance PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Attendance Report ({{ now()->format('d M Y') }})</h2>

    <table>
        <thead>
            <tr>
                <th>Roll No</th>
                <th>Student</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Status</th>
                <th>Marked By</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $att)
                <tr>
                    <td>{{ $att->student->roll_no ?? '-' }}</td>
                    <td>{{ $att->student->name ?? '-' }}</td> {{-- student --}}
                    <td>{{ $att->subject->name ?? '-' }}</td>
                    <td>{{ $att->date }}</td>
                    <td>{{ ucfirst($att->status) }}</td>
                    <td>{{ $att->marker->name ?? '-' }}</td> {{-- marked_by --}}
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
