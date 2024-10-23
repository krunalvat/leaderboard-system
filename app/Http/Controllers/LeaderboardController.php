<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Activity;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $query->where('id', $request->search);
        }

        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'today':
                    $query->whereHas('activities', function ($q) {
                        $q->whereDate('activity_date', today());
                    });
                    break;

                case 'month':
                    $query->whereHas('activities', function ($q) {
                        $q->whereMonth('activity_date', now()->month)
                        ->whereYear('activity_date', now()->year);
                    });
                    break;

                case 'year':
                    $query->whereHas('activities', function ($q) {
                        $q->whereYear('activity_date', now()->year);
                    });
                    break;
            }
        } else {
            $query->whereHas('activities', function ($q) {
                $q->whereDate('activity_date', today());
            });
        }

        // Get users with their activities and order by rank
        $users = $query->orderBy('rank')->get();

        return view('leaderboard', compact('users'));
    }


    // Recalculate ranks when new data is added
    public function recalculate()
    {
        $users = User::withSum('activities', 'points')->get();

        // Sort users by total points and assign ranks
        $rank = 1;
        foreach ($users->sortByDesc('total_points') as $user) {
            $user->rank = $rank++;
            $user->save();
        }

        return redirect()->route('leaderboard');
    }
}
