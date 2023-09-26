<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Products = Product::with('Category')->get();
        return view('dashboard.product.index', compact('Products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // For Recve data form table Category where is_active LIKE true
        $categories = Category::where('is_active', true)->get();
        return view('dashboard.product.creat', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = validator($request->all(), [
            'title' => "required|string|min:3|max:40|unique:products,title",
            'description' => "required|string|min:3|max:100",
            'price' => "required|numeric",
            'quantity' => "required|numeric",
            'category_id' => "required|string|exists:categories,id"
        ]);

        // in case thers no fails save data else send error message
        if (!$validator->fails()) {

            $product = new Product();
            $product->title = $request->get('title');
            $product->description = $request->get('description');
            $product->price = $request->get('price');
            $product->quantity = $request->get('quantity');
            $product->category_id = $request->get('category_id');
            $isSave = $product->save();

            if ($isSave) {
                return response()->json([
                    'message' => 'تم حفظ العنصر بنجاح',
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'حدث مشكلة أثناء حفظ العنصر',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            // to send message to js in creat blade
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $category = category::get();
        return view('dashboard.product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $validator = validator($request->all(), [
            'title' => "required|string|min:3|max:40|unique:products,title,$product->id",
            'description' => "required|string|min:3|max:100",
            'price' => "required|numeric",
            'quantity' => "required|numeric",
            'category_id' => "required|string|exists:categories,id"
        ]);

        // in case thers no fails save data else send error message
        if (!$validator->fails()) {
            $product->title = $request->get('title');
            $product->description = $request->get('description');
            $product->price = $request->get('price');
            $product->quantity = $request->get('quantity');
            $product->category_id = $request->get('category_id');
            $isSave = $product->save();

            if ($isSave) {
                return response()->json([
                    'message' => 'تم حفظ العنصر بنجاح',
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'حدث مشكلة أثناء حفظ العنصر',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            // to send message to js in creat blade
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $isDeleted = Product::findOrFail($id)->delete();
        if ($isDeleted) {
            return response()->json([
                'message' => 'تم الحذف بنجاح',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'حدث مشكلة أثناء حذف العنصر',
            ], Response::HTTP_BAD_REQUEST);
        }
        
    }
}
