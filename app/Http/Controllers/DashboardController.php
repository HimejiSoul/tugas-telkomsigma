<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch category data for Pie Chart
        $categoryData = Person::select('category', DB::raw('count(*) as count'))
            ->groupBy('category')
            ->get();

        // Fetch date aggregated data for Column Chart
        $dateData = Person::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();

        return view('dashboard.index', compact('categoryData', 'dateData'));
    }
}
