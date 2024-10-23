<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Leaderboard</h1>

        <!-- Combined Search and Filter Form -->
        <form action="{{ route('leaderboard') }}" method="GET" class="form-inline mb-4">
            <div class="form-group mr-2">
                <input type="text" name="search" class="form-control" placeholder="Enter User ID" value="{{ request('search') }}">
            </div>
            <div class="form-group mr-2">
                <select name="filter" class="form-control" onchange="this.form.submit()">
                    <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Today</option>
                    <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>This Month</option>
                    <option value="year" {{ request('filter') == 'year' ? 'selected' : '' }}>This Year</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <form action="{{ route('recalculate') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning btn-sm mb-2 float-right">Recalculate</button>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
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
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
