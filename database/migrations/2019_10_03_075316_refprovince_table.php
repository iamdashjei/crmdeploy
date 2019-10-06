<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefprovinceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refprovince', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->string("psgcCode");
            $table->text("provDesc");
            $table->string("regCode");
            $table->string("provCode");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("refprovince");
    }
}
