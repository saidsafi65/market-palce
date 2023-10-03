<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product-api', function () {


    // $data  = Product::all();
    // $data  = Product::all()->take(10); // لإظهار أو 10 بيانات في القاعدة
    // $data  = Product::all()->skip(10); // لتجاهل أول 10 
    // $data  = Product::all()->skip(10)->take(10); // لتجاهل أول 10 وأخذ الـ 10 الثانية أو التالية
    // $data  = Product::skip(10)->take(10)->get(); // لتجاهل أول 10 وأخذ الـ 10 الثانية أو التالية
    // $data  = Product::take(10)->get(); // لتجاهل أول 10 وأخذ الـ 10 الثانية أو التالية

    $data  = Product::limit(100)->offset(10)->get(); // لتجاهل أول 10 وأخذ الـ 10 الثانية أو التالية

    return response()->json(['data' => $data]);
});

Route::get('product-api-relations', function () {


    // $data  = Category::with('products')->get();     // جميع البيانات حسب العلاقة الموجودة في المودل category
    // $data  = Category::withCount('products')->get();     // 
    // $data  = Category::withCount('products')->take(10)->get();     // اظهار أول 10 عناصر


    // $data  = Category::with(['products' => function ($query) {
    //     $query->where('title', 'LIKE', 'sa%');
    // }])->get();     // تخصيص نطاق البحث في جدول product 
    //                 // مع اظهار المنجات الفارغة في product


    // $data  = Category::has('products', '>=', 3)->get();     // اظهار الناتج الذي يحتوي على 3 منتجات

    // $data  = Category::has('products', '>=', 3)->get();     // اظهار الناتج الذي يحتوي على 3 منتجات

    // $data  = Category::with(['products' => function ($query) {
    //     $query->where('price', '<=', 300);
    // }])->whereHas('products', function ($query) {
    //     $query->where('price', '<=', 300);
    // }, '>=', 1)->get();     // تخصيص نطاق البحث في جدول product 
    //                         // دون اظهار المنجات الفارغة في product


    // $data  = Category::doesntHave('products', 'and', function ($query) {
    //     $query->where('is_active', '=', 0);
    // })->with(['products' => function ($query) {
    //     $query->where('quantity', '<=', 3);
    // }])->get();


    $data = Product::doesntHave('category', 'and', function ($query) {
        $query->where('is_active', '=', 0);
    })->with('category')->get();     // عرض جميع المنتجات التي تحتوي على active category

    return response()->json(['data' => $data]);
});
