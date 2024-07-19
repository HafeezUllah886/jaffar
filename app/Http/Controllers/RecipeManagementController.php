<?php

namespace App\Http\Controllers;

use App\Models\material;
use App\Models\products;
use App\Models\recipe_management;
use Illuminate\Http\Request;

class RecipeManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
       
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
        $check = recipe_management::where('productID', $request->productID)->where('materialID', $request->materialID)->count();
        if($check > 0)
        {
            return back()->with('error', "Already Exists");
        }
        else
        {
            recipe_management::create($request->only(['productID', 'materialID']));
            return back()->with('success', "Material Added");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = products::with('ingredient')->find($id);
        $materials = material::all();
       /*  dd($product); */
        return view('products.ingredients.index', compact('materials', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(recipe_management $recipe_management)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, recipe_management $recipe_management)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productID, $id)
    {
        recipe_management::find($id)->delete();
        session()->forget('confirmed_password');
        return redirect()->route('ingredient.show', $productID)->with('success', 'Deleted Successfully');
    }
}
