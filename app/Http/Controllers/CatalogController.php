<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;

use App\Repositories\CarRepository;


class CatalogController extends Controller
{
    /**
     * CarController constructor.
     *
     * @param CarRepository $car_repository
     */
    public function __construct(private readonly CarRepository $car_repository) {}

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param string|null $brand_alias
     * @return JsonResponse|Response
     */
    public function index(Request $request, string|null $brand_alias = null): JsonResponse|Response
    {
        $params = $request->only([
            'vendor', 'yearStart', 'yearEnd', 'engine', 'transmission', 'priceStart', 'priceEnd', 'q'
        ]);

        $filters = array_merge($params, ['brand' => $brand_alias]);

        $cars = $this->car_repository->get($filters, (int) $request->get('perPage'));

        if ($request->wantsJson()) {
            return response()->json($cars);
        }

        $notice = __('notifications.empty_result');

        return Inertia::render('Catalog/Index', compact('cars', 'notice'));
    }
}
