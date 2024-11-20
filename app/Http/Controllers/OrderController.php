<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index(Request $request)
    {
        return new ProductCollection(Product::all());
    }

    // Hiển thị chi tiết sản phẩm
    public function show(Request $request, Product $product)
    {
        return new ProductResource($product);
    }

    // Thêm mới sản phẩm
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = Product::create($validated);

        return new ProductResource($product);
    }

    // Cập nhật thông tin sản phẩm
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product->update($validated);

        return new ProductResource($product);
    }

    // Xóa sản phẩm
    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        return response()->noContent();
    }
}
