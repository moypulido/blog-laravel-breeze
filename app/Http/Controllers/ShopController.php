<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Badge;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('shop.index', compact('products'));
    }

    public function buy(Request $request, Product $product)
    {
        $user = Auth::user();

        $totalPrice = $product->price_hearts;


        if ($user->hearts < $totalPrice) {
            return redirect()->back()->with('error', 'No tienes suficientes hearts para comprar este producto.');
        }

        DB::transaction(function () use ($user, $product, $totalPrice) {
            $user->hearts -= $totalPrice;

            if ($product->name === 'Comentarios') {
                $user->available_comments += 1;
            } elseif ($product->badge_id) {
                $user->badges()->syncWithoutDetaching([$product->badge_id]);
            }
            $user->save();

            Purchase::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'price_hearts' => $totalPrice,
                'quantity' => 1,
            ]);
        });

        return redirect()->back()->with('success', 'Compra realizada con éxito!');
    }
}
