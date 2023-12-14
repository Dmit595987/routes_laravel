<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\RMVC\Route\Route;
use App\RMVC\View\View;

class PostController extends Controller
{
    public function index()
    {
        return View::view('post.index');
    }

    public function show($post, $bla)
    {
        return View::view('post.show', compact('post', 'bla'));
    }

    public function store()
    {
        $_SESSION['message'] = $_POST['title'];

        Route::redirect('/posts');
    }
}