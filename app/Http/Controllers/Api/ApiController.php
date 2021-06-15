<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function index()
    {
        return 'this is first api';
    }

    public function postapi(Request $request)
    {
        $data = array(
            'type'=>'Post',
            'message'=>'This is Post Api'
        );
        return response()->json($data);
    }

    public function getapi()
    {
        $data = array(
            'type'=>'GET',
            'message'=>'This is GET Api'
        );
        return response()->json($data);
    }

    //single image upload 
    public function singleimage(Request $request)
    {
        $rulse = [
            'img'=>'required'
        ];
        $message = array(
            'image.required'=>'img field is required'
        );
        $validator = Validator::make($request->all(), $rulse, $message);   

            if ($validator->fails()) 
            {          
                return response()->json($validator->errors());
            } 

            if($request->img)
            {
                $imageName = time().'.'.$request->img->extension();
                $request->img->move('public/upload', $imageName);
                $data = array(
                    'image_name' => $imageName,
                    'message'=>'image uploaded successfully'
                );

                
            }
            return response()->json($data);
            
    }

    public function multipleimage(Request $request)
    {
        $rulse = [
            'img'=>'required'
        ];
        $message = array(
            'image.required'=>'img field is required'
        );
        $validator = Validator::make($request->all(), $rulse, $message);   

            if ($validator->fails()) 
            {          
                return response()->json($validator->errors());
            } 
 
             
            foreach($request->file('img') as $mediaFiles) {
                $imageName = rand(111111,999999).'.'.$mediaFiles->extension();
                $mediaFiles->move('public/upload', $imageName);
                
            }
            $data = array(
                'message'=>'Image uploaded successfully'
            );

            return response()->json($data);

    }


    /**
     * register login
     */

    public function login(Request $request)
    {
        $rulse = [
            'email'=>'required|email',
            'password'=>'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ];


        $message = array(
            'password.regex'=> 'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.'
        );
        $validator = Validator::make($request->all(), $rulse, $message);
        if ($validator->fails()) 
        {          
            return response()->json($validator->errors());
        } 

        


    }
}
