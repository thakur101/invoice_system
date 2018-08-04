<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Counter;
use DB;

class InvoiceController extends Controller
{
    
	public function index(){
		$results = Invoice::with(['customer'])
		->orderBy('created_at','desc')
		->paginate(15);

		return response()
			->json(['results' => $results]);
	}

	public function create()
	{

		$counter = Counter::where('key','invoice')->first();

		$form = [
			'number' => $counter->prefix.$counter->value,
			'customer_id' => null,
			'customer' =>null,
			'date' => date('Y-m-d'),
			'due_date' => null,
			'reference' => null,
			'discount' => 0,
			'terms_and_conditions' => 'Default Terms',
			'items' => [
				[
				'product_id' => null,
				'product' => null,
				'unit_price' => 0,
				'qty' => 1
			]
		]
		];

		return response()
		->json(['form' => $form]);
	}
}
