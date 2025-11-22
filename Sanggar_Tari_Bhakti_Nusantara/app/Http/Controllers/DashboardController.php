<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ClassModel;
use App\Models\ClassEnrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalProducts = Product::count();
        $totalClasses = ClassModel::count();
        $totalEnrollments = ClassEnrollment::count();
        $pendingEnrollments = ClassEnrollment::where('status', 'pending')->count();
        
        $recentEnrollments = ClassEnrollment::with(['user', 'classModel'])
            ->latest()
            ->take(5)
            ->get();
        
        $recentUsers = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalClasses',
            'totalEnrollments',
            'pendingEnrollments',
            'recentEnrollments',
            'recentUsers'
        ));
    }
}
