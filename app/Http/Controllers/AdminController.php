<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Songs;
use App\Statuses;
use App\Complain;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('check');
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    Вывод категорий
    public function index()
    {

        $categories = Categories::all();
        return view('admin.index', ['page'=>'index', 'categories'=>$categories, 'adminPage'=>'admin']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

//    Добавление новой категории
    public function create()
    {
        $category = new Categories();
        return  redirect('admin')->with('page','index')->with('adminPage','admin')->with('category', $category);
        //return view('admin.index', ['page'=>'index']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

//    Получение данных с формыдлясоздание категории
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'=> 'required|unique:categories'
        ]);

        $category = new Categories();
        $category->title = $request->title;

        if (!$category->save())
        {
            $err=$category->getErrors();
            return redirect()->action('AdminController@create')->with('error', $err)->withInput();
        }
        return redirect()->action('AdminController@create')->with('message', 'Категория "' . $category->title . '" добавлена!');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
//        return $request->user();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

//    Обновление категории и статуса аудио
    public function update(Request $request, $id)
    {
        $song = Songs::find($id);
        $song->category_id = $request->category_id;
        $song->status_id = $request->status_id;
        $song->save();

        if ($request->new == 'new') {
            return redirect('admin/songs/new')->with('message', 'Данные успешно обновлены!');
        }
        return redirect('admin/songs')->with('message', 'Данные успешно обновлены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

//    Удаление категории
    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();
        return redirect('admin');
    }

//    Полный список аудио
    public function songs()
    {
        $songs = Songs::all();
        $categories = Categories::pluck('title', 'id');
        $statuses = Statuses::pluck('title', 'id');
        return view('admin.songs', ['page'=>'songs', 'adminPage'=>'admin', 'songs'=>$songs, 'categories'=>$categories, 'statuses'=>$statuses]);
    }

//    Аудио со статусом "новый"
    public function newSongs()
    {
        $songs = Songs::where('status_id', 1)->get();
        $categories = Categories::pluck('title', 'id');
        $statuses = Statuses::pluck('title', 'id');
        return view('admin.newsongs', ['page'=>'songs', 'adminPage'=>'admin', 'songs'=>$songs, 'categories'=>$categories, 'statuses'=>$statuses]);
    }

    public function users()
    {
        $users = User::where('name', '!=', 'Admin')->get();
        return view('admin.users', ['users' => $users, 'page'=>'users', 'adminPage'=>'admin']);
    }

//    Блокировка пользователей
    public function userUpdate($id) {
        $user = User::find($id);
        $user->blocked == 0 ? $user->blocked = 1 : $user->blocked = 0;
        $user->save();
        return redirect('admin/users');
    }

//    Вывод всех жалоб
    public function complaints()
    {
        $statuses = Statuses::pluck('title', 'id');
        $complaints = Complain::all();
        $complaints->join('songs', 'songs.id', '=', 'song_id');
//        dd($complaints);
        return view('admin.complaints', ['page'=>'complaints', 'adminPage'=>'admin', 'complaints'=>$complaints, 'statuses'=>$statuses]);
    }

//    Вывод жалоб со стутусом "новый"
    public function newComplaints()
    {
        $statuses = Statuses::pluck('title', 'id');
        $complaints = Complain::join('songs', 'songs.id', '=', 'song_id')
            ->where('complaints.status_id', 1)
            ->get();

        return view('admin.newcomplaints', ['page'=>'complaints', 'adminPage'=>'admin', 'complaints'=>$complaints, 'statuses'=>$statuses]);
    }

    // Обновление статуса жалоб
    public function updateComplaint(Request $request, $id)
    {
        //dd($id);
        $complaint = Complain::find($id);

        $complaint->status_id = $request->status_id;

        $complaint->save();

        if (isset($request->new)) {
            return redirect('admin/complaints/new')->with('message', 'Данные успешно обновлены!');
        }
        return redirect('admin/complaints')->with('message', 'Данные успешно обновлены!');
    }
}
