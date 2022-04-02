<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Celebrity;

class CelebrityController extends Controller
{
    /**
        * Display a listing of the resource.
        *
        * @return Response
        */
        public function index()
        {
            $celebrities = Celebrity::all();

            return view('celebrities', [
                'celebrities' => $celebrities
            ]);
        }

    /**
        * Display the clicked resource.
        *
        * @return Response
        */
        public function showDetails($id)
        {
            $celebrities = Celebrity::all();
            $celebrity = Celebrity::find($id);

            $celebrityInfo = [
                'image' => $celebrity->image,
                'firstname' => $celebrity->firstname,
                'lastname' => $celebrity->lastname,
                'description' => $celebrity->description
            ];

            // $celebrityClicked = response()->json($celebrity)->original;
            // $celebrityDetailsContent = "<h1>{$celebrityClicked->firstname}</h1>";

            // return $celebrityDetailsContent;

            return view('celebrities', [
                'celebrities' => $celebrities,
                'celebrityInfo' => $celebrityInfo,
                // 'celebrityDetailsContent' => $celebrityDetailsContent
            ]);
        }

    /**
        * Create a new resource.
        *
        * @return Response
        */
    public function createCelebritySheet(Request $request)
    {
        $celebrity = new Celebrity;

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $imageSize = $request->file('image')->getSize();
        $imageName = $request->file('image')->getClientOriginalName();

        $pathFile = $request->file('image')->storeAs('public/upload/', $imageName);

        $celebrity->firstname = $request->firstname;
        $celebrity->lastname = $request->lastname;
        $celebrity->description = $request->description;
        $celebrity->image = $imageName;

        $celebrity->save();

        // return response()->json([
        //     'pathFile' => $pathFile,
        // ]);
    }

    /**
        * Update the specified resource in the database.
        *
        * @param  int  $id
        * @return Response
        */
    public function updateCelebritySheet(Request $request, $id)
    {
        $celebrity = Celebrity::find($id);

        $request->validate([
            'firstname_update' => 'required',
            'lastname_update' => 'required',
            'description_update' => 'required',
            'image_update' => 'required|image',
        ]);

        $imageUpdateSize = $request->file('image_update')->getSize();
        $imageUpdateName = $request->file('image_update')->getClientOriginalName();

        $pathFile = $request->file('image_update')->storeAs('public/upload/', $imageUpdateName);
 
        $celebrity->firstname = $request->firstname_update;
        $celebrity->lastname = $request->lastname_update;
        $celebrity->description = $request->description_update;
        $celebrity->image = $imageUpdateName;

        $celebrity->save();

        // return response()->json([
        //     'pathFile' => $pathFile
        // ]);
    }

     /**
        * Delete the specified resource in the database.
        *
        * @param  int  $id
        * @return Response
        */
        public function delete($id)
        {
            $celebrity = Celebrity::find($id);
 
            $celebrity->delete();
        }
}
