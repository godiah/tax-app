<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        // 1) Counts
        $totalPosts = Post::where('author_id', $user->id)->count();
        $published  = Post::where('author_id', $user->id)
            ->where('status', 'published')
            ->count();
        $drafts     = Post::where('author_id', $user->id)
            ->where('status', 'draft')
            ->count();

        // 2) Last login 
        $lastLoginActivity = Activity::where('causer_id', $user->id)
            ->where('description', 'logged in')
            ->latest('created_at')
            ->first();
        $lastLogin = $lastLoginActivity
            ? $lastLoginActivity->created_at
            : null;

        // 3) Last 5 activities by this user
        $recentActivities = Activity::with('subject')
            ->where('causer_id', $user->id)
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('profile', compact(
            'user',
            'totalPosts',
            'published',
            'drafts',
            'lastLogin',
            'recentActivities'
        ));
    }

    public function updatePassword(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        // 1) Validate current password and new password + confirmation
        $request->validate([
            'current_password'      => ['required', 'string', 'current_password'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.current_password' => 'The current password is incorrect.',
        ]);

        // 2) Update to the new password
        $user->password = Hash::make($request->password);
        $user->save();

        // 3) Redirect back with success message
        return back()->with('success', 'Your password has been updated.');
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        // 1) Validate
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        // 2) Persist changes
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // 3) Redirect back with success
        return back()->with('success', 'Profile updated successfully.');
    }
}
