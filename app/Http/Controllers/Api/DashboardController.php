<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $issues = Issue::count();
        $activeissues = Issue::where('status', 'open')->count();
        $tasks = Task::where('status', 'active')->count();

        return response()->json([
            'issues' => $issues,
            'activeissues' => $activeissues,
            'tasks' => $tasks,
        ]);
    }
}
