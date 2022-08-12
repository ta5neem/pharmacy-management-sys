<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicineRequest;
use App\Models\CosmeticProduct;
use App\Models\MedicalFood;
use App\Models\MedicalSupply;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Type;
use App\Models\AgeGroup;
use App\Models\Category;
use App\Models\EffectiveMaterial;

use App\Traits\ProductTrait;

class MedicineController extends Controller
{
    use ProductTrait;

    public function create()
    {
        //view form to creat the medicine.
        $types = Type::all();
        $ageGroups = AgeGroup::all();
        $categories = Category::all();
        $effectiveMaterials = EffectiveMaterial::all();

        return view('product.medicine.addMedicine', compact('types', 'ageGroups', 'categories', 'effectiveMaterials'));
    }

    public function store(MedicineRequest $request)
    {
         //save photo in folder.
            $file_name = $this -> saveImage($request -> image , 'images/products');

            //save medicine into database.

             $product = Product::create([
                'image'=> $file_name,
                'par_code'=> $request->par_code,
                'product_country'=> $request->product_country,
                'manufacturer_company'=>$request->manufacturer_company,
                 'is_active'=>$request->radio,
            ]);

            $medicine = Medicine::create([
                'generic_name'=> $request->generic_name,
                'medicine_name'=> $request->medicine_name,
                'alternative_medicine'=> $request->alternative_medicine,
                'privacy'=> $request->prescription,
                'caliber'=> $request->caliber,
                'composition'=> $request->composition,
                'indications'=> $request->indications,
                'product_id'=> $product->id,
                'type_id'=> $request->type_id,
                'age_group_id'=> $request->age_group_id,
                'category_id'=> $request->category_id,

            ]);

            $medicine -> effectiveMaterials() -> attach($request -> effective_material_ids);

           return redirect()->back()->with(['success'=>'تم الإضافة بنجاح']);
    }

    public function getAll()
    {
        $user = auth()->user();

        $medicines = $this -> getProductInPharmacy(new Medicine())
            ->join('types', 'medicines.type_id', '=', 'types.id')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->join('age_groups', 'medicines.age_group_id', '=', 'age_groups.id')
//            ->where('books_in.amount', '!=', '0')
            ->where('books_in.branch_id', $user->branch_id)
            ->select('medicines.id', 'generic_name', 'medicine_name', 'name_category', 'name_age_group', 'name_type',
            'caliber', 'composition', 'alternative_medicine', 'indications', 'product_country', 'manufacturer_company',
            'image', 'bar_code', 'privacy')->distinct()->get();

        return view('product.medicine.medicines_list', compact('medicines'));
    }

    public function getAllGrid()
    {
        $count = 0;
        $user = auth()->user();

        $medicines =  $this -> getProductInPharmacy(new Medicine())
            ->where('books_in.amount', '!=', '0')
            ->where('books_in.branch_id', $user->branch_id)
            ->select('books_in.id', 'generic_name',
            'image', 'selling_price', 'amount', 'expired_date')->get()->groupBy('generic_name');

         return view('product.medicine.medicine_grid', compact('medicines', 'count'));
    }

    public function showDetails($id)
    {
       // $user = auth()->user();
        $details = $this -> getProductInPharmacy(new Medicine())
            ->join('types', 'medicines.type_id', '=', 'types.id')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->join('age_groups', 'medicines.age_group_id', '=', 'age_groups.id')
            ->where('books_in.id', $id)
            ->select('medicines.id', 'generic_name', 'medicine_name', 'name_category',
                 'name_age_group', 'name_type', 'caliber', 'composition', 'alternative_medicine',
                 'indications', 'product_country', 'manufacturer_company', 'image', 'bar_code',
                 'privacy', 'name_warehouse', 'selling_price', 'purchasing_price', 'expired_date',
                 'production_date', 'amount', 'product_place_id', 'books_in.date')->get();

             return view('product..show_details', compact('details'));
    }

    public function showBatches($id)
    {
        $user = auth()->user();
        $batches = $this -> getProductInPharmacy(new Medicine())
            ->join('types', 'medicines.type_id', '=', 'types.id')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->join('age_groups', 'medicines.age_group_id', '=', 'age_groups.id')
            ->where('medicines.id', $id)
            ->where('books_in.branch_id', $user->branch_id)
            ->select('books_in.id', 'medicine_name', 'name_warehouse', 'selling_price', 'purchasing_price', 'expired_date',
            'production_date', 'amount', 'product_place_id', 'books_in.date')->get();

        return view('product.medicine.show_batches', compact('batches'));
    }

    public function edit($id)
    {
      //  $classifications = ProductClassification::all();
        $types = Type::all();
        $ageGroups = AgeGroup::all();
        $categories = Category::all();
        $effectiveMaterials = EffectiveMaterial::all();

        //search id medicine
        $medicine = Medicine::find($id);
        if(!$medicine)
            return redirect()->back() ;
        $medicine = Medicine::with('product', 'type', 'category', 'ageGroup')->find($id);
        return view('product.medicine.editMedicine', compact('medicine',  'types', 'ageGroups', 'categories', 'effectiveMaterials'));
    }

    public function update(Request $request, $id)
    {
        //check if medicine
        $medicine = Medicine::find($id);
        if(!$medicine)
            return redirect() -> back() ;
        $product = Product::find($medicine->product_id);
        //update data.
         $medicine->update($request->all());
         $product->update($request->all());
        return redirect()->back()->with(['success'=>'تم التعديل  بنجاح']);
    }

    public function delete($id)
    {
        //check if id medicine exist.
        $medicine = Medicine::find($id);
        if(!$medicine)
            return redirect()->back();

        //delete the medicine.
        $medicine -> delete();
        return redirect()->back()->with(['success'=>'تم الحذف بنجاح']);
    }

//    Branch::join('')


}



