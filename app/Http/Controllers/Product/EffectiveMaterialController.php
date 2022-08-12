<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\EffectiveMatrialRequest;
use App\Models\EffectiveMaterial;
use Illuminate\Http\Request;


class EffectiveMaterialController extends Controller
{
    public function create()
    {
        //view form to creat the effectiveMaterial.
        return view('product.effectiveMaterial.addEffectiveMaterial');
    }

    public function store(Request $request)
    {
        //save effectiveMaterial into database.
        EffectiveMaterial::create([
            'name'=> $request->name,
        ]);
        return redirect()->back();
    }

    public function getAll()
    {
        $effectiveMaterials= EffectiveMaterial::select('id', 'name')->get();
        return view('product.effectiveMaterial.showEffectiveMaterials', compact('effectiveMaterials'));
    }

    public function edit($id)
    {
        //search id type.
        $product = EffectiveMaterial::find($id);
        if(!$product)
            return redirect()->back() ;
        $effectiveMaterial = EffectiveMaterial::select('id', 'name')->find($id);
        return view('product.effectiveMaterial.editEffectiveMaterial', compact('effectiveMaterial'));
    }

    public function update(Request $request, $id)
    {
        //check if effectiveMaterial exist.
        $effectiveMaterial = EffectiveMaterial::find($id);
        if(!$effectiveMaterial)
            return redirect() -> back() ;

        //update data.
        $effectiveMaterial -> update($request->all());
        return redirect()->back();
    }

    public function delete($id)
    {
        //check if id effectiveMaterial exist.
        $effectiveMaterial = EffectiveMaterial::find($id);
        if(!$effectiveMaterial)
            return redirect()->back();

        //delete the effectiveMaterial.
        $effectiveMaterial -> delete();
        return redirect()->back();

    }

}
