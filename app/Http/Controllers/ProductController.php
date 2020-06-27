<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $storage_folder = "products/images";

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return ProductResource::collection(Product::with('user:name')->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductRequest $request
     * @return ProductResource
     */
    public function store(CreateProductRequest $request)
    {
        $product = new Product;
        $product->user_id = $request->user()->id;
        $product->name = $request->name;
        $product->price = $request->price;

        if ($file = $request->file('main_image')) {
            $main_image = explode('/', Storage::disk('public')->put($this->storage_folder, $file));
            $product->main_image = last($main_image);
        }

        $product->details = $request->details;
        $product->save();

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return ProductResource
     */
    public function update(CreateProductRequest $request, Product $product)
    {
        $product->update($request->only(['name', 'price', 'details']));

        if ($file = $request->file('main_image')) {
            if ($product->main_image) Storage::delete($this->storage_folder . "/" . $product->main_image);
            $main_image = explode('/', Storage::disk('public')->put($this->storage_folder, $file));
            $product->main_image = last($main_image);
        }

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
