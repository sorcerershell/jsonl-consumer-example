<?php
namespace App\Model;

final class OrderLineItem
{
    private int $quantity;
    private float $unitPrice;
    private Product $product;

    public static function create(int $quantity, float $unitPrice, Product $product): OrderLineItem
    {
        $item = new self();
        $item->quantity = $quantity;
        $item->unitPrice = $unitPrice;
        $item->product = $product;
        return $item;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of unitPrice
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * Set the value of unitPrice
     *
     * @return  self
     */
    public function setUnitPrice($unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Get the value of product
     */ 
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * Set the value of product
     *
     * @return  self
     */ 
    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
