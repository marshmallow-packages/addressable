<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Marshmallow\Ecommerce\Cart\Models\ShoppingCartItem;

class AddTypeColumnToAddressTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('address_types', function (Blueprint $table) {
            $table->string('type')->default(null)->nullable()->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('address_types', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
