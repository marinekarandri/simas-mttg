<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Get authenticated user profile
     *
     * @OA\Get(
     *     path="/api/user/profile",
     *     tags={"User Management"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="User profile",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Update user profile
     *
     * @OA\Put(
     *     path="/api/user/profile",
     *     tags={"User Management"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe Updated"),
     *             @OA\Property(property="email", type="string", example="john@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Profile updated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="user", type="object")
     *         )
     *     )
     * )
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $user->update($request->only(['name', 'email']));
        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    }

    /**
     * List all users
     *
     * @OA\Get(
     *     path="/api/users",
     *     tags={"User Management"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of users",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="email", type="string")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email')->get();
        return response()->json($users);
    }
}