<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $productsSold = OrderDetail::sum('qty');
        $revenue = Order::sum('total');
        $ordersCount = Order::count();
        $productsCount = Order::count(); // Note: Ensure this should be the count of products, not orders
        $recentOrders = Order::orderBy('created_at', 'desc')->limit(10)->get();

        // Prepare data for chart
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $revenueData = array_fill(0, 12, 0); // Initialize array with zeroes

        foreach ($months as $index => $month) {
            $revenueData[$index] = Order::whereMonth('created_at', $index + 1)->sum('total');
        }

        return view('dashboard', [
            'productsSold' => $productsSold,
            'revenue' => $revenue,
            'ordersCount' => $ordersCount,
            'productsCount' => $productsCount, // Assuming this should be products count
            'recentOrders' => $recentOrders,
            'months' => $months,
            'revenueData' => $revenueData
        ]);
    }
}
