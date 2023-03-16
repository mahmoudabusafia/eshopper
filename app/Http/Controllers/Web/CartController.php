<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;


class CartController extends Controller
{
    /**
     * @var CartRepository
     */
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $cart =  $this->cart->all();

        return view('web.cart', [
            'cart' => $cart,
            'total' => $this->cart->total(),
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['int', 'min:1', function($attr, $value, $fail){
                $id = request()->input('product_id');
                $product = Product::find($id);
                if($value > $product->quantity){
                    $fail(__('Quantity greater than quantity in stoke.'));
                }
            }]
        ]);



        $cart = $this->cart->add($request->post('product_id'), $request->post('quantity', 1));

        if ($request->expectsJson()) {
            return $this->cart->all();
        }

        return redirect()->back()->with('success', __('Item added to cart!'));
    }

    public function destroy($id)
    {
        Cart::findOrfail($id)->delete();
        return redirect()->back()->with('success', __('Item deleted from cart!'));
    }
}
