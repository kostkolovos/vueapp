<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Contracts\Support\Renderable;

class HomeVueController extends Controller
{
    const title = 'Very good title';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('welcomevue', ['title' => self::title]);
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function page()
    {
        $user = User::find(1);
        return view('page', ['title' => self::title, 'author' => json_encode([
            "name" => $user->name,
            "role" => $user->email,
            "code" => "Dirty as socks"
        ])]);
    }

}
