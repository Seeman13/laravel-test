<?php

namespace App\Models;

use Carbon\Carbon;
use Str;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Car
 *
 * @package App\Models
 *
 * @property int|null $brand_id
 * @property string $vendor_code
 * @property integer $release
 * @property string $engine
 * @property boolean|null $transmission
 * @property float $price
 * @property string|null $alias
 * @property string|null $description
 * @property boolean $active
 * @property int $views
 * @property string|Carbon $created_at
 * @property string|Carbon $updated_at
 */
class Car extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $fillable = [
        'brand_id',
        'vendor_code',
        'release',
        'engine',
        'transmission',
        'price',
        'alias',
        'description',
        'active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id'           => 'integer',
        'brand_id'     => 'integer',
        'vendor_code'  => 'string',
        'release'      => 'integer',
        'engine'       => 'string',
        'transmission' => 'boolean',
        'price'        => 'float',
        'alias'        => 'string',
        'description'  => 'string',
        'active'       => 'boolean',
        'views'        => 'integer',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime'
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static array $rules = [
        'brand_id'     => 'nullable|integer|digits_between:1,5|exists:brands,id',
        'vendor_code'  => 'required|string|max:50',
        'release'      => 'required|string|max:4',
        'engine'       => 'required|string|max:8',
        'transmission' => 'nullable|boolean',
        'price'        => 'required|numeric|between:0.1,999999.99',
        'alias'        => 'nullable|string|max:200|unique:cars,alias',
        'description'  => 'nullable|string|max:535',
        'active'       => 'boolean'
    ];

    /**
     * Field names.
     *
     * @var array
     */
    public static array $attributeLabels = [
        'id'           => 'ID',
        'brand_id'     => 'ID Brand',
        'vendor_code'  => 'Модель автомобиля',
        'release'      => 'Год выпуска',
        'engine'       => 'Тип двигателя',
        'transmission' => 'Тип привода',
        'price'        => 'Цена',
        'alias'        => 'ЧПУ алиас',
        'description'  => 'Краткое описание модели',
        'active'       => 'Показ в каталоге',
        'views'        => 'Просмотры',
        'created_at'   => 'Created at',
        'updated_at'   => 'Updated at'
    ];

    /**
     * Event handling... .. .
     *
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        self::creating(static function ($model) {
            if (empty($model->alias)) {
                $model->alias = Str::slug($model->name);
            }
        });

        self::updating(static function ($model) {
            if (empty($model->alias)) {
                $model->alias = Str::slug($model->name);
            }
        });
    }

    /**
     * @return HasOne
     */
    public function brand(): HasOne
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id')->select('id', 'name', 'alias');
    }

    /**
     * @return HasOne
     */
    public function photo(): HasOne
    {
        return $this->hasOne(CarPhoto::class, 'car_id')
            ->select('car_id', 'image')
            ->orderBy('sort');
    }

    /**
     * @return HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany(CarPhoto::class, 'car_id', 'id')
            ->select('car_id', 'image')
            ->orderBy('sort');
    }
}
