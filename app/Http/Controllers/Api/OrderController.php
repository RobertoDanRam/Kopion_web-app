<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // 1. Listar todas las órdenes de la más nueva a la más vieja (GET /api/orders)
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return response()->json($orders, 200);
    }

    // 2. Crear una nueva orden (POST /api/orders)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'nullable|string|unique:orders,invoice_number',
            'user_id' => 'required|integer|exists:users,id',
            'employee_id' => 'nullable|integer|exists:users,id',
            'branch_id' => 'required|integer|exists:branches,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'in:Pending,Completed,Cancelled'
        ]);

        $order = Order::create($validated);
        return response()->json($order, 201);
    }

    // 3. Ver una orden específica (GET /api/orders/{id})
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order, 200);
    }

    // 4. Actualizar estado o información de una orden (PUT/PATCH /api/orders/{id})
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'total_amount' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:Pending,Completed,Cancelled',
            'invoice_number' => 'sometimes|string|unique:orders,invoice_number,' . $id,
        ]);

        $order->update($validated);
        return response()->json($order, 200);
    }

    // 5. Borrado lógico de una orden (DELETE /api/orders/{id})
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        
        // Al usar el trait SoftDeletes, delete() no la borra físicamente, llena la columna deleted_at
        $order->delete(); 

        return response()->json(['message' => 'Order successfully archived.', 'order' => $order], 200);
    }

    // 6. Buscar orden por número de factura (GET /api/orders/invoice/{invoice})
    public function searchByInvoice(string $invoice)
    {
        $order = Order::where('invoice_number', $invoice)->firstOrFail();
        return response()->json($order, 200);
    }

    // 7. Listar órdenes archivadas (GET /api/orders/archived)
    public function archived()
    {
        // onlyTrashed() trae únicamente las órdenes que sufrieron borrado lógico
        $archivedOrders = Order::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return response()->json($archivedOrders, 200);
    }
}