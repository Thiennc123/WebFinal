<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Album::where('status','Public')->paginate(20);
        

        
        
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
          $album = new Album();
        
        $album->status = $request->input('status');
        $album->title = $request->input('title');
        $album->discript = $request->input('discript');
        $album->user_id = $id;
        if($request->hasfile('file'))
        {


            $files = $request->file('file');
            foreach ($files as $index=>$file) {
                $extension = $file->getClientOriginalExtension();
                $filename = rand().'.'.$extension;
                // $file->move('image',$filename);
                Storage::disk('public')->put($filename, file_get_contents($file));
                $url = Storage::url($filename);

                $photo = new Photo();
        
                $photo->status = $request->input('status');
                $photo->title = $request->input('title');
                $photo->discript = $request->input('discript');
                $photo->link = $url;

                $album->link = $url;
                if($index <= 0)
                {
                     $album->save();
                }

                $photo->save();
                $a = Album::find($album->id);
                $a->photos()->attach($photo->id);
                

            }
        }else{
            return dd('dsfds');
        }

        $album->save();
       

        return response()->json([
            'message'=>'them thanh cong',
            'data'=>$album
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
    public function update(Request $request, $id, $link, $img)
    {
        //  $album = Album::find($id);
        
        // $album->status = $request->input('status');
        // $album->title = $request->input('title');
        // $album->discript = $request->input('discript');
        // if($request->hasfile('image'))
        // {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time().'.'.$extension;
        //     $file->move('image',$filename);
        //      $photo = new Photo();
        
        //         $photo->status = $request->input('status');
        //         $photo->title = $request->input('title');
        //         $photo->discript = $request->input('discript');
        //         $photo->link = $filename;
        //     $album->link = $filename;
        //     $photo->save();
        //         $a = Album::find($album->id);
        //         $a->photos()->attach($photo->id);
        // }else{
        //    $album->link = $link;
        // }

        // $album->save();
        

        //  return view('AddAlbum');

         $album = new Album();
        
        $album->status = $request->input('status');
        $album->title = $request->input('title');
        $album->discript = $request->input('discript');
        if($request->hasfile('file'))
        {


            $files = $request->file('file');
            foreach ($files as $index=>$file) {
                $extension = $file->getClientOriginalExtension();
                $filename = rand().'.'.$extension;
                // $file->move('image',$filename);
                Storage::disk('public')->put($filename, file_get_contents($file));
                $url = Storage::url($filename);

                $photo = new Photo();
        
                $photo->status = $request->input('status');
                $photo->title = $request->input('title');
                $photo->discript = $request->input('discript');
                $photo->link = $url;

                $album->link = $url;
                // if($index <= 0)
                // {
                //      $album->save();
                // }

                $photo->save();
                $a = Album::find($id);
                $a->photos()->attach($photo->id);
                

            }
        }else{
            return dd('dsfds');
        }

        
       

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
        $album = Album::find($id);
        $album->delete();
        return response()->json([
            'message'=>'remove thanh cong'
        ],201);
    }
}
