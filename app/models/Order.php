<?php

/**
 * MVC - Model
 * Class Order
 * Database Orders Model
 */
class Order extends Base
{
    /**
     * Order constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get queue order list
     * @return string - HTML
     */
    public function getOrdersInQueue()
    {
        return "";
    }
}