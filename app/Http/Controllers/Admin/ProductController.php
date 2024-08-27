<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['products'] = Product::all();
        return view('admin.pages.product', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pname' => 'required|string|max:255',
            'keywords' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'ppqty' => 'required|integer',
            'amount' => 'required|numeric',
            'product_cat' => 'required|string',
            'product_types' => 'required|string',
            'pfile' => 'required|image|max:2048',
        ]);

        $fileName = null;
        if ($request->hasFile('pfile')) {
            $file = $request->file('pfile');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $fileName); // Store the file
            $validated['picture'] = $fileName;
        }

        Product::create([
            'title' => $validated['pname'],
            'keywords' => $validated['keywords'],
            'description' => $validated['description'],
            'qty' => $validated['ppqty'],
            'price' => $validated['amount'],
            'cats' => $validated['product_cat'],
            'type' => $validated['product_types'],
            'picture' => $validated['picture'] ?? null,
        ]);

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::where('id', $id)->first();
        $product->title = $request?->name;
        $product->keywords = $request?->keywords;
        $product->description = $request?->description;
        $product->qty = $request?->pqty;
        $product->price = $request?->price;
        $product->cats = $request?->product_cats;
        $product->type = $request?->product_type;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $fileName);
            $product->picture = $fileName ?? null;
        }

        $product->save();
        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id', $id)->first();
        if(isset($product)){
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
        }else {
            return redirect()->route('product.index')->with('success', 'Something went wrong!');
        }
    }
}
