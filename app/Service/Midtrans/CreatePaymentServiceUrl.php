<?php

namespace App\Service\Midtrans;

use App\Models\Sku;
use Filament\Notifications\Collection;
use Midtrans\Snap;

class CreatePaymentServiceUrl extends Midtrans
{
    //protected order
    protected $order;

    public function __construct()
    {
        parent::__construct();
    }

    //getPaymentUrl
    public function getPaymentUrl($order)
    {
        //item details
        $itemDetails = new Collection();

        foreach ($order['items'] as $item) {
            $sku = Sku::find($item['sku_id']);
            $itemDetails->push([
                'id' => $sku->id,
                'price' => $sku->price,
                'quantity' => $item['qty'],
                'name' => $sku->name
            ]);
        }

        $params = [
            'transaction_details' => [
                'order_id' => $order['id'],
                'gross_amount' => $order['total'],
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $order['customer_name'],
                'email' => $order['customer_email'],
                'phone' => $order['customer_phone'],
            ],

        ];

        return [
            'payment_url' => Snap::createTransaction($params)->redirect_url
        ];
    }
}
