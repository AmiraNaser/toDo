<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\user;

class userController extends Controller
{
    //
    public function index(){
       $data =  user :: orderBy('id','desc')->get();
       return view('users.index',["data" => $data]);

    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){

    $data =  $this->validate($request,[
            "name"     => "required|string",
            "email"    => "required|email",
            "password" => "required|min:6"
     ]);

    $data['password'] = bcrypt($data['password']);

    $op = user :: create($data);

     if($op){
         $message = 'data inserted';
     }else{
         $message =  'error try again';
     }

     session()->flash('Message',$message);

     return redirect(url('/User/'));

    }

    public function edit($id){

        $data = user :: find($id);

        return view('users.edit',["data" => $data]);
    }

    public function update(Request $request,$id){


        $data =  $this->validate($request,[
            "name"     => "required|string",
            "email"    => "required|email"
          ]);

         $op =  user :: where('id',$id)->update($data);

         if($op){
            $message = 'Raw Updated';
        }else{
            $message =  'error try again';
        }

        session()->flash('Message',$message);

        return redirect(url('/User/'));
    }

    public function delete($id){

       $op =  user::find($id)->delete();
       if($op){
          $message = "Raw Removed";
       }else{
          $message = 'Error Try Again';
       }

        session()->flash('Message',$message);

        return redirect(url('/User/'));

    }

    public function login(){
        return view('users.login');
    }

    public function doLogin(Request $request){

     $data =  $this->validate($request,[
         "password"  => "required|min:6",
         "email"     => "required|email"
       ]);


       if(auth()->attempt($data)){

        return redirect(url('/Task'));

       }else{
           session()->flash('Message','invalid Data');
           return redirect(url('/User/Login'));
       }
    }

    public function LogOut(){

        auth()->logout();
        return redirect(url('/User/Login'));
    }
}
