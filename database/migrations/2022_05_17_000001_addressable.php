<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            if (!Schema::hasColumn('addresses', 'first_name')) {
                $table->string('first_name')->after('name')->nullable()->default(null);
            }
            if (!Schema::hasColumn('addresses', 'last_name')) {
                $table->string('last_name')->after('first_name')->nullable()->default(null);
            }

            if (!Schema::hasColumn('addresses', 'address_line_3')) {
                $table->string('address_line_3')->after('address_line_2')->nullable()->default(null);
            }

            if (!Schema::hasColumn('addresses', 'address_line_4')) {
                $table->string('address_line_4')->after('address_line_3')->nullable()->default(null);
            }
        });
    }
};
