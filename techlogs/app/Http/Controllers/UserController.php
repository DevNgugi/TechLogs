<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Data;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index()
    {
        $records = Data::all();
        return view('addUser', ['records' => $records]);
    }

    public function viewUsers()
    {
        $records = User::all();
        return view('viewUsers', ['records' => $records]);
    }
    public function singleUser($id)
    {
        $user = User::findOrFail($id);
        
          $created_at=Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->diffForHumans();
       
          return response()->json(['user' => $user,'created_at'=> $created_at]);
    }

    public function store(Request $request)
    {

        $user = new User();
        $exists = User::where('email', '=', $request->input('email'))->first();

        if ($exists !== null) {
            return response()->json(['error' => 'Email already exists']);
        }
        // $data = $request->all();

        // foreach ($data as $key => $value) {
        //    if(empty(trim($value))){

        //         return response()->json(['error'=>'Please fill all fields' ]);
        //     }

        // }

        try {
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            $user->role = $request->input('role');
            $user->phone = $request->input('phone');
            $user->station = $request->input('station');
            $user->section = $request->input('section');
            $user->region = $request->input('region');
            $user->unit = $request->input('unit');
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return response()->json(['success' => 'User Added successfully']);

            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th]);
        }
    }

    public function profile()
    {

        return view('profile', ['user' => User::findOrFail(Auth::User()->id)]);
       
    }

    public function profileId($id)
    {
        $UserById = User::findOrFail($id);
        return response()->json($UserById);
    }
    public function changePass(Request $request, $id)
    {
        $UserById = User::findOrFail($id);
        if ($request->input('newPass') == null || $request->input('renewPass') == null) {
            return response()->json(['error' => 'Error! : Fields cannot be empty']);
        }

        if (Hash::check($request->input('currentPass'), $UserById->password)) {
            if ($request->input('newPass') == $request->input('renewPass')) {
                $UserById->password = Hash::make($request->input('newPass'));
                if ($UserById->save()) {
                    return response()->json(['success' => 'Success! : Password Changed successfully']);
                }
            } else {
                return response()->json(['error' => 'Error! : Password confirmation does not match!']);
            }
        } else {
            return response(['data' => 'Wrong Current password entered!']);
        }
    }

    public function deleteUser($id){
        $user=User::findOrFail($id);
        if($user->delete()){
            return response(['success' => 'User removed!']);
        }
        return response(['error' => 'Some error occured!']);
    }
}
