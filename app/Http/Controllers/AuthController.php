<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        dd($request->all());
        $Identifiants = $request->validated();

        //tenter de se connecter avec Auth::attempt
        if (!Auth::attempt($Identifiants)) {
             response()->json([
                'success' => false,
                'message' => 'Identifiants invalides'
        ], 401);
        }

        //recuperer le user connecte
        $user = Auth::User();
        $token = $this->createTokenForUser($user);

        return response()->json([
            "data" => [
                "user"=>$user,
                "token"=>$token

            ],
            'message' => 'Connexion réussie',
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
