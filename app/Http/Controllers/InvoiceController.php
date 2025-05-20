<?php

namespace App\Http\Controllers;
// app/Http/Controllers/InvoiceController.php
use Illuminate\Http\Request;
use App\Models\Product;

class InvoiceController extends Controller
{
    public function generate(Request $request)
    {
        if ($request->type == 'invoice') {
            
        }
        $data = [
            'name' => $request->input('name'),
            'adress' => $request->input('adress'),
            'invoiceid' => $request->input('invoiceid'),
            'invoicedate' => $request->input('invoicedate'),
            'total' => $request->input('total'),
            'table_html' => $request->input('table_html'),
            'col_width' => $request->col_width,
            'type' => $request->type,


        ];

        // Return the rendered Blade view as HTML string (not PDF yet)
        return view('invoice', $data)->render();
    }



    // public function generatePDF(Request $request)
    // {


    //     $htmlTable = $request->input(key: 'table_html');




    //     $pdf =  \Pdf::loadView('invoice', [
    //         'name' => 'Test Hotel',
    //         'adress' => 'Hurghada, Egypt',
    //         'invoiceid' => 'TEST123',
    //         'invoicedate' => now()->toDateString(),
    //         'data' => $htmlTable,
    //         'total' => '100.00',
    //     ])->setOptions([
    //         'defaultFont' => 'Cairo',
    //         'isHtml5ParserEnabled' => true,
    //         'isUnicode' => true,
    //         'isRemoteEnabled' => true,
    //     ]);

    //     return $pdf->stream(); // or ->download('test.pdf');
    // }
}
