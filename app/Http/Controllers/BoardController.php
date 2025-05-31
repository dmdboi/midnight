<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    // Shows a single board with its threads
    public function show(Request $request, $boardSlug)
    {
        $board = Board::query()->where('slug', $boardSlug)->firstOrFail();

        return view('boards.show', [
            'board' => $board,
            'threads' => $board->threads()->with('user')->paginate(10),
        ]);
    }
}
