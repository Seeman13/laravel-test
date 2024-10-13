<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CarPhoto
 * @package App\Models
 *
 * @property int $car_id
 * @property string $image
 * @property int $sort
 */
class CarPhoto extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'car_photos';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $fillable = [
        'car_id',
        'image',
        'sort'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'car_id' => 'integer',
        'image'  => 'string',
        'sort'   => 'integer'
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static array $rules = [
        'car_id' => 'required|integer|digits_between:1,10|exists:cars,id',
        'image'  => 'required|string|max:100',
        'sort'   => 'integer|digits_between:1,3|max:255'
    ];

    /**
     * Field names.
     *
     * @var array
     */
    public static array $attributeLabels = [
        'car_id' => 'ID Car',
        'image'  => 'Название картинки без расширения',
        'sort'   => 'Порядок вывода'
    ];

    /**
     * @return BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
