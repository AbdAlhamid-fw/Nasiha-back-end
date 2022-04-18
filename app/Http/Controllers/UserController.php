<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //get all
    public function index()
    {
        $users = User::get();
        return $users;
    }

    // get details
    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }

    //create
    public function store(Request $request)
    {

        $user = User::create($request->all());
        return
            [
                "message" => "message from me",
                "data" => $user,
            ];
    }


    //update
    public function update(Request $request, $id)
    {
        //for get request only from request rule
        $user = User::find($id);
        $user->update($request->all());

        return [
            "message" => "تم التعديل بنجاح ",
            "data" => $user
        ];
    }

    //  delete user
    public function destroy($id)
    {
        //first for  return first  item  ,
        $user = User::where("id", $id)->first();
        if ($user) {
            $user->delete();
            return response()->json([
                "message" => "تم حذف العنصر بنجاح ",
            ]);
        } else {
            return response()->json([
                "message" => "العنصر غير موجود ",
                "status" => "404",
            ]);
        }
    }
}
