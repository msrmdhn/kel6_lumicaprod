<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Team;
use App\Models\Credit;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // 1. HALAMAN HOME (Tampilkan 3 Portofolio Terbaru)
    public function index()
    {
        $latestPortfolios = Portfolio::latest()->take(3)->get();
        return view('welcome', compact('latestPortfolios'));
    }

    // 2. HALAMAN PORTOFOLIO (Semua Foto)
    public function portfolio()
    {
        $portfolios = Portfolio::latest()->get();
        return view('pages.portfolio', compact('portfolios'));
    }

    // 3. HALAMAN ABOUT TEAM
    public function team()
    {
        $teams = Team::all();
        return view('pages.team', compact('teams'));
    }

    // 4. HALAMAN CREDIT (Developer)
    public function credit()
    {
        $credits = Credit::all();
        return view('pages.credit', compact('credits'));
    }
}