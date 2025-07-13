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
