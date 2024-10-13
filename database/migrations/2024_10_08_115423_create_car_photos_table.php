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
        if (!Schema::hasTable('car_photos')) {
            Schema::create('car_photos', function (Blueprint $table) {
                $table->unsignedBigInteger('car_id')
                    ->comment('ID Car');

                $table->char('image', 100)
                    ->comment('Название картинки без расширения');

                $table->unsignedTinyInteger('sort')
                    ->default(0)
                    ->comment('Порядок вывода');

                $table->primary(['car_id', 'image']);
                $table->index('car_id');

                $table->foreign('car_id')
                    ->references('id')
                    ->on('cars')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->comment('Фото автомобилей');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_photos');
    }
};
