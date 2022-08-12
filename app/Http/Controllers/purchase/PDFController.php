<?php

namespace App\Http\Controllers\purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use DB;
use App\BuyBill;
use App\BuyBillProduct;

class PDFController extends Controller
{
  public function get_wareh($title,$title2,$date)
  {


     {

       //$newDate =\Carbon\Carbon::createFromFormat($request->date, $date)->format('F');
       $mo=\Carbon\Carbon::parse($date)->format('m');
       $da=\Carbon\Carbon::parse($date)->format('d');
       $ye=\Carbon\Carbon::parse($date)->format('Y');
         //dd($ye);

       if($title == 'Daily_Reports')
          { if($title2== 'Paid_Order')
       {

        $buybill = DB::table('buy_bills')->whereYear('recieve_date', $ye)
            ->whereMonth('recieve_date', $mo)->whereDay('recieve_date', $da)
              ->whereColumn('total_price', 'total_payment')
            ->get();

          return $buybill;}

         else if($title2== 'Non_Paid_Order')
        {
          $buybill = DB::table('buy_bills')->whereYear('recieve_date', $ye)
              ->whereMonth('recieve_date', $mo)->whereDay('recieve_date', $da)
              ->whereColumn('total_price','!=' ,'total_payment')
              ->get();


            return $buybill;}

            else if($title2== 'removed_invoice')
            {/*->whereYear('expaire_date', $ye)
                ->whereMonth('expaire_date', $mo)->whereDay('expaire_date', $da)*/
              $buybillproduct = DB::table('buy_bill_products')
                  ->where('reverse','>' ,0)
                  ->get();


                  return $buybillproduct;}

        }
        else if($title == 'Monthly_Reports')
        {
          if($title2== 'Paid_Order')
       {

        $buybill = DB::table('buy_bills')->whereYear('recieve_date', $ye)
            ->whereMonth('recieve_date', $mo)
              ->whereColumn('total_price', 'total_payment')
            ->get();

          return $buybill;}

         else if($title2== 'Non_Paid_Order')
        {
          $buybill = DB::table('buy_bills')->whereYear('recieve_date', $ye)
              ->whereMonth('recieve_date', $mo)
              ->whereColumn('total_price','!=' ,'total_payment')
              ->get();


            return $buybill;}

            else if($title2== 'removed_invoice')
            {/*->whereYear('expaire_date', $ye)
                ->whereMonth('expaire_date', $mo)->whereDay('expaire_date', $da)*/
              $buybillproduct = DB::table('buy_bill_products')
                  ->where('reverse','>' ,0)
                  ->get();


                  return $buybillproduct ;}


        }
        else if($title == 'Annuual_Reports')
        {
          if($title2== 'Paid_Order')
       {

        $buybill = DB::table('buy_bills')->whereYear('recieve_date', $ye)
        ->whereColumn('total_price', 'total_payment')
            ->get();

          return $buybill;}

         else if($title2== 'Non_Paid_Order')
        {
          $buybill = DB::table('buy_bills')->whereYear('recieve_date', $ye)
              ->whereColumn('total_price','!=' ,'total_payment')
              ->get();


            return $buybill;}

            else if($title2== 'removed_invoice')
            {/*->whereYear('expaire_date', $ye)
                ->whereMonth('expaire_date', $mo)->whereDay('expaire_date', $da)*/
              $buybillproduct = DB::table('buy_bill_products')
                  ->where('reverse' ,'>',0)
                  ->get();


                  return $buybillproduct ; }

  }

}}
/*****************************************************************************/
  /* public function downloadPdf($title,$title2,$date)
  {
       $pdf=\App::make('dompdf.wrapper');
       $pdf->loadHTML($this->convert_to_html($title,$title2,$date));
       return $pdf->stream();

  }*/
//$this->downloadPdf($myModel)->validate();
  /***************************************************************************/


      public function downloadPdf(BuyBill $buybill)
    {    foreach ($buybill as $key ) {
            echo  $buybill->buy_order_id;
    }




         //$pdf=\App::make('dompdf.wrapper');

        // $pdf->loadHTML($this->convert_to_html($buybill));

        // return $pdf->stream();

    }
/*****************************************************************************/

public function convert_to_html( $buybill  )
{

  $output = '
 <h3 align="center">reports  Data</h3>
 <table width="100%" style="border-collapse: collapse; border: 0px;">
  <tr>
 <th style="border: 1px solid; padding:12px;" width="20%">id</th>
 <th style="border: 1px solid; padding:12px;" width="30%">buy_product_id</th>
 <th style="border: 1px solid; padding:12px;" width="15%">buy_bill_id</th>
 <th style="border: 1px solid; padding:12px;" width="15%">individual_price</th>
 <th style="border: 1px solid; padding:12px;" width="20%">Quantity</th>
 <th style="border: 1px solid; padding:12px;" width="20%">Reverce Quantity</th>
</tr>
 ';
 foreach($buybill as $report)
 {
  $output .= '
  <tr>
   <td style="border: 1px solid; padding:12px;">'.$report->id.'</td>
   <td style="border: 1px solid; padding:12px;">'.$report->buy_product_id .'</td>
   <td style="border: 1px solid; padding:12px;">'.$report->buy_bill_id.'</td>
   <td style="border: 1px solid; padding:12px;">'.$report->individual_price.'</td>
   <td style="border: 1px solid; padding:12px;">'.$report->Quantity.'</td>
    <td style="border: 1px solid; padding:12px;">'.$report->reverse.'</td>

  </tr>
  ';
 }
 $output .= '</table>';
   return $output;

 }
/*
 public function convert_to_html($title,$title2,$date)
  {  $reports=$this->get_wareh($title,$title2,$date);
    if($title2='Non_Paid_Order')
    {
      $output = '
     <h3 align="center">reports  Data</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
     <th style="border: 1px solid; padding:12px;" width="20%">id</th>
     <th style="border: 1px solid; padding:12px;" width="30%">buy_order_id</th>
     <th style="border: 1px solid; padding:12px;" width="15%">recieve_date</th>
     <th style="border: 1px solid; padding:12px;" width="15%">total_price</th>
     <th style="border: 1px solid; padding:12px;" width="20%">total_payment</th>

     </tr>
     ';

     foreach($reports as $report)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$report->id.'</td>
       <td style="border: 1px solid; padding:12px;">'.$report->buy_order_id .'</td>
       <td style="border: 1px solid; padding:12px;">'.$report->recieve_date.'</td>
       <td style="border: 1px solid; padding:12px;">'.$report->total_price.'</td>
       <td style="border: 1px solid; padding:12px;">'.$report->total_payment.'</td>


      </tr>
      ';
     }
     $output .= '</table>';


    }
    /*if($title2='removed_invoice')
    {$output = '
   <h3 align="center">reports  Data</h3>
   <table width="100%" style="border-collapse: collapse; border: 0px;">
    <tr>
   <th style="border: 1px solid; padding:12px;" width="20%">id</th>
   <th style="border: 1px solid; padding:12px;" width="30%">buy_product_id</th>
   <th style="border: 1px solid; padding:12px;" width="15%">buy_bill_id</th>
   <th style="border: 1px solid; padding:12px;" width="15%">individual_price</th>
   <th style="border: 1px solid; padding:12px;" width="20%">Quantity</th>
   <th style="border: 1px solid; padding:12px;" width="20%">Reverce Quantity</th>
  </tr>
   ';
   foreach($reports as $report)
   {
    $output .= '
    <tr>
     <td style="border: 1px solid; padding:12px;">'.$report->id.'</td>
     <td style="border: 1px solid; padding:12px;">'.$report->buy_product_id .'</td>
     <td style="border: 1px solid; padding:12px;">'.$report->buy_bill_id.'</td>
     <td style="border: 1px solid; padding:12px;">'.$report->individual_price.'</td>
     <td style="border: 1px solid; padding:12px;">'.$report->Quantity.'</td>
      <td style="border: 1px solid; padding:12px;">'.$report->reverse.'</td>

    </tr>
    ';
   }
   $output .= '</table>';}*/

/*   return $output;

 }

/*************************************************************************************/

}
