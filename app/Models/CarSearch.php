<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class CarSearch
 * @package App\Models
 */
class CarSearch extends Car
{
    /**
     * @param Builder $query
     * @param string|null $brand
     * @return Builder
     */
    public function scopeBrand(Builder $query, string|null $brand): Builder
    {
        if (!is_null($brand)) {
            return $query->where('brand_id', static function ($query) use ($brand) {
                $query->select('id')->from('brands')->where('alias', $brand);
            });
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param int $vendor_code
     * @return Builder
     */
    public function scopeVendor(Builder $query, int $vendor_code): Builder
    {
        return $query->where('vendor_code', $vendor_code);
    }

    /**
     * @param $query
     * @param int $year_start
     * @return Builder
     */
    public function scopeYearStart($query, int $year_start): Builder
    {
        return $query->where('release', '>=', $year_start);
    }

    /**
     * @param $query
     * @param int $year_end
     * @return Builder
     */
    public function scopeYearEnd($query, int $year_end): Builder
    {
        return $query->where('release', '<=', $year_end);
    }

    /**
     * @param Builder $query
     * @param string $engine
     * @return Builder
     */
    public function scopeEngine(Builder $query, string $engine): Builder
    {
        return $query->where('engine', $engine);
    }

    /**
     * @param Builder $query
     * @param int|string|null $transmission
     * @return Builder
     */
    public function scopeTransmission(Builder $query, int|string|null $transmission): Builder
    {
        if ($transmission == 'null') {
            return $query->whereNull('transmission');
        }

        return $query->where('transmission', $transmission);
    }

    /**
     * @param $query
     * @param int $price_start
     * @return Builder
     */
    public function scopePriceStart($query, int $price_start): Builder
    {
        return $query->where('price', '>=', $price_start);
    }

    /**
     * @param $query
     * @param int $price_end
     * @return Builder
     */
    public function scopePriceEnd($query, int $price_end): Builder
    {
        return $query->where('price', '<=', $price_end);
    }

    /**
     * Scope a query to only include products of match search query.
     *
     * @param Builder $query
     * @param string $q
     * @return Builder
     */
    public function scopeQ(Builder $query, string $q): Builder
    {
        return $query->where(static function ($sub_query) use ($q) {
            $sub_query->where('vendor_code', 'like', "%$q%")
                ->orWhere('alias', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%");
        });
    }

    /**
     * Finding records in a table with specific values.
     *
     * @param array $params
     * @param int $per_page
     * @return LengthAwarePaginator
     */
    public function search(array $params, int $per_page): LengthAwarePaginator
    {
        $builder = $this->with(['brand', 'photo'])
            ->select('id', 'brand_id', 'vendor_code', 'release', 'engine', 'transmission', 'price', 'alias')
            ->where('active', true);

        $params = array_filter($params, static function($element) { return $element !== null; });

        if (!empty($params)) {
            $builder->scopes($params);
        }

        return $builder
            ->orderBy('views', 'desc')
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->orderBy('name')
            ->orderBy('id', 'desc')
            ->paginate($per_page)
            ->appends(request()->query());
    }
}
