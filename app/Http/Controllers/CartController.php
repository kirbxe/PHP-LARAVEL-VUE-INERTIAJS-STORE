<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Cart $cart)
    {
        $userId = Auth::id();
        $cartItems = $cart::with('product.brand')
            ->where('user_id', $userId)
            ->orderBy('quantity', 'desc')
            ->get();
        $totalSum = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return Inertia::render('Cart', [
            'items' => $cartItems,
            'totalSum' => $totalSum
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store($productId)
    {
        try {
            $userId = Auth::id();
            $cartItem = Cart::where('product_id', $productId)
                ->where('user_id', $userId)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity');
                return redirect()->back()->with('success', 'Добавили еще один пункт этого товара!');
            }

            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1
            ]);
            return redirect()->back()->with('success', 'Товар успешно добавлен в корзину!');
        } catch (\Exception $ex) {

            return redirect()->back()->with('error', "Произошла ошибка: $ex");
        }
    }


    public function deleteCartItem($itemId)
    {


        try {
            $currentItem = Cart::find($itemId);
            if ($currentItem) {

                $currentItem->delete();
                return redirect()->back()->with('success', 'Товар успешно удален!');
            }

            return redirect()->back()->with('error', 'Удалить не найден!!');
        } catch (\Exception $ex) {

            return redirect()->back()->with('error', "Произошла ошибка: $ex");
        }
    }
    public function updateQuantity($itemId, $action)
    {
        try {
            $cartItem = Cart::findOrFail($itemId);
            if ($cartItem) {
                if ($cartItem->user_id == Auth::id()) {

                    if ($action == 'increment') {

                        $cartItem->quantity += 1;

                    } else if ($action == 'decrement') {

                        if ($cartItem->quantity > 1) {

                            $cartItem->quantity -= 1;

                        } else {
                            $cartItem->delete();
                            return redirect()->back()->with('success', 'Товар удален из корзины!');
                        }
                    }
                    $cartItem->save();
                    return redirect()->back()->with('success', 'Кол-во успешно обновлено!');
                } else {
                    abort(403, 'Нету доступа');
                }
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', "Произошла ошибка: $ex");
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
