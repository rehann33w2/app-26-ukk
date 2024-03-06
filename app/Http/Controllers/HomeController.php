<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $buku = Buku::with('kategori')
            ->get();
        return view('landing_page')
            ->with('buku', $buku);
    }
}
