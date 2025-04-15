<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Show the scores for a specific reservation.
     */
    public function show(Reservation $reservation)
    {
        // Load all games with their associated person and score
        $scores = $reservation->games()->with(['person', 'score'])->get();

        // If no scores are found or all scores are null, show an error
        if ($scores->isEmpty() || $scores->every(fn($game) => $game->score === null)) {
            return back()->withErrors([
                'score' => 'There are no known scores for the selected reservation.',
            ]);
        }

        // Sort games by score (highest first)
        $scores = $scores->sortByDesc(fn($game) => $game->score->points ?? 0);

        return view('scores.show', compact('scores', 'reservation'));
    }

    /**
     * Show an overview of all reservations with scores.
     */
    public function index()
    {
        $reservations = Reservation::with(['games.person', 'games.score'])
            ->whereHas('games.score') // Only include reservations with recorded scores
            ->get();

        return view('scores.index', compact('reservations'));
    }

    /**
     * Show editable list of all scores.
     */
    public function editable()
    {
        $scores = Score::with('game.person', 'game.reservation')
            ->orderByDesc('points') // Sort by points (highest to lowest)
            ->get();
    
        return view('scores.editable', compact('scores'));
    }

    /**
     * Show the edit form for a specific score.
     */
    public function edit($id)
    {
        $score = Score::with('game.person', 'game.reservation')->findOrFail($id);
        return view('scores.edit', compact('score'));
    }

    /**
     * Update the score for a game.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|integer|min:0|max:300',
        ], [
            'points.max' => 'The number of points is invalid. Please enter a value less than or equal to 300.',
        ]);
    
        $score = Score::findOrFail($id);
        $score->points = $request->points;
        $score->save();
    
        return redirect()->route('scores.editable')->with('success', 'Score updated successfully');
    }
}
