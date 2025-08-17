<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(0);
            }
            if (!Schema::hasColumn('products', 'featured')) {
                $table->boolean('featured')->default(0);
            }
            if (!Schema::hasColumn('products', 'benefits')) {
                $table->text('benefits')->nullable();
            }
            if (!Schema::hasColumn('products', 'ingredients')) {
                $table->text('ingredients')->nullable();
            }
            if (!Schema::hasColumn('products', 'size')) {
                $table->string('size')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['stock', 'featured', 'benefits', 'ingredients', 'size']);
        });
    }
};
