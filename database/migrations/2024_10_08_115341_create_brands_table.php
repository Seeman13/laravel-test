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
        if (!Schema::hasTable('brands')) {
            Schema::create('brands', static function (Blueprint $table) {
                $table->smallIncrements('id')
                    ->unsigned()
                    ->comment('ID');

                $table->char('name', 100)
                    ->unique()
                    ->comment('Название');

                $table->char('alias', 120)
                    ->nullable()
                    ->unique()
                    ->comment('ЧПУ алиас');

                $table->char('image', 100)
                    ->nullable()
                    ->comment('Логотип');

                $table->timestamps();

                $table->comment('Производители автомобилей');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
