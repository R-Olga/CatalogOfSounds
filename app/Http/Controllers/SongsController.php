<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Songs;
use App\Categories;
use Illuminate\Support\Facades\Auth;

class SongsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    Вывод аудио на главной странице странице
    public function index()
    {
        $songs = Songs::where('status_id', '>', 1)->get();
        $categories = Categories::pluck('title', 'id');
        return view('songs.index', ['adminPage'=>'main', 'page'=>'index', 'songs'=>$songs, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::check()) {
            $songs = new Songs();
            $categories = Categories::pluck('title', 'id');
            return view('songs.create', ['adminPage'=>'main', 'songs' => $songs, 'categories'=>$categories]);
        } else {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'=> 'required',
            'songPath' => 'required|mimes:mp3, wav'
        ]);

        $songs = new Songs();

        $songs->title = $request->title;
        $songs->category_id = $request->category_id;

        $originalname = $request->file('songPath')->getClientOriginalName();
        $request->file('songPath')->move(public_path().'/uploadedSongs', $originalname);
        $songs->songPath = 'uploadedSongs/'.$originalname;



        if (!$songs->save())
        {
            $err=$songs->getErrors();
            return redirect()->action('SongsController@create')->with('error', $err)->withInput();
        }
        return redirect()->action('SongsController@index')->with('message', 'Аудио успешно добавлено!')->with('adminPage','main');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $song = Songs::where('id', '=', $id);
        return view('complaints.index')->with('song', $song)->with('adminPage','main');
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

    public function search(Request $request)
    {
        $search = $request->textsearch;
        $search = '%' . $search . '%';
        $category_id = $request->category_id;

        if ($category_id == 0) {
            $songs = Songs::where([
                ['status_id', '>', 1],
                ['category_id', '>', 1],
                ['title', 'LIKE', $search]
            ])->get();
        } else {
            $songs = Songs::where([
                ['status_id', '>', 1],
                ['category_id', '=', $category_id],
                ['title', 'LIKE', $search]
            ])->get();
        }

        $categories = Categories::pluck('title', 'id');
        return view('songs.index', ['adminPage'=>'main', 'songs'=>$songs, 'categories' => $categories]);
    }




}
