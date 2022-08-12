<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\BookIn;
use App\Models\CosmeticProduct;
use App\Models\MedicalFood;
use App\Models\MedicalSupply;
use App\Models\Medicine;
use App\Traits\ProductTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use ProductTrait;


    /* --------------------------------------------------------------------------
                             تقارير البضائع والمنتجات.
     --------------------------------------------------------------------------*/

    /* تقرير اجمالي بكميات المنتجات في فرع معين.*/
    ######################################################
    public function medicineAmount()
    {
        $user = auth()->user();
        $medicines = $this->getProductInPharmacy(new Medicine())
            ->where('books_in.branch_id', $user->branch_id)
            ->select('medicines.id',
                'generic_name', 'amount')->get()->groupBy('id');

        return view('reports.medicineAmount', compact('medicines'));
    }
    public function medicalSupplyAmount()
    {
        $user = auth()->user();
        $medicalSupplies = $this->getProductInPharmacy(new MedicalSupply())
            ->where('books_in.branch_id', $user->branch_id)
            ->select('medical_supplies.id',
                'name', 'amount')->get()->groupBy('id');

        return view('reports.medicalSupplyAmount', compact('medicalSupplies'));
    }
    public function medicalFoodAmount()
    {
        $user = auth()->user();
        $medicalFoods = $this->getProductInPharmacy(new MedicalFood())
            ->where('books_in.branch_id', $user->branch_id)
            ->select('medical_foods.id',
                'name', 'amount')->get()->groupBy('id');
        return view('reports.medicalFoodAmount', compact('medicalFoods'));
    }
    public function cosmeticProductAmount()
    {
        $user = auth()->user();
        $cosmeticProducts = $this->getProductInPharmacy(new CosmeticProduct())
            ->where('books_in.branch_id', $user->branch_id)
            ->select('cosmetic_products.id',
                'name', 'amount')->get()->groupBy('id');
        return view('reports.cosmeticProductAmount', compact('cosmeticProducts'));
    }
    ######################################################





    /* تقرير إجمالي بالمنتجات المنتهية الصلاحية.*/
    ######################################################
    public function medicineExpired()
    {
        $user = auth()->user();

        $medicines = $this->getProductInPharmacy(new Medicine())
            ->where('buy_bill_products.expired_date', '<', Carbon::today())
            ->where('books_in.branch_id', $user->branch_id)
            ->where('books_in.amount', '!=', '0')
            ->select('books_in.id', 'generic_name', 'amount', 'expired_date', 'name_warehouse')
            ->get();

        return view('reports.expiredMedicine', compact('medicines'));
    }
    public function medicalFoodExpired()
    {
        $user = auth()->user();

        $medicalFoods = $this->getProductInPharmacy(new MedicalFood())
            ->where('buy_bill_products.expired_date', '<', Carbon::today())
            ->where('books_in.branch_id', $user->branch_id)
            ->where('books_in.amount', '!=', '0')
            ->select('books_in.id', 'name', 'amount', 'expired_date', 'name_warehouse')
            ->get();
        return view('reports.expiredMedicalFood', compact('medicalFoods'));
    }
    public function cosmeticProductExpired()
    {
        $user = auth()->user();

        $cosmeticProducts = $this->getProductInPharmacy(new CosmeticProduct())
            ->where('buy_bill_products.expired_date', '<', Carbon::today())
            ->where('books_in.branch_id', $user->branch_id)
            ->where('books_in.amount', '!=', '0')
            ->select('books_in.id', 'name', 'amount', 'expired_date', 'name_warehouse')
            ->get();
        return view('reports.expiredCosmeticProduct', compact('cosmeticProducts'));
    }
    ######################################################3





    /* تقرير اجمالي بالمنتجات التي قاربت على النفاذ.*/
    ######################################################
    public function medicineOutOfStock()
    {
        $user = auth()->user();
        $medicines = $this->getProductInPharmacy(new Medicine())
        ->where('books_in.branch_id', $user->branch_id)
        ->where('books_in.amount', '!=', '0')
        ->select('medicines.id', 'generic_name', 'amount')
        ->get()->groupBy('id');

        $medicines = collect($medicines);
        $results =  $medicines -> filter(function ($value, $key){
            return $value -> sum('amount') < '10';

        });
            return view('reports.medicineOutOfStock', compact('results'));
        }
    public function medicalSupplyOutOfStock()
    {
        $user = auth()->user();
        $medicalSupply = $this->getProductInPharmacy(new MedicalSupply())
            ->where('books_in.branch_id', $user->branch_id)
            ->where('books_in.amount', '!=', '0')
            ->select('medical_supplies.id', 'name', 'amount')
            ->get()->groupBy('id');

        $medicalSupply = collect($medicalSupply);
        $results =  $medicalSupply -> filter(function ($value, $key){
            return $value -> sum('amount') < '10';
        });
        return view('reports.medicalSupplyOutOfStock', compact('results'));
    }
    public function medicalFoodOutOfStock()
    {
        $user = auth()->user();
        $medicalFoods = $this->getProductInPharmacy(new MedicalFood())
            ->where('books_in.branch_id', $user->branch_id)
            ->where('books_in.amount', '!=', '0')
            ->select('medical_foods.id', 'name', 'amount')
            ->get()->groupBy('id');

        $medicalFoods = collect($medicalFoods);
        $results =  $medicalFoods -> filter(function ($value, $key){
            return $value -> sum('amount') < '10';
        });
        return view('reports.medicalFoodOutOfStock', compact('results'));
    }
    public function cosmeticProductOutOfStock()
    {
        $user = auth()->user();
        $cosmeticProducts = $this->getProductInPharmacy(new CosmeticProduct())
            ->where('books_in.branch_id', $user->branch_id)
            ->where('books_in.amount', '!=', '0')
            ->select('cosmetic_products.id', 'name', 'amount')
            ->get()->groupBy('id');

        $cosmeticProducts = collect($cosmeticProducts);
        $results =  $cosmeticProducts -> filter(function ($value, $key){
            return $value -> sum('amount') < '10';

        });
        return view('reports.cosmeticProductOutOfStock', compact('results'));
    }
    ######################################################


    /* تقرير تفصيلي بمنتج ما وتوافره حسب فروع الصيدلية.*/
    ######################################################
    public function aboutProduct($product_id)
    {


    }
    ######################################################
}

















