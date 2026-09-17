<!DOCTYPE html>
<html>
<head>
    <title>My Attendance</title>
</head>
<body>

<h2>My Attendance Records</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Date</th>
        <th>Status</th>
    </tr>

    @forelse($attendances as $attendance)
    <tr>
        <td>{{ $attendance->date }}</td>
        <td>{{ $attendance->status ?? 'Present' }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="2">No attendance records yet.</td>
    </tr>
    @endforelse
</table>

</body>
</html>
