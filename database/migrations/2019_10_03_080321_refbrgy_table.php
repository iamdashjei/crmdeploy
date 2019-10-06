<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefbrgyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refbrgy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("brgyCode");
            $table->text("brgyDesc");
            $table->string("regCode");
            $table->string("provCode");
            $table->string("citymunCode");
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
        Schema::dropIfExists("refbrgy");
    }
}
