<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view ('welcome');

	}
	public function cookies()
    {
        return view ('cookies');

	}
	public function contact()
    {
        return view ('contact');

    }
}