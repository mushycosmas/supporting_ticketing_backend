<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class AiSuggestionController extends Controller
{
    public function getSuggestion(Ticket $ticket)
    {
        // Call OpenAI chat endpoint
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => "Provide a solution for this ticket: {$ticket->description}"
                ]
            ]
        ]);

        $suggestion = $response['choices'][0]['message']['content'] ?? 'No suggestion available';

        return response()->json(['suggestion' => $suggestion]);
    }
}
