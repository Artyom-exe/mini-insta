<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;

class HomepageController extends Controller
{
    public function index()
    {
        $publications = Publication::all();

        return view('homepage.index', [
            'publications' => $publications,
        ]);
    }
}
