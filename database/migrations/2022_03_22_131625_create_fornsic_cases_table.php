<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornsicCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornsic_cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_name');
            $table->text('case_description');

            $table->boolean('completed');
            $table->boolean('priority');

            $table->string('user_Access_List')->nullable();

            $table->unsignedBigInteger('company_id')->default('0');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->unsignedBigInteger('created_by')->default('0');
            $table->foreign('created_by')->references('id')->on('users');

            $table->timestamps();

            $table->string('case_hash')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornsic_cases');
    }
}
