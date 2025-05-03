<?php

namespace App\Http\Controllers;

use App\Models\Treasure;
use App\Models\TreasureImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Treasures
{
    //

    function addTreasure(Request $request)
    {
//        $request->validate([
//            'treasureName' => 'required',
//            'treasureDescription' => 'required',
//            'treasure' => 'required|array',
//            'treasure.*' => 'image|mimes:jpeg,png,jpg,gif',
//            'treasureLocation' => 'required',
//            'rating' => 'required',
//            'treasureCategory' => 'required',
//        ]);

//        dd($request->allfiles());

        $treasure_images = $request->file('treasure');

        // Save Treasure
        $treasure = new Treasure();
        $treasure->name = $request->treasureName;
        $treasure->location = $request->treasureLocation;
        $treasure->description = $request->treasureDescription;
        $treasure->category =  $request->treasureCategory;
        $treasure->rating = $request->rating;
        $treasure->latitude = $request->latitude;
        $treasure->longitude = $request->longitude;
        $treasure->added_by = Auth::id();
        $treasure->save();


        foreach ($treasure_images as $treasure_image) {
            $file_name = Str::uuid() . '.' . $treasure_image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/treasures');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $treasure_image->move($destinationPath, $file_name);

            TreasureImage::create([
                'treasure_id' => $treasure->id,
                'path' => 'storage/treasures/' . $file_name,
            ]);

//            echo "Treasure Added Successfully";
        }

        return redirect()->route('add_treasures');
    }



    function getAllTreasures(){
        $treasures = Treasure::with('images')->get();
        $result = [];

        foreach ($treasures as $treasure) {
            $images = $treasure->images->pluck('path')->toArray();
            $result[] = [
                'id' => $treasure->id,
                'name' => $treasure->name,
                'location' => $treasure->location,
                'latitude' => $treasure->latitude,
                'longitude' => $treasure->longitude,
                'description' => $treasure->description,
                'category' => $treasure->category,
                'rating' => $treasure->rating,
                'added_by' => $treasure->added_by,
                'images' => $images, // just the image paths
                'cover_image' => $treasure->images->count() > 0
                    ? $treasure->images->random()->path
                    : null,

            ];
        }
        return view('dashboard',compact('result'));


    }

    public function treasureDetails($id)
    {
//        dd($id);
       // $treasures = Treasure::with('images')->findOrFail($id);
        $treasure = Treasure::with('images')->findOrFail($id); // will 404 if not found

        $images = $treasure->images->pluck('path')->toArray();

        $result = (object) [
            'id' => $treasure->id,
            'name' => $treasure->name,
            'location' => $treasure->location,
            'latitude' => $treasure->latitude,
            'longitude' => $treasure->longitude,
            'description' => $treasure->description,
            'category' => $treasure->category,
            'rating' => $treasure->rating,
            'added_by' => $treasure->added_by,
            'tips_recommendations' => $treasure->tips_recommendations,
            'images' => $images,
            'cover_image' => $treasure->images->isNotEmpty()
                ? $treasure->images->random()->path
                : null,
        ];

        $treasure = $result;

//        dd($result);
        return view('treasures.details',compact('treasure'));
    }
}
