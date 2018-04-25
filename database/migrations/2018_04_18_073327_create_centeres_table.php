<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenteresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',100);
            $table->string('name',250);
            $table->string('email',250);
            $table->text('address');
            $table->string('role',100);
            $table->string('division',100);
            $table->string('psc',100);
            $table->string('lab',100);
            $table->float('advance',8,2);
            $table->string('billing_cycle',100);
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
        Schema::dropIfExists('center');
    }
}
