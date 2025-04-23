<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LoginResource;

class AuthController extends Controller
{

    public function login(LoginRequest $request){

    $data=$request->validated();

    // Rechercher l'utilisateur par email
    $user = User::where('email', $request->email)->first();
   
    // Vérifier le mot de passe
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'success' => false,
            'message' => ' Invalid credentials'
        ], 401);
    }
    // Générer un token 
    $token = $user->createToken('token')->plainTextToken;

    // Retourner le token dans la réponse
    return response()->json([
        'success' => true,
        'user_information' => new LoginResource($user),
        'token' => $token,
        'message' => 'User logged in successfully'
    ]);
}

        protected function createTokenForUser($user){
            $token = $user->createToken('auth_token')->plainTextToken;
                return $token;
        }

    public function logout(Request $request){
            //$request->user()->currentAccessToken()->delete();
                // pour se deconnecter de tous les appareils
                $request->user()->tokens()->delete(); 

                return response()->json([
                    'success' => true,
                    'message' => 'User logged out successfully'
                ]);
            }


}
