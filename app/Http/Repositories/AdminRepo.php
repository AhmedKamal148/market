<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\AdminInterface;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminRepo implements AdminInterface
{
    public function index()
    {
        $products_count = Product::count();
        $users_count = User::count();
        $categories_count = Category::count();
        $orders_count = Order::count();
        return view('admin.pages.home', compact('products_count', 'users_count', 'categories_count', 'orders_count'));
    }
}
