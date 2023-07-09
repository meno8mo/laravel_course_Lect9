<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Product_image;
use App\Notifications\invoice;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
//        $user=User::find(1);
//        $user->notify()
        auth()->user()->notify(
            new \App\Notifications\GeneralNotification([
                'content'=>"تم اضافة المنتج  " . $product->name . "بواسطة " . auth()->user()->name,
                'action_url'=>route('products.index'),
                'btn_text'=>"عرض المنتج",
                'methods'=>['database','mail'],
                'image'=>$product->image,

            ])
        );
        Product_image::create(
            [
                'image'=>$product->images,
                'product_id'=>$product->id,
            ]
        );
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
