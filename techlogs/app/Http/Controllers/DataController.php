<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class DataController extends Controller
{
    //
    public function index(){
        
        $records=Data::all();
        return view('addData',['records'=>$records]);
    }

    public function getData(){
        
        $records=Data::all();
        return response($records->toArray());
    }

    public function store(Request $request){
        if(empty($request->input('content'))){
                return response()->json(['error'=>'Please fill all fields' ]);
            }

        try {
        $data=new Data();
       $data->added_by = Auth::user()->email;
       $data->identifier = $request->input('identifier');
       $data->content = $request->input('content');
       $data->group = $request->input('group');
       $data->station = $request->input('station');
       $data->section = $request->input('section');
       $data->region = $request->input('region');
       $data->save();
       return response()->json(['success'=>'Data Added successfully' ]);
      
       //code...
   } catch (\Throwable $th) {
       //throw $th;
       return response()->json(['error'=>$th ]);
   }  
    }

    public function getById($id){
        $dataById= Data::findOrFail($id); 
        return response()->json($dataById);
    }
    public function update(Request $request,$id){
        $data = Data::find($id);
        $data->identifier = $request->input('identifier');
        $data->content = $request->input('content');
        $data->group = $request->input('group');
        $data->station = $request->input('station');
        $data->section = $request->input('section');
        $data->region = $request->input('region');
        if($data->save()){
            return response()->json(['success'=>'Data Updated successfully' ]);
        }else{
            return response()->json(['error'=>'An error occured' ]);
        }
    }

    public function delete($id){
        $data = Data::find($id);
        if($data->delete()){
            return response()->json(['success'=>'Data deleted successfully' ]);
        }else{
            return response()->json(['error'=>'An error occured' ]);
        }
    }
}
