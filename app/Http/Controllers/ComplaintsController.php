<?php

namespace App\Http\Controllers;

use App\Songs;
use Illuminate\Http\Request;
use App\Complain;

class ComplaintsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($song)
    {
        return view('complaints.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $complaint = new Complain();
        return view('complaints.create', ['complaint' => $complaint]);
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
            'song_id'=> 'required',
            'description'=> 'required'
        ]);

        $complaint = new Complain();
        $complaint->song_id = $request->song_id;
        $complaint->description = $request->description;

        if (!$complaint->save())
        {
            $err=$complaint->getErrors();
            return redirect()->action('ComplaintsController@create')->with('error', $err)->withInput();
        }
        return redirect()->action('SongsController@index')->with('message', 'Песня успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $song = Songs::where('id', $id)->get();

        return view('complaints.create', ['song' => $song]);
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
