<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use App\Classes\Upload;
use App\Models\Gallery;
use App\Models\Photo;
use Auth;
use App\User;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(GalleryRequest $request)
    {
        $data = $request->all();
        $file = $request->file('preview');
        
        $upload = new Upload();
        $path = $upload->save($file);
        
        $data['path'] = $upload->filePath;
        $data['preview'] = $path;
        $data['user_id'] = Auth::user()->id;
        $data['private'] = (!empty($data['private']))? '1': '0';
        
        Gallery::create($data);
        
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photos = Photo::where('gallery_id', $id)
                ->get();
        
        $gallery = Gallery::find($id);
        
        return view('gallery.show', [
            'gallery' => $id,
            'photos' => $photos,
            'user_id' => $gallery->user_id
        ]);
    }
    
    public function showUserGallery($user)
    {
        $user = User::where('name', $user)->first();
        
        if(empty($user)){
            abort(404);
        }
        
        $galleries = $user->galleries()
            ->where('private', 0)
            ->get();
        
        return view('home', [
            'gallery' => $galleries
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
