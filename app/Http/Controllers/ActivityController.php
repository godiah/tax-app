<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    /**
     * Display a listing of all activities.
     */
    public function index(Request $request)
    {
        $query = Activity::with(['causer', 'subject'])->latest();

        // Filter by log name (activity type)
        if ($request->has('type') && !empty($request->type)) {
            $query->where('log_name', $request->type);
        }

        // Filter by user
        if ($request->has('user_id') && !empty($request->user_id)) {
            $query->where('causer_id', $request->user_id);
        }

        // Filter by date range
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $activities = $query->paginate(50)->appends($request->all());

        if ($request->ajax()) {
            return view('admin.activities.partials.activities-list', compact('activities'));
        }

        return view('admin.activities.index', compact('activities'));
    }
}
