<!DOCTYPE html>
<html>
<head>
    <title>My Leave Status</title>
</head>
<body>

<h2>My Leave Requests</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>From</th>
        <th>To</th>
        <th>Reason</th>
        <th>Status</th>
        <th>Admin Comment</th>
    </tr>

    @forelse($leaves as $leave)
    <tr>
        <td>{{ $leave->from_date }}</td>
        <td>{{ $leave->to_date }}</td>
        <td>{{ $leave->reason }}</td>
        <td>{{ $leave->status }}</td>
        <td>{{ $leave->adminComment->comment ?? 'N/A' }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="5">No leave requests submitted yet.</td>
    </tr>
    @endforelse
</table>

</body>
</html>
