<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categoria;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('estado', 'Activo')->count();
        $inactiveProducts = Product::where('estado', 'Desactivo')->count();
        $totalCategories = Categoria::count();
        $totalUsers = User::where('level', 'User')->count();

        return view('dashboard', compact('totalProducts', 'activeProducts', 'inactiveProducts', 'totalCategories', 'totalUsers'));
    }
}
