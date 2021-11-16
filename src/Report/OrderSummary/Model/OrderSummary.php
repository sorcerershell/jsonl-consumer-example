<?php
namespace App\Report\OrderSummary\Model;

final class OrderSummary
{
    private int $orderId;
    private \DateTime $orderDatetime;
    private float $totalOrderValue;
    private float $averageUnitPrice;
    private int $distinctUnitCount;
    private int $totalUnitsCount;
    private string $customerState;


    public function __construct()
    {
        $this->orderId = 0;
        $this->orderDatetime = new \DateTime();
        $this->totalOrderValue = 0.0;
        $this->averageUnitPrice = 0.0;
        $this->distinctUnitCount = 0;
        $this->totalUnitsCount = 0;
        $this->customerState = "";
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
     * @return OrderSummary
     */
    public function setOrderId(int $orderId): OrderSummary
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrderDatetime(): \DateTime
    {
        return $this->orderDatetime;
    }

    /**
     * @param \DateTime $orderDatetime
     * @return OrderSummary
     */
    public function setOrderDatetime(\DateTime $orderDatetime): OrderSummary
    {
        $this->orderDatetime = $orderDatetime;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalOrderValue(): float
    {
        return $this->totalOrderValue;
    }

    /**
     * @param float $totalOrderValue
     * @return OrderSummary
     */
    public function setTotalOrderValue(float $totalOrderValue): OrderSummary
    {
        $this->totalOrderValue = $totalOrderValue;
        return $this;
    }

    /**
     * @return float
     */
    public function getAverageUnitPrice(): float
    {
        return $this->averageUnitPrice;
    }

    /**
     * @param float $averageUnitPrice
     * @return OrderSummary
     */
    public function setAverageUnitPrice(float $averageUnitPrice): OrderSummary
    {
        $this->averageUnitPrice = $averageUnitPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getDistinctUnitCount(): int
    {
        return $this->distinctUnitCount;
    }

    /**
     * @param int $distinctUnitCount
     * @return OrderSummary
     */
    public function setDistinctUnitCount(int $distinctUnitCount): OrderSummary
    {
        $this->distinctUnitCount = $distinctUnitCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalUnitsCount(): int
    {
        return $this->totalUnitsCount;
    }

    /**
     * @param int $totalUnitsCount
     * @return OrderSummary
     */
    public function setTotalUnitsCount(int $totalUnitsCount): OrderSummary
    {
        $this->totalUnitsCount = $totalUnitsCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerState(): string
    {
        return $this->customerState;
    }

    /**
     * @param string $customerState
     * @return OrderSummary
     */
    public function setCustomerState(string $customerState): OrderSummary
    {
        $this->customerState = $customerState;
        return $this;
    }


    


}
