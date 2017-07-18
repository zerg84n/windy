<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOrdersRequest;
use App\Http\Requests\Admin\UpdateOrdersRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class OrdersController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Order.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('order_access')) {
            return abort(401);
        }

        $orders = Order::all();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating new Order.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('order_create')) {
            return abort(401);
        }        $enum_status = Order::$enum_status;
            
        return view('admin.orders.create', compact('enum_status'));
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param  \App\Http\Requests\StoreOrdersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrdersRequest $request)
    {
        if (! Gate::allows('order_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $order = Order::create($request->all());



        return redirect()->route('admin.orders.index');
    }


    /**
     * Show the form for editing Order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('order_edit')) {
            return abort(401);
        }        $enum_status = Order::$enum_status;
            
        $order = Order::findOrFail($id);

        return view('admin.orders.edit', compact('order', 'enum_status'));
    }

    /**
     * Update Order in storage.
     *
     * @param  \App\Http\Requests\UpdateOrdersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrdersRequest $request, $id)
    {
        if (! Gate::allows('order_edit')) {
            return abort(401);
        }
    
        $request = $this->saveFiles($request);
        $order = Order::findOrFail($id);
        $order->update($request->all());



        return redirect()->route('admin.orders.index');
    }


    /**
     * Display Order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('order_view')) {
            return abort(401);
        }
        $order = Order::findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }


    /**
     * Remove Order from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('order_delete')) {
            return abort(401);
        }
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index');
    }

    /**
     * Delete all selected Order at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('order_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Order::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
