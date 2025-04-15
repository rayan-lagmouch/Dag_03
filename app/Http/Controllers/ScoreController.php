<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function show(Reservation $reservation)
    {
        $scores = $reservation->games()->with(['person', 'score'])->get();
    
        // 👇 THIS LINE is the key to show/hide results
        if ($scores->isEmpty() || $scores->every(fn($game) => $game->score === null)) {
            return back()->withErrors([
                'score' => 'There are no known scores for the selected reservation.',
            ]);
        }
    
        $scores = $scores->sortByDesc(fn($game) => $game->score->points ?? 0);
    
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
