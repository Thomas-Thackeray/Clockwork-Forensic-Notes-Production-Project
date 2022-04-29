<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornsicNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornsic_notes', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->boolean('locked')->default('0');

            $table->string('note_type');

            $table->string('md5_hash');
            $table->string('sha1_hash');

            $table->text('description');

            $table->unsignedBigInteger('created_by_id')->default('0');
            $table->foreign('created_by_id')->references('id')->on('users');

            $table->unsignedBigInteger('case_assigned')->default('0');
            $table->foreign('case_assigned')->references('id')->on('fornsic_cases');

            $table->string('note_start_Time')->default('');
            $table->string('note_start_Date')->default('');

            $table->string('longitude')->default('');
            $table->string('latitude')->default('');        

            $table->string('signature')->default('');
            
         
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
        Schema::dropIfExists('forensic_notes');
    }
}
