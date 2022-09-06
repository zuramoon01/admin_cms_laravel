<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function create()
    {
        return view('product.form', [
            'name' => 'product',
            'menu' => 'create',
            'title' => 'Create Product',
            'formAction' => 'store',
            'formInputs' => [
                [
                    'type' => 'text',
                    'name' => 'name',
                    'label' => 'Name',
                ],
                [
                    'type' => 'text',
                    'name' => 'code',
                    'label' => 'Code',
                ],
                [
                    'type' => 'text',
                    'name' => 'price',
                    'label' => 'Price',
                ],
                [
                    'type' => 'text',
                    'name' => 'purchase_price',
                    'label' => 'Purchase Price',
                ],
                [
                    'type' => 'select',
                    'name' => 'product_categories_id',
                    'label' => 'Product Categories',
                    'options' => ProductCategory::all(),
                ],
                [
                    'type' => 'textarea',
                    'name' => 'short_description',
                    'label' => 'Short Description',
                ],
                [
                    'type' => 'textarea',
                    'name' => 'description',
                    'label' => 'Description',
                ],
                [
                    'type' => 'check',
                    'name' => 'status',
                    'label' => 'Status',
                ],
                [
                    'type' => 'check',
                    'name' => 'new_product',
                    'label' => 'New Product',
                ],
                [
                    'type' => 'check',
                    'name' => 'best_seller',
                    'label' => 'Best Seller',
                ],
                [
                    'type' => 'check',
                    'name' => 'featured',
                    'label' => 'Featured',
                ],
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
            'code' => 'required|max:50',
            'product_categories_id' => 'required|numeric',
            'price' => 'required',
            'purchase_price' => 'required',
            'short_description' => 'nullable|max:250',
            'description' => 'nullable',
            'status' => 'required|max:1|between:0,1|numeric',
            'new_product' => 'required|max:1|between:0,1|numeric',
            'best_seller' => 'required|max:1|between:0,1|numeric',
            'featured' => 'required|max:1|between:0,1|numeric',
        ]);

        $product = Product::create($validated);

        return redirect('/products/data');
    }

    public function data()
    {
        return view('product.data', [
            'name' => 'product',
            'menu' => 'data',
            'title' => 'Table Product',
            'table' => [
                'title' => [
                    'Name',
                    'Code',
                    'Product Categories',
                    'Price',
                    'Purchase Price',
                    'Short Description',
                    'Description',
                    'Status',
                    'New Product',
                    'Best Seller',
                    'Featured',
                ],
                'size' => [3, 3, 3, 2, 2, 3, 4, 1, 1, 1, 1, 1,],
                'data' => Product::all(),

            ],
        ]);
    }

    public function edit(Product $product)
    {
        return view('product.form', [
            'name' => 'product',
            'menu' => 'edit',
            'title' => 'Edit Product',
            'formAction' => 'update',
            'formInputs' => [
                [
                    'type' => 'text',
                    'name' => 'name',
                    'label' => 'Name',
                ],
                [
                    'type' => 'text',
                    'name' => 'code',
                    'label' => 'Code',
                ],
                [
                    'type' => 'text',
                    'name' => 'price',
                    'label' => 'Price',
                ],
                [
                    'type' => 'text',
                    'name' => 'purchase_price',
                    'label' => 'Purchase Price',
                ],
                [
                    'type' => 'select',
                    'name' => 'product_categories_id',
                    'label' => 'Product Categories',
                    'options' => ProductCategory::all(),
                ],
                [
                    'type' => 'textarea',
                    'name' => 'short_description',
                    'label' => 'Short Description',
                ],
                [
                    'type' => 'textarea',
                    'name' => 'description',
                    'label' => 'Description',
                ],
                [
                    'type' => 'check',
                    'name' => 'status',
                    'label' => 'Status',
                ],
                [
                    'type' => 'check',
                    'name' => 'new_product',
                    'label' => 'New Product',
                ],
                [
                    'type' => 'check',
                    'name' => 'best_seller',
                    'label' => 'Best Seller',
                ],
                [
                    'type' => 'check',
                    'name' => 'featured',
                    'label' => 'Featured',
                ],
            ],
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
            'code' => 'required|max:50',
            'product_categories_id' => 'required|integer|numeric',
            'price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'short_description' => 'nullable|max:250',
            'description' => 'nullable',
            'status' => 'required|max:1|between:0,1|integer|numeric',
            'new_product' => 'required|max:1|between:0,1|integer|numeric',
            'best_seller' => 'required|max:1|between:0,1|integer|numeric',
            'featured' => 'required|max:1|between:0,1|integer|numeric',
        ]);

        Product::where('id', $product->id)->update($validated);

        return redirect('/products/data');
    }

    public function delete(Request $request, Product $product)
    {
        Product::destroy($product->id);

        return redirect('/products/data');
    }
}
