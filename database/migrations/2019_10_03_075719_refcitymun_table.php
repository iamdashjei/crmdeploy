<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefcitymunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refcitymun', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->string("psgcCode");
            $table->text("citymunDesc");
            $table->string("regDesc");
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
        Schema::dropIfExists("refcitymun");
    }
}
