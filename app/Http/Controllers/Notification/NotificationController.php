<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\BuyBillProduct;
use App\Notifications\ExpiredDateNotification;
use Carbon\Carbon;
use App\User;
use App\Models\BookIn;
use Notification;
use StreamLab\StreamLabProvider\Facades\StreamLabFacades;


class NotificationController extends Controller
{

   public function amount()    // user's id
   {

//      $user = auth()->user();
//   	$users = User::where('branch_id', $user->branch_id)->get();
//
//
//
////   	$books = BookIn::where('branch_id', $user->branch_id)->where('amount', '<', '10')->where('is_active', '!=', '0')->where('is_amount_notify',0)->get();
//
//   	 foreach ($books as $book) {
//   	 	Notification::send($users, new \App\Notifications\AmountNotification($book));
//         $book->update(['is_amount_notify' => 1]);

//   	 }

   }

//   public function check()
//   {
//       $user = auth()->user();
//
//       $users = User::where('branch_id', $user->branch_id)->get();
//
//
//       $books = BuyBillProduct::join('books_in', 'books_in.buy_bill_product_id', '=', 'buy_bill_products.id')
//           ->where('branch_id', $user->branch_id)
//           ->where('buy_bill_products.expired_date', '<=',  Carbon::today()->addDays(10))
//           ->where('books_in.is_active', '!=', '0')
//           ->where('books_in.is_expired_notify',0)
//           ->get();
//       if($books)
//       return true;
//   }

   public function expiredDate()    // user's id
   {

   	 $user = auth()->user();

   	 $users = User::where('branch_id', $user->branch_id)->get();

     $books = BuyBillProduct::join('books_in', 'books_in.buy_bill_product_id', '=', 'buy_bill_products.id')
       ->where('branch_id', $user->branch_id)
       ->where('buy_bill_products.expired_date', '<=',  Carbon::today()->addDays(10))
       ->where('books_in.is_active', '!=', '0')
       ->where('books_in.is_expired_notify',0)
       ->get();

   	 foreach ($books as $book) {

   	 	Notification::send($users, new ExpiredDateNotification($book));
   	 	BookIn::find($book->id)->update(['is_expired_notify' => 1]);

              }
   }

    public function spoliation($nameProduct, $id)
    {
        $batch = BookIn::find($id);

        ExpiredProduct::create([
            'batch_id' => $batch->id,
            'product_name' => $nameProduct,
            'amount' => $batch->despoiled_amount,
            'expired_date' => $batch->buyBillProduct->expired_date,
        ]);

        $batch->update(['amount' => 0]);
    }



    public  function showExpiredNote($id)
    {
        $book = BookIn::find($id);
//        $book->join('buy_bill_products', 'books_in.buy_bill_product_id', '=', 'buy_bill_products.id')
//            ->join('')
        return view('notification.expiredNotification', compact('book'));
    }

}
