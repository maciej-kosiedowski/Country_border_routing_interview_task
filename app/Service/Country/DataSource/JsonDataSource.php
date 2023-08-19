<?php

declare(strict_types=1);

namespace App\Service\Country\DataSource;

use Illuminate\Support\Facades\File;

class JsonDataSource implements DataSource
{
    private string $countryJsonFile;

    public function __construct()
    {
        $this->countryJsonFile = storage_path('app/countries.json');
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        return json_decode(File::get($this->countryJsonFile), true, 512, JSON_THROW_ON_ERROR);
    }
}
