<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('cars')) {
            Schema::create('cars', static function (Blueprint $table) {
                $table->id()->comment('ID');

                $table->unsignedSmallInteger('brand_id')
                    ->nullable()
                    ->comment('ID Brand');

                $table->char('vendor_code', 50)
                    ->comment('Модель автомобиля');

                $table->char('release', 4)
                    ->comment('Год выпуска');

                $table->enum('engine', ['petrol', 'diesel', 'hybrid', 'electric'])
                    ->default('petrol')
                    ->comment('Тип двигателя');

                $table->boolean('transmission')
                    ->nullable()
                    ->default(null)
                    ->comment('Тип привода: 0 - передний; 1 - задний');

                $table->float('price', 10)
                    ->comment('Цена');

                $table->char('alias', 200)
                    ->nullable()
                    ->unique()
                    ->comment('ЧПУ алиас');

                $table->string('description', 535)
                    ->nullable()
                    ->comment('Краткое описание модели');

                $table->boolean('active')
                    ->default(1)
                    ->comment('Показ в каталоге');

                $table->unsignedBigInteger('views')
                    ->default(0)
                    ->comment('Просмотры');

                $table->timestamps();

                $table->foreign('brand_id')
                    ->references('id')
                    ->on('brands')
                    ->onDelete('set null')
                    ->onUpdate('cascade');

                $table->comment('Автомобили');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
