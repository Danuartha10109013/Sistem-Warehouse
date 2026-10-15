<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        $isSuperAdmin = ($currentUser && $currentUser->role == 5);

        $query = ActivityLog::with('user')->latest();

        if ($isSuperAdmin) {
            if ($request->filled('user_id')) {
                $query->where('user_id', $request->user_id);
            }
            $users = User::select('id', 'name', 'username')->get();
            $actions = ActivityLog::select('action')->distinct()->pluck('action');
            $modules = ActivityLog::select('module')->whereNotNull('module')->distinct()->pluck('module');
        } else {
            $query->where('user_id', $currentUser->id);
            $users = collect();
            $actions = ActivityLog::where('user_id', $currentUser->id)->select('action')->distinct()->pluck('action');
            $modules = ActivityLog::where('user_id', $currentUser->id)->whereNotNull('module')->select('module')->distinct()->pluck('module');
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('user_name', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%");
            });
        }

        $logs = $query->paginate(15)->withQueryString();

        if ($request->ajax()) {
            return view('activity_log.partials.table', compact('logs', 'isSuperAdmin'))->render();
        }

        return view('activity_log.index', compact('logs', 'users', 'actions', 'modules', 'isSuperAdmin'));
    }

    public function show($id)
    {
        $log = ActivityLog::with('user')->findOrFail($id);

        if (Auth::user()->role != 5 && $log->user_id != Auth::id()) {
            abort(403, 'Akses tidak diizinkan');
        }

        return response()->json($log);
    }
}
