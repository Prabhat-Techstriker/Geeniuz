<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_business', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('claim_user_id');
            $table->bigInteger('business_id');
            $table->bigInteger('business_creator_id');
            $table->boolean('approval_status')->default(0)->comment('1 => approve,2 => reject');
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
        Schema::dropIfExists('claim_business');
    }
}
