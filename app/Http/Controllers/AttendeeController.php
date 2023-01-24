<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Attendees;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;

class AttendeeController extends Controller
{
    public function get(Request $request)
    {
        $attendees = Attendees::get()->toArray();

        return Inertia::render('Attendees/List', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'attendeesList' => $attendees
        ]);
    }

    public function create()
    {
        return Inertia::render('Attendees/Create');        
    }

    public function add(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:attendees,email',
        ]);

        $attendees = Attendees::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'approved' => $request->get('approved') ? 'true' : 'false',
            'member_since' => Carbon::now(),
        ]);

        return Redirect::route('attendees');
    }

    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
        
    // }

    // public function destroy(Request $request): RedirectResponse
    // {
        
    // }
}
