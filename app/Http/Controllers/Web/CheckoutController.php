<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var \App\Repositories\Cart\CartRepository;
     */
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('web.checkout');
    }

    public function create()
    {
        return view('web.checkout', [
            'cart' => $this->cart,
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'billing_name' => ['required', 'string'],
            'billing_phone' => 'required',
            'billing_email' => 'required|email',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_country' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $request->merge([
                'total' => $this->cart->total(),
            ]);
            $order = Order::create($request->all());

            $items = [];
            foreach ($this->cart->all() as $item) {
                $items[] = [
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ];
            }

            DB::table('order_items')->insert($items);

            DB::commit();

            return redirect()->route('orders')->with('success', __('Order created'));

        }catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
