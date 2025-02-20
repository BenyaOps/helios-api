<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // name, superior_id, nivel, employees_quantity, ambassador_id
            $table->string('name', 45)->unique();
            $table->integer('superior_id')->nullable();
            $table->unsignedInteger('nivel');
            $table->unsignedInteger('employees_quantity');
            $table->integer('ambassador_id')->nullable();

            $table->foreign('superior_id')->references('id')->on('departments');
            $table->foreign('ambassador_id')->references('id')->on('ambassadors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
