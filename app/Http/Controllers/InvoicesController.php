<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use Illuminate\Support\Facades\App;

class InvoicesController extends Controller
{
    public function createInvoice(Request $request){
        App::setlocale('fr');
        $order = Order::Find($request->order_id);
        $order_products = $order->products;
        $user = User::Find($order->user_id);

        $client = new Party([
            'name' => 'CraftedBy',
            'phone' => '666',
        ]);

        $customer = new Party([
                'name' => $user->firstname . ' ' . $user->lastname,
                // 'custom_fields' => [
                // ],
                'phone' => $user->phone_number,
        ]);

        foreach($order_products as $product) {
            $items[] = (new InvoiceItem())
                ->title($product->name)
                ->description($product->description)
                ->pricePerUnit($product->unit_price)
                ->quantity(1);
        }
        $invoice = Invoice::make('receipt')
            ->seller($client)
            ->buyer($customer)
            ->date(now())
            ->dateFormat('d/m/Y')
            ->currencySymbol('€')
            ->currencyCode('EUR')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . $customer->name)
            ->addItems($items)
            ->logo(public_path(('/img/CraftedByLogo.png')));

        $link = $invoice->url();

        return $invoice->stream();
    }
}
