<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
</head>
<body>
    <div class="container">
        <h1>Leaderboard</h1>

        <form action="{{ route('leaderboard') }}" method="GET">
            <input type="text" name="search" placeholder="Enter User ID">
            
            <select name="filter" onchange="this.form.submit()">
                <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>This Month</option>
                <option value="year" {{ request('filter') == 'year' ? 'selected' : '' }}>This Year</option>
            </select>
            
            <button type="submit">Filter</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Points</th>
                    <th>Rank</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->total_points }}</td>
                        <td>{{ $user->rank }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('recalculate') }}" method="POST">
            @csrf
            <button type="submit">Recalculate</button>
        </form>
    </div>
</body>
</html>
