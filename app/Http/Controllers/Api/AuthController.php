<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postLogin(Request $request)
    {
        $array = $request->only('email', 'password');

        $validate = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        // if(Auth::attempt($array))
        // {
     //        $user = Auth::User();
     //        $request->session()->put('data',Auth::User());
     //        if($user->userName === 'admin')
        //    return redirect('Manage')->with('info','Success');
     //        else
     //            return redirect('Feeds_Photo')->with('info','123');
        // }else{
        //  return view('login')->with('info','Dang nhap that bai! Email hoac mat khau khong dung');
        // }

        if(!Auth::attempt($array))
        {
            return response()->json([
                'success'=>'false',
                'message'=>'Ban khong co quyen'
            ], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'success'=>'true',
            'message'=>'Login thanh cong',
            'access_token' => $tokenResult->accessToken,
            'user_id'=>$user->id,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
        
        
    }

    public function logout(Request $request)
    {
        // Auth::logout();
     //    session()->forget('data');
        // return redirect('Feeds_Photo');
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Dang suat thanh cong'
        ]);
    }

    public function setRegister(Request $request)
    {
        $validate = $request->validate([
            'userName'=>'unique:users',
            'email'=>'required|unique:users',
            

        ]);

        $user = new User();
        $user->userName = $request->userName;
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email=$request->email;
        $user->password = bcrypt($request->password);

        // if($request->hasfile('image'))
        // {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time().'.'.$extension;
        //     $file->move('image',$filename);
            
            
        $user->avatar = '/storage/default.jpg';
        // }else{
        //     return dd('dsfds');
        // }
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
