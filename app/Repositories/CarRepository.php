<?php

namespace App\Repositories;

use Config;

use App\Models\CarSearch;

/**
 * Class CarRepository
 *
 * @package App\Repositories
 */
readonly class CarRepository
{
    private int $per_page;

    public function __construct(public CarSearch $model)
    {
        $this->per_page = Config::get('settings.paginate_catalog_cars', 25);
    }

    /**
     * @param array $filters
     * @param int $per_page
     * @return array
     */
    public function get(array $filters, int $per_page): array
    {
        $paginator = $this->model->search($filters, $per_page ?: $this->per_page);

        if ($paginator->isNotEmpty()) {
            return [
                'items' => $paginator->collect(),
                'links' => $paginator->linkCollection(),
                'total_last_items' => $paginator->total() - $paginator->perPage() * $paginator->currentPage()
            ];
        }

        return ['items' => 0, 'links' => [], 'total_last_items' => -1];
    }
}
