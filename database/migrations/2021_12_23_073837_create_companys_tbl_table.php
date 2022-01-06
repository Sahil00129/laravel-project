<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanysTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companys_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('cmpyName');
            $table->string('cmpyNo');
            $table->string('gstNum');
            $table->string('cmpyAddress');
            $table->string('bankName');
            $table->string('bankAcc');
            $table->string('ifscCode');
            $table->string('billerName');
            $table->string('payCall');
            $table->string('society');
            $table->string('sector');
            $table->string('city');
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
        Schema::dropIfExists('companys_tbl');
    }
}
