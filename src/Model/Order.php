<?php
namespace App\Model;

use JMS\Serializer\Annotation as Serializer;
use \JMS\Serializer\Annotation\Type;

final class Order
{
    /**
     * @Type("int")
     * @var int
     */
    private int $orderId;

    /**
     * @var \DateTime
     * @Type("DateTime<'D, d M Y H:i:s O'>")
     */
    private \DateTime $orderDate;
    /**
     * @var Customer
     * @Type("Customer")
     */
    private Customer $customer;

    /**
     * @var array
     * @Type("array")
     */
    private array $discounts;

    /**
     * @var float
     * @Type("float")
     */
    private float $shippingPrice;

    public function __construct()
    {
        $this->orderDate = new \DateTime();
        $this->customer = new Customer();
    }


    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     * @return Order
     */
    public function setOrderId(int $orderId): Order
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrderDate(): \DateTime
    {
        return $this->orderDate;
    }

    /**
     * @param \DateTime $orderDate
     * @return Order
     */
    public function setOrderDate(\DateTime $orderDate): Order
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return Order
     */
    public function setCustomer(Customer $customer): Order
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }

    /**
     * @param mixed $discounts
     * @return Order
     */
    public function setDiscounts($discounts)
    {
        $this->discounts = $discounts;
        return $this;
    }

    /**
     * @return float
     */
    public function getShippingPrice(): float
    {
        return $this->shippingPrice;
    }

    /**
     * @param float $shippingPrice
     * @return Order
     */
    public function setShippingPrice(float $shippingPrice): Order
    {
        $this->shippingPrice = $shippingPrice;
        return $this;
    }


    
    /**
     * Order Line Items
     *
     * @var ?OrderLineItem[] $items
     */
    private ?array $items;

    /**
     * Get $items
     *
     * @return  OrderLineItem[]
     */ 
    public function getItems(): ?array
    {
        return $this->items;
    }

    /**
     * Set $items
     *
     * @param  OrderLineItem[] $items
     *
     * @return  self
     */ 
    public function setItems(?array $items)
    {
        $this->items = $items;

        return $this;
    }
}
