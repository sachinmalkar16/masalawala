<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    public function __construct()
    {
       // $this->middleware('jwt.auth');
    }

    public function getList(){
      //$categories= ProductCategory::where('active',1)->get();
        $categories= ProductCategory::get();
        return response()->json($categories);
    }
}
