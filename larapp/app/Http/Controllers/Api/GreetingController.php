<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GreetingController extends Controller
{
    /**
     * Respond to greeting
     *
     * @OA\Post(
     *     path="/greeting",
     *     tags={"Greeting"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="assalamualaikum")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Greeting response",
     *         @OA\JsonContent(
     *             @OA\Property(property="response", type="string", example="waalaikumsalam")
     *         )
     *     )
     * )
     */
    public function respond(Request $request)
    {
        $message = strtolower($request->input('message', ''));

        // Check if message contains Islamic greetings
        $greetings = ['assalamualaikum', 'assalam', 'salamolekom', 'salam'];

        foreach ($greetings as $greeting) {
            if (str_contains($message, $greeting)) {
                return response()->json(['response' => 'waalaikumsalam']);
            }
        }

        // If no greeting found, respond with correct greeting
        return response()->json(['response' => 'salam yang bener, Bos!']);
    }
}