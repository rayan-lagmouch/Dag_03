<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function show(Reservation $reservation)
    {
        $scores = $reservation->scores()->orderBy('points', 'desc')->get();

        if ($scores->isEmpty()) {
            return back()->withErrors(['score' => 'No scores available for this reservation']);
        }

        return view('scores.show', compact('scores', 'reservation'));
    }


    public function edit($id)
    {
        $score = Score::findOrFail($id);
        return view('scores.edit', compact('score'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|integer|max:300',
        ]);

        $score = Score::findOrFail($id);
        $score->points = $request->points;
        $score->save();

        return redirect()->route('scores.editable')->with('success', 'Score updated');
    }

    public function editable()
    {
        $scores = Score::orderBy('updated_at', 'desc')->get();
        return view('scores.editable', compact('scores'));
    }
}
