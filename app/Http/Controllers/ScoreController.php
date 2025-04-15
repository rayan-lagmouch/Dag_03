<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function show(Reservation $reservation)
    {
        $scores = $reservation->games()->with(['person', 'score'])->get();

        if ($scores->isEmpty() || $scores->every(fn($game) => $game->score === null)) {
            return back()->withErrors([
                'score' => 'There are no known scores for the selected reservation.',
            ]);
        }

        $scores = $scores->sortByDesc(fn($game) => $game->score->points ?? 0);

        return view('scores.show', compact('scores', 'reservation'));
    }

    public function index()
    {
        $reservations = Reservation::with(['games.person', 'games.score'])
            ->whereHas('games.score')
            ->get();

        return view('scores.index', compact('reservations'));
    }

    public function editable()
    {
        $scores = Score::with('game.person', 'game.reservation')
            ->orderByDesc('points') // 🔥 Sorteer op punten (hoog naar laag)
            ->get();
    
        return view('scores.editable', compact('scores'));
    }
    

    public function edit($id)
    {
        $score = Score::with('game.person', 'game.reservation')->findOrFail($id);
        return view('scores.edit', compact('score'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|integer|min:0|max:300',
        ], [
            'points.max' => 'Het aantal punten is niet geldig, voer een waarde in kleiner of gelijk aan 300.',
        ]);
    
        $score = Score::findOrFail($id);
        $score->points = $request->points;
        $score->save();
    
        return redirect()->route('scores.editable')->with('success', 'Aantal punten is gewijzigd');
    }
    
}
