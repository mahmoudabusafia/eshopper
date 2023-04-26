<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
//     * @return \Illuminate\Http\Response

    public function index(Request $request)
    {
        $data = Order::all();
        if ($request->ajax()){
            return  Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('number', function ($row) {
                    return $row->number;
                })
                ->addColumn('total', function ($row) {
                    return ($row->total + $row->shipping + $row->tax) - $row->discount;
                })
                ->addColumn('status', function ($row) {
                    $btn = '
                            <select class="status-switch" name="status" data-id="'.$row->id.'">
                              <option value="pending" '. ($row->status == 'pending' ? "selected" : ""). '>Pending</option>
                              <option value="completed" '. ($row->status == 'completed' ? "selected" : ""). '>Completed</option>
                              <option value="cancelled" '. ($row->status == 'cancelled' ? "selected" : ""). '>Cancelled</option>
                            </select>
                    ';
//                    return $row->status;
                    return $btn;
                })
                ->addColumn('payment_status', function ($row) {
                    return $row->payment_status;
                })
                ->addColumn('billing_name', function ($row) {
                    return $row->billing_name;
                })
                ->addColumn('billing_email', function ($row) {
                    return $row->billing_email;
                })
                ->addColumn('notes', function ($row) {
                    return $row->notes ?? 'empty';
                })
                ->addColumn('actions', function ($row) {
                    $btn = '
                        <div style="display: flex; justify-content: space-evenly">
                            <a href="'. Route('orders.edit', $row->id) .'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details"><span class="svg-icon svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "></path><rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"></rect></g></svg></span></a>
                            <a href="'. Route('orders.show', $row->id) .'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details"><span class="svg-icon svg-icon-md svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/><path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"></rect></g></svg></span></a>
                            <form action="'. Route('orders.destroy', $row->id) .'" method="post" style="display: inline">
                                <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <input name="_method" value="DELETE" type="hidden">
                                <button type="submit" class="btn btn-sm btn-clean btn-icon" title="Delete"><span class="svg-icon svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path><path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path></g></svg></span></button>
                             </form>
                        </div>
                            ';
                    return $btn;
                })
                ->rawColumns(['number', 'shipping', 'discount', 'tax', 'total', 'status', 'status_s', 'payment_status',
                    'billing_name', 'billing_email', 'billing_phone', 'billing_address', 'shipping_name',
                    'shipping_email', 'shipping_phone', 'shipping_address', 'notes','actions'])
                ->filter(function ($query) use ($request) {
                    if ($request->has('name') && $request->get('name') != null) {
                        $query->where('name->ar', 'like', "%{$request->get('name')}%")
                            ->orWhere('name->en', 'like', "%{$request->get('name')}%");
                    }
                    if ($request->has('status') && $request->get('status') != null) {
                        dd($query);
                        $query->where('status',$request->get('status'));
                    }

                })
                ->toJson();;
        }

        return view('admin.orders.index');
    }*/
    public function index(Request $request)
    {
        $data = Order::select('*');;
        if ($request->ajax()){
            return  Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('number', function ($row) {
                    return $row->number;
                })
                ->addColumn('total', function ($row) {
                    return ($row->total + $row->shipping + $row->tax) - $row->discount;
                })
                ->addColumn('status', function ($row) {
                    $btn = '
                            <select class="status-switch" name="status" data-id="'.$row->id.'">
                              <option value="pending" '. ($row->status == 'pending' ? "selected" : ""). '>Pending</option>
                              <option value="completed" '. ($row->status == 'completed' ? "selected" : ""). '>Completed</option>
                              <option value="cancelled" '. ($row->status == 'cancelled' ? "selected" : ""). '>Cancelled</option>
                            </select>
                    ';
//                    return $row->status;
                    return $btn;
                })
                ->addColumn('payment_status', function ($row) {
                    return $row->payment_status;
                })
                ->addColumn('billing_name', function ($row) {
                    return $row->billing_name;
                })
                ->addColumn('billing_email', function ($row) {
                    return $row->billing_email;
                })
                ->addColumn('notes', function ($row) {
                    return $row->notes ?? 'empty';
                })
                ->addColumn('actions', function ($row) {
                    $btn = '
                        <div style="display: flex; justify-content: space-evenly">
                            <a href="'. Route('orders.edit', $row->id) .'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details"><span class="svg-icon svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "></path><rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"></rect></g></svg></span></a>
                            <a href="'. Route('orders.show', $row->id) .'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details"><span class="svg-icon svg-icon-md svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/><path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"></rect></g></svg></span></a>
                            <form action="'. Route('orders.destroy', $row->id) .'" method="post" style="display: inline">
                                <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <input name="_method" value="DELETE" type="hidden">
                                <button type="submit" class="btn btn-sm btn-clean btn-icon" title="Delete"><span class="svg-icon svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path><path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path></g></svg></span></button>
                             </form>
                        </div>
                            ';
                    return $btn;
                })
                ->rawColumns(['number', 'shipping', 'discount', 'tax', 'total', 'status', 'payment_status',
                    'billing_name', 'billing_email', 'billing_phone', 'billing_address', 'shipping_name',
                    'shipping_email', 'shipping_phone', 'shipping_address', 'notes','actions'])
                ->filter(function ($query) use ($request) {
                    if ($request->has('billing_name') && $request->get('billing_name') != null) {
                        $query->where('billing_name', 'like', "%{$request->get('billing_name')}%");
                    }
                    if ($request->has('billing_email') && $request->get('billing_email') != null) {
                        $query->where('billing_email', 'like', "%{$request->get('billing_email')}%");
                    }
                    if ($request->has('number') && $request->get('number') != null) {
                        $query->where('number', 'like', "%{$request->get('number')}%");
                    }
                    if ($request->has('status') && $request->get('status') != null) {
                        $query->where('status',$request->get('status'));
                    }
                    if ($request->has('payment_status') && $request->get('payment_status') != null) {
                        $query->where('payment_status',$request->get('payment_status'));
                    }

                })
                ->toJson();;
        }

        return view('admin.orders.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrfail($id);
        return view('admin.orders.edit', [
            'order' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status_update(Request $request)
    {
        $order = Order::findOrfail($request->orderId);
        $order->update([
            'status' => $request->orderStatus,
        ]);
    }
}
