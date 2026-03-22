<?php
/*
 * Author: Isabella Hernandez Posada
 * File: OrderItem.php
 * Description: OrderItem model with getters/setters and relationships
 * Created: 2025-03-22
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'orderitems';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'unit_price',
        'quantity',
        'subtotal',
        'order_id',
        'piece_id',
    ];

    /**
     * Get the order item ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the unit price
     *
     * @return int
     */
    public function getUnitPrice(): int
    {
        return $this->unit_price;
    }

    /**
     * Get the quantity
     *
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Get the subtotal
     *
     * @return int
     */
    public function getSubtotal(): int
    {
        return $this->subtotal;
    }

    /**
     * Get the order ID
     *
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->order_id;
    }

    /**
     * Get the piece ID
     *
     * @return int
     */
    public function getPieceId(): int
    {
        return $this->piece_id;
    }

    /**
     * Set the unit price
     *
     * @param int $unit_price
     * @return void
     */
    public function setUnitPrice(int $unit_price): void
    {
        $this->unit_price = $unit_price;
    }

    /**
     * Set the quantity
     *
     * @param int $quantity
     * @return void
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * Set the subtotal
     *
     * @param int $subtotal
     * @return void
     */
    public function setSubtotal(int $subtotal): void
    {
        $this->subtotal = $subtotal;
    }

    /**
     * Set the order ID
     *
     * @param int $order_id
     * @return void
     */
    public function setOrderId(int $order_id): void
    {
        $this->order_id = $order_id;
    }

    /**
     * Set the piece ID
     *
     * @param int $piece_id
     * @return void
     */
    public function setPieceId(int $piece_id): void
    {
        $this->piece_id = $piece_id;
    }

    /**
     * Get the order associated with this order item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    /**
     * Get the piece associated with this order item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function piece()
    {
        return $this->belongsTo('App\Models\Piece');
    }

    /**
     * Calculate subtotal based on unit price and quantity
     *
     * @return int
     */
    public function calculateSubtotal(): int
    {
        return $this->unit_price * $this->quantity;
    }
}   