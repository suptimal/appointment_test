<?php

namespace App\Http\Controllers;

use App\Models\Insured;
use App\Models\Insurence;
use Illuminate\Http\Request;

class InsurenceController extends Controller
{
    public function index()
    {
        return response(view('insurence.index', [
            'insurences' => \App\Models\Insurence::all()
        ]));
        // return response()->json($insurences, 200);
    }

    public function loginForm(string $name)
    {
        return response(view('insurence.login', [
            'insurence' => \App\Models\Insurence::firstWhere('name', $name)
        ]));
    }

    public function indexInsured(string $name)
    {
        $insurence = Insurence::firstWhere('name', $name);
        return response()->json($insurence->insured, 200);
    }

    public function login()
    {
        $validated = request()->validate([
            'kvnumber' => 'required|regex:/^[A-Z][0-9]{9}$/',
            'birthdate' => 'required|date'
        ]);
        $insurence = request()->route()->parameter('name');
        $insured = Insured::firstWhere($validated);
        if (empty($insured)) {
            return redirect()->back()->withErrors(['kvnumber' => 'Versicherter konnte nicht gefunden werden'])->withInput();
        }

        auth('insurence')->login($insured);
        return redirect()->route('insurence.appointmentPlaner', ['name' => $insurence]);
    }

    public function appointmentPlaner(string $name)
    {
        $insurence = Insurence::firstWhere('name', $name);
        return view('insurence.appointment', ['insurence' => $insurence]);
    }
}
