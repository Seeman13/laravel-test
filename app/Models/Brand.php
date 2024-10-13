<?php

namespace App\Models;

use Carbon\Carbon;
use Str;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Brands
 * @package App\Models
 *
 * @property string $name
 * @property string|null $alias
 * @property string|null $image
 * @property string|Carbon $created_at
 * @property string|Carbon $updated_at
 */
class Brand extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'brands';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $fillable = [
        'name',
        'alias',
        'image'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'alias'      => 'string',
        'image'      => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static array $rules = [
        'name'  => 'required|string|max:100|unique:brands,name',
        'alias' => 'nullable|string|max:120|unique:brands,alias',
        'image' => 'nullable|string|max:100'
    ];

    /**
     * Field names.
     *
     * @var array
     */
    public static array $attributeLabels = [
        'id'         => 'ID',
        'name'       => 'Название',
        'alias'      => 'ЧПУ алиас',
        'image'      => 'Логотип',
        'created_at' => 'Дата создания',
        'updated_at' => 'Дата обновления'
    ];

    /**
     * Event handling... .. .
     *
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        self::creating(static function($model) {
            if (empty($model->alias)) {
                $model->alias = Str::slug($model->name);
            }
        });

        self::created(static function() {
            // ...
        });

        self::updating(static function($model) {
            if (empty($model->alias)) {
                $model->alias = Str::slug($model->name);
            }
        });

        self::updated(static function() {
            // ...
        });

        self::deleted(static function() {
            // ...
        });
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
