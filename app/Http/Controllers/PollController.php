<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Option;
use App\Models\Vote;
use Illuminate\Http\Request;

class PollController extends Controller
{
    // 1. SHOW METHOD: Display the voting form
    public function show(Poll $poll)
    {
        // Load poll options
        $poll->load('options');

        // Check if this IP has already voted
        $hasVoted = Vote::where('ip_address', request()->ip())
            ->whereHas('option', fn($q) => $q->where('poll_id', $poll->id))
            ->exists();

        if ($hasVoted) {
            // Redirect to results if already voted
            return redirect()->route('poll.results', $poll)
                             ->with('info', 'You have already voted on this poll.');
        }

        return view('poll.show', compact('poll'));
    }

    // 2. VOTE METHOD: Save the vote
    public function vote(Request $request, Poll $poll)
    {
        // Validate the selected option
        $request->validate([
            'option_id' => 'required|exists:options,id',
        ]);

        // Prevent duplicate votes
        $hasVoted = Vote::where('ip_address', $request->ip())
            ->whereHas('option', fn($q) => $q->where('poll_id', $poll->id))
            ->exists();

        if ($hasVoted) {
            return redirect()->route('poll.results', $poll)
                             ->with('info', 'You have already voted.');
        }

        // Save the vote
        Vote::create([
            'option_id' => $request->input('option_id'),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('poll.results', $poll)
                         ->with('success', 'Vote recorded!');
    }

    // 3. RESULTS METHOD: Display poll results
    public function results(Poll $poll)
    {
        // Load options with votes count
        $options = $poll->options()->withCount('votes')->get();
        $totalVotes = $options->sum('votes_count');

        return view('poll.results', compact('poll', 'options', 'totalVotes'));
    }
}
