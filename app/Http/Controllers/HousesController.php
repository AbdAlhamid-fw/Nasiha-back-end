<?php

namespace App\Http\Controllers;

use App\Models\Houses;
use Illuminate\Http\Request;

// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Storage;
// use Cabon\Carbon;r

class HousesController extends Controller
{
    //TODo
    //  Title
    // city
    // Region
    // Detailed address
    // Display type
    // price
    // home_space
    // number_of_rooms
    // number of entrances
    // cladding status
    // intermediary
    // floor
    // directione

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $houses = Houses::select(
            'id',
            'title',
            'price',
            'home_space',
            'number_of_rooms',
            'number_of_entrances',
            'cladding_status',
            'intermediary',
            'floor',
            'directione',
            'description',
            'image',
            'city',
            'region',
            'detailed_address',
            'offer_type',
            'user_id'
        );
        if ($request->has('title')) {
            $houses->where('title',  $request->title);
        }
        if ($request->has('city')) {
            $houses->where('city',  $request->city);
        }
        if ($request->has('price')) {
            $houses->where('price',  $request->price);
        }
        if ($request->has('home_space')) {
            $houses->where('home_space',  $request->home_space);
        }

        if ($request->has('number_of_rooms')) {
            $houses->where('number_of_rooms', $request->number_of_rooms);
        }

        return $houses->get();
    }

    // user Houses
    public function userHouses(Request $request)
    {
        $houses = Houses::select('id', 'title', 'description', 'image', 'user_id');

        if ($request->has('user_id')) {
            $houses->where('user_id',  $request->user_id);
        }

        return $houses->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        $request->validate([
            'title' => 'required',
             'description' => 'required',
            'user_id' => 'required',
        ]);

        try {
            // $imageName = Str::random() . '.' . $request->image->getClientOriginalExtension();
            // // TODO: put => putFileAs
            // Storage::disk('public')-> put('houses/image', $request->image, $imageName);
            // Houses::create($request->post() + ['image' => $imageName]);
            $houses = Houses::create($request->all());
            return
                [
                    "message" => "house Created Successfull",
                    "data" => $houses,
                ];
        } catch (\Exception $e) {
            // \Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something goes wrong while creating a house!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Houses  $houses
     * @return \Illuminate\Http\Response
     */
    // TODO
    public function show($id)
    {
        $house = Houses::find($id);

        return [
            "message" => "التفاصيل",
            "data" => $house
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Houses  $houses
     * @return \Illuminate\Http\Response
     */
    public function edit(Houses $houses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Houses  $houses
     * @return \Illuminate\Http\Response
     */
    //update house
    public function update(Request $request, $id)
    {
        try {
            $house = Houses::find($id);
            $house->update($request->all());
            return [
                "message" => "تم التعديل بنجاح ",
                "data" => $house
            ];
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something goes wrong while deleting a houses!!'
            ]);
            // try {

            //     $houses->fill($request->post())->update();

            //     if ($request->hasFile('image')) {

            //         // remove old image
            //         if ($houses->image) {
            //             $exists = Storage::disk('public')->exists("houses/image/{$houses->image}");
            //             if ($exists) {
            //                 Storage::disk('public')->delete("houses/image/{$houses->image}");
            //             }
            //         }

            //         $imageName = Str::random() . '.' . $request->image->getClientOriginalExtension();
            //         // TODO: put
            //         Storage::disk('public')->put('houses/image', $request->image, $imageName);
            //         $houses->image = $imageName;
            //         $houses->save();
            //     }

            //     return response()->json([
            //         'message' => 'house Updated Successfully!!'
            //     ]);
            // } catch (\Exception $e) {
            //     // \Log::error($e->getMessage());
            //     return response()->json([
            //         'message' => 'Something goes wrong while updating a house!!'
            //     ], 500);
        }
    }
    // ------------------------DELETE-------------------------------------------------------------------------
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Houses  $houses
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        try {

            // if ($houses->image) {
            //     $exists = Storage::disk('public')->exists("houses/image/{$houses->image}");
            //     if ($exists) {
            //         Storage::disk('public')->delete("houses/image/{$houses->image}");
            //     }
            // }

            // $houses->delete();
            $house = Houses::find($id);

            if ($house) {
                $house->delete();
                return response()->json([
                    'message' => 'house Deleted Successfully!!',
                    'data' =>  $house
                ]);
            } else {
                return response()->json([
                    "message" => "العنصر غير موجود ",
                    "status" => "404",
                ]);
            }
        } catch (\Exception $e) {
            // \Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something goes wrong while deleting a houses!!'
            ]);
        }
    }
}
