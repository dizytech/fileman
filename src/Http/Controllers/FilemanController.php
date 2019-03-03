<?php

namespace Dizytech\Fileman\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilemanController extends Controller
{
    public function index(Request $request)
    {
        return view('fileman::index');
    }
}