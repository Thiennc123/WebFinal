<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

use Session;

use App\User;

use App\Photo;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $getData = DB::table('photos')->where('status','public')->paginate(20);
         // return view('Feeds_Photo',['listImg'=>$getData]);
         return response()->json($getData, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validate = $request->validate([
            'title'=>'required',
            'discript'=>'required',
            'file'=>'required'
        ]);
        $photo = new Photo();
        
        $photo->status = $request->input('status');
        $photo->title = $request->input('title');
        $photo->discript = $request->input('discript');

        if($request->hasfile('file'))
        {
            $files = $request->file('file');

            foreach ($files as $key=>$file) {
            $extension = $file->getClientOriginalExtension();
            
            $filename = rand().'.'.$extension;
           
             Storage::disk('public')->put($filename, file_get_contents($file));
             $url = Storage::url($filename);
            $photo->link = $url;
        }
        }else{
            return dd('dsfds');
        }

        

        $photo->save();
        $a = User::find($id);
        $a->photos()->attach($photo->id);

        // return view('AddPhoto');
        return response()->json([
            'message'=>'them thanh cong',
            'data'=>$photo
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);
        
        $photo->status = $request->input('status');
        $photo->title = $request->input('title');
        $photo->discript = $request->input('discript');
        
        if($request->hasfile('file'))
        {
        $files = $request->file('file');
            foreach ($files as $key=>$file) {
                
            
           
            $extension = $file->getClientOriginalExtension();
            $filename = rand().'.'.$extension;

             Storage::disk('public')->put($filename, file_get_contents($file));
             $url = Storage::url($filename);
            $photo->link = $url;
        }
        }else{
           $photo->link = $link;
        }

        $photo->save();
        
         return response()->json([
            'message'=>'edit thanh cong',
            'data'=>$photo
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Photo::find($id);
        $image->delete();
        return response()->json([
            'message'=>'remove thanh cong'
        ],201);
    }
}
