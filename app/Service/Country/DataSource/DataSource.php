<?php

declare(strict_types=1);

namespace App\Service\Country\DataSource;

use JsonException;

interface DataSource
{
    /**
     * @throws JsonException
     */
    public function getData(): array;
}
