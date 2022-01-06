<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMastersTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masters_tbl_', function (Blueprint $table) {
            $table->id();
            $table->string('flat_no');
            $table->string('cur_rd');
            $table->string('cur_rd_dt');
            $table->string('lat_pay_char');
            $table->string('amt_last_p');
            $table->string('cred_bal');
            $table->string('inv_n');
            $table->string('inv_d');
            $table->string('monthyear'); 
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
        Schema::dropIfExists('masters_tbl_');
    }
}
