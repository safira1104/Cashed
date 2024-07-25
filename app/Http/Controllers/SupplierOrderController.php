<?php

namespace App\Http\Controllers;

use App\Models\SupplierOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SupplierOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SupplierOrder::query();

        if ($search = $request->input('search')) {
            $query->where('transaction_code', 'like', "%{$search}%")
                  ->orWhere('product_name', 'like', "%{$search}%");
        }

        $supplierOrders = $query->get();

        return view('supplierorder.index', compact('supplierOrders'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all(); // Ambil semua data supplier
        return view('supplierorder.create', compact('suppliers'));
    }


    /**
     * Store a newly created resource in storage.
     */


     public function store(Request $request)
{
    $validated = $request->validate([
        'transaction_code' => 'required|string',
        'product_name' => 'required|string',
        'entry_date' => 'required|date',
        'stock_in' => 'required|integer',
        'supplier_id' => 'required|exists:suppliers,id',
    ]);

    SupplierOrder::create($validated);

    return redirect()->route('supplier_orders.index')->with('success', 'Order berhasil ditambahkan!');
}



    /**
     * Display the specified resource.
     */
    public function show(SupplierOrder $supplierOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierOrder $supplierOrder)
    {
        $suppliers = Supplier::all(); // Ambil semua data supplier
        return view('supplierorder.edit', compact('supplierOrder', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierOrder $supplierOrder)
    {
        $validated = $request->validate([
            'transaction_code' => 'required|string|max:255|unique:supplier_orders,transaction_code,' . $supplierOrder->id,
            'product_name' => 'required|string|max:255',
            'entry_date' => 'required|date',
            'stock_in' => 'required|integer',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $supplierOrder->update($validated);

        return redirect()->route('supplier_orders.index')->with('success', 'Order updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierOrder $supplierOrder)
    {
        $supplierOrder->delete();

        return redirect()->route('supplier_orders.index')->with('success', 'Order deleted successfully.');
    }
}
