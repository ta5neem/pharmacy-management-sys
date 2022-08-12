<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Models\BookIn;
use App\Models\Type;
use Illuminate\Http\Request;


class TypeController extends Controller
{
    public function create()
    {
        //view form to add the type.
        return view('product.type.addType');
    }

    public function store(TypeRequest $request)
    {
        //save type into database.
        Type::create([
            'name_type'=> $request->name_type,
        ]);
        return redirect()->back();
    }

    public function getAll()
    {
        $user = auth()->user();

        $types = BookIn::join('buy_bill_products', 'books_in.buy_bill_product_id', '=', 'buy_bill_products.id')
            ->join('buy_products', 'buy_bill_products.buy_product_id', '=', 'buy_products.id')
            ->join('products', 'buy_products.product_id', '=', 'products.id')
            ->join('medicines', 'products.id', '=', 'medicines.product_id')
            ->join('types', 'medicines.type_id', '=', 'types.id')
            ->where('books_in.branch_id', $user->branch_id)
            ->whereNull('types.deleted_at')
            ->select('types.id','name_type')->distinct()->get();

        return view('product.type.showTypes', compact('types'));
    }

    public function edit($id)
    {
        //search id type.
        $type = Type::find($id);
        if(!$type)
            return redirect()->back() ;
        $type = Type::select('id', 'name_type')->find($id);
        return view('type.editType', compact('type'));
    }

    public function update(TypeRequest $request, $id)
    {
        //check if Type exist.
        $type = Type::find($id);
        if(!$type)
            return redirect() -> back() ;

        //update data.
        $type -> update($request->all());
        return redirect()->back();
    }

    public function delete($id)
    {
        //check if id Type exist.
        $type = Type::find($id);
        if(!$type)
            return redirect()->back();

        //delete the type.
        $type -> delete();
        return redirect()->back();

    }



}
