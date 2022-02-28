<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->date('birthdate');
            $table->string('address');
            $table->unsignedBigInteger('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->unsignedBigInteger('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->unsignedBigInteger('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->char('zip_code');
            $table->date('date_hired')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
