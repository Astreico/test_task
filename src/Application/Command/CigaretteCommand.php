<?php

namespace Application\Command;

use Application\Service\CigaretteService;

class CigaretteCommand
{
    public function execute($input)
    {
        $amount = isset($input[0]) ? (int) $input[0] : false;
        $price = isset($input[1]) ? (float) $input[1] : false;
        if (!$amount) {
            throw new \Exception('Please, specify the amount of packs you want to by');
        }

        $service = new CigaretteService($amount, $price);
        return $service->buyCigarettes();
    }
}
