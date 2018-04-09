<?php

namespace Application\Service;

interface OrderInterface
{
    public function calculateTotalPrice();
    public function calculateExchange();
    public function processOrder();
}
