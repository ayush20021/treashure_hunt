<?php

namespace App\Http\Controllers;

use App\Models\Treasure;
use App\Models\TreasureImage;
use App\Models\TreasureReports;
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
        $treasures = Treasure::with('images')->limit(10)->get();
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
        $treasure = Treasure::with(['images', 'votes'])->findOrFail($id);

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
            'cover_image' => $treasure->images->isNotEmpty() ? $treasure->images->random()->path : null,
            'upvotes' => (int) $treasure->upvotes,
            'downvotes' => (int) $treasure->downvotes,
            'user_vote' =>  $treasure->userVoteType()
        ];

       // dd($result);

        $treasure = $result;

//        dd($result);
        return view('treasures.details',compact('treasure'));
    }


    public function treasureVote(Request $request, Treasure $treasure)
    {
        $request->validate([
            'vote_type' => 'required|in:up,down'
        ]);

        $existingVote = $treasure->votes()->where('user_id', auth()->id())->first();

        if ($existingVote) {
            if ($existingVote->vote_type === $request->vote_type) {
                $existingVote->delete();
                $message = 'Your vote has been removed.';
                $currentVote = null;
            } else {
                $existingVote->update(['vote_type' => $request->vote_type]);
                $message = 'Your vote has been updated.';
                $currentVote = $request->vote_type;
            }
        } else {
            $treasure->votes()->create([
                'user_id' => auth()->id(),
                'vote_type' => $request->vote_type
            ]);
            $message = 'Thanks for your vote!';
            $currentVote = $request->vote_type;
        }

        return response()->json([
            'success' => true,
            'upvotes' => $treasure->upvotes,
            'downvotes' => $treasure->downvotes,
            'current_vote' => $currentVote,
            'message' => $message
        ]);
    }

    function reportTreasure(Request $request)
    {
        $request->validate([
            'treasure_id' => 'required|exists:treasures,id',
            'reason' =>'required|string',
            'details' => 'nullable|string'

        ]);


        //dd($request->all());

        $treasure_report = TreasureReports::create([
            'treasure_id' => $request->treasure_id,
            'report_reason' =>$request->reason,
            'additional_details' => $request->details ?? '',
            'user_id' => auth()->id()

        ]);

        if($treasure_report){
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }

    }


    public function search(Request $request)
    {
        $query = $request->input('q');

        if (empty($query)) {
            return response()->json([]);
        }

        $treasures = Treasure::search($query)->take(5)->get()->load('images');

        return response()->json($treasures);
    }

}
