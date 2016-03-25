<?php

// app/controllers/ArticleController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function showIndex()
    {
        return view('index');
    }

    public function showSingle($articleId)
    {
        return view('single');
    }
}
