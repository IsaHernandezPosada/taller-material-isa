<?php
/*
 * Author: Isabella Hernandez Posada
 * File: OrderItemController.php
 * Description: OrderItem controller with CRUD operations
 * Created: 2025-03-22
 */

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OrderItemController extends Controller
{

    /**
     * Display form to create a new order item
     *
     * @return View
     */
    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create Order Item';
        return view('orderitem.create')->with('viewData', $viewData);
    }

    /**
     * Store a new order item in the database
     * Validates input and calculates subtotal
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'unit_price' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
            'order_id' => 'required|integer',
            'piece_id' => 'required|integer',
        ]);

        $unit_price = $request->input('unit_price');
        $quantity = $request->input('quantity');
        $subtotal = $unit_price * $quantity;

        OrderItem::create([
            'unit_price' => $unit_price,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'order_id' => $request->input('order_id'),
            'piece_id' => $request->input('piece_id'),
        ]);

        return redirect()->route('orderitems.index')
                       ->with('success', 'Order item created successfully');
    }

    /**
     * Display list of all order items
     *
     * @return View
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Order Items List';
        $viewData['orderitems'] = OrderItem::all();
        return view('orderitem.index')->with('viewData', $viewData);
    }

    /**
     * Display details of a specific order item
     *
     * @param string $id
     * @return View
     */
    public function show(string $id): View
    {
        $viewData = [];
        $viewData['title'] = 'Order Item Details';
        $viewData['orderitem'] = OrderItem::findOrFail($id);
        return view('orderitem.show')->with('viewData', $viewData);
    }

    /**
     * Delete an order item from database
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        OrderItem::findOrFail($id)->delete();

        return redirect()->route('orderitems.index')
                       ->with('success', 'Order item deleted successfully');
    }
}