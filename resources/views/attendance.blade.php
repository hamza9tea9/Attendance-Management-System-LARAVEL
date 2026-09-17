<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
</head>
<body>

    <h2>Mark Attendance</h2>

    <!-- Success Message -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="/attendance/mark">
        @csrf
        <button type="submit">Mark Attendance</button>
    </form>
    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<a href="/attendance/mark">
    <button>Mark Attendance</button>
</a>

<a href="/attendance/status">
    <button>View My Attendance</button>
</a>

<a href="/student/grade">
    <button>View My Grade</button>
</a>


</body>
</html>
