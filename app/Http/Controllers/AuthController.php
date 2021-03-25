<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request) {
        $validator = \Validator::make($request->all(), [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'email'         => 'required|string|email|unique:users',
            'phone'         => 'required|unique:users',
            'password'      => 'required|between:8,15|string|confirmed',
            // 'device_token'  => 'required|string'
        ]);

		if ($validator->fails()) {
		   return response()->json(['success' => false, 'errors' => $validator->errors(), 'message' => 'Validation failed.'], 422);
		}

        $user = new User([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'device_token'  => $request->device_token,
            'password'      => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json(['success' => true, 'user' => $user, 'message' => 'Registration has been done successful.'], 201);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request) {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|between:8,15',
            'remember_me' => 'boolean'
        ]);

		if ($validator->fails()) {
		   return response()->json(['success' => false, 'errors' => $validator->errors(), 'message' => 'Validation failed.'], 422);
		}

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'Wrong credentials.'], 400);
        }

        $user = $request->user();
        $user->device_token = $request->input('device_token');
        $user->save();
        
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'success' => true,
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['success' => true, 'message' => 'Successfully logged out'], 200);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function me() {
        //return response()->json($request->user());
        return response()->json(['success' => true, 'my_profile'=> Auth::user(), 'message' => 'Succeffully fetched my profile data.'], 200);
    }
}