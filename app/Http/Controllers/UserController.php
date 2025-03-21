<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user=User::all();
        if($user->count() > 0)
        {
            return response()->json(
                [
                    'status'=>200,
                     'Users'=>$user
                ],200);
        }
        else
        {
            return response()->json(
                [
                    'status'=>404,
                     'message'=>'No Records Found'
                ],404);
        }
        
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422); 
        }
        else
        {
            $user=User::create([
                'name' =>  $request->name,
                'email' => $request->email,
                'phone' => $request->phone,

            ]);

            if($user)
            {
                return response()->json([
                    'status' => 200,
                    'message' => "User created successfully"

                ],200);
            }
            else
            {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong!"
                ],500);

            }
        }
    }
    public function show($id)
    {
        $user=User::find($id);
        if($user)
        {
            return response()->json([
                'status' => 200,
                'User' => $user
            ],200);

        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => "No Such User found!"
            ],404);

        }
    }
    public function edit($id)
    {
        $user=User::find($id);
        if($user)
        {
            return response()->json([
                'status' => 200,
                'User' => $user
            ],200);

        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => "No Such User found!"
            ],404);

        }

    }

    public function update(Request $request,int $id)
    {

        
        $validator=Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422); 
        }
        else
        {
            $user=User::find($id);
            if($user)
            {
                $user->update([
                    'name' =>  $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
    
                ]);    
                return response()->json([
                    'status' => 200,
                    'message' => "User Updated successfully"

                ],200);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => "No Such User Found!"
                ],500);

            }
        }

       
    }

    public function destroy(int $id)
    {
          $user=User::find($id);
          if($user)
          {
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => "User deleted Sucessfully!"
            ],200);    

          }
          else{
            return response()->json([
                'status' => 404,
                'message' => "No Such User Found!"
            ],500);            
          }

       
    }
}
