<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{
    public function index(){
       

        return view('main.index');
    }
    public function show(){
        $stud=Student::all();
        return response()->json(['students'=>$stud]);
    }
    public function store(Request $request){

       $validator=Validator::make($request->all(),[
          'name'=>'required|max:191',
          'email'=>'required',
          'phone'=>'required|max:191',
          'course'=>'required|max:191',
       ]);
    $data=$validator;
       if($validator->fails()){
           return response()->json([
               'status' => 400,
               'errors' =>$validator->messages(),
           ]);
       }
       else{
           $student = Student::create([
               'name'=>$request->name,
                'email'=>$request->email,
                'phone' =>$request->phone,
                'course'=>$request->course
           ]);
           return response()->json([
            'status' => 200,
            'message' =>'Data Added Successfully',
        ]);
       }

     // $student = new Student
    }
}
