<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QROpenPackingModel;


class OpenPackingController extends Controller
{
    public function index (){
        $key = "Report Open Packing";
        $data = QROpenPackingModel::all();

        return view('openpack.index', compact('key','data'));
    }
}
