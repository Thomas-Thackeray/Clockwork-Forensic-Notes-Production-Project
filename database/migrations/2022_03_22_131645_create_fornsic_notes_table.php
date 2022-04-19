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

            $table->boolean('toolUsed')->default('0');
            $table->boolean('evidenceFound')->default('0');

            $table->string('action_type')->default('N/S');
            $table->string('outcome_type')->default('N/S');
            $table->string('tool_name')->default('N/S');
            $table->string('tool_version')->default('N/S');
            $table->string('power_status')->default('N/S');
            

            $table->boolean('locked')->default('0');

            $table->string('note_type');

            $table->string('md5_hash');
            $table->string('sha1_hash');

            $table->string('serial_number')->default('');
            $table->string('model')->default('');
            $table->string('manufacturer')->default('');

            $table->text('damage_unique_markings')->nullable();

                                              
            $table->string('evidence_bag_number')->default('');

            $table->text('description');
            $table->text('further_details');
            $table->text('hardware_connections')->nullable(true);;
            $table->text('cable_configuration')->nullable(true);;

            $table->string('image_1')->default('');  
            $table->string('image_2')->default('');   
            $table->string('image_3')->default('');       

            $table->string('audio_1')->default('');  
            $table->string('audio_2')->default('');   
            $table->string('audio_3')->default('');   

            $table->unsignedBigInteger('created_by_id')->default('0');
            $table->foreign('created_by_id')->references('id')->on('users');

            $table->unsignedBigInteger('case_assigned')->default('0');
            $table->foreign('case_assigned')->references('id')->on('fornsic_cases');

            $table->string('note_start_Time')->default('');
            $table->string('note_start_Date')->default('');

            $table->string('longitude')->default('');
            $table->string('latitude')->default('');


            $table->string('evidence_ref')->default('N/S');
            $table->string('evidence_manufacturer')->default('N/S');
            $table->string('evidence_serialNumber')->default('N/S');
            $table->string('evidence_model')->default('N/S');
            $table->string('evidence_bagID')->default('N/S');
            $table->string('evidence_courtExhibitNumber')->default('N/S');
            $table->string('evidence_storageRef')->default('N/S');
            $table->text('evidence_damage');

            $table->string('storage_alteration')->default('N/S');

            $table->string('premesis_Address')->default('N/S');
            $table->string('arrival_Time')->default('N/S');

            $table->string('device_1_Name')->default('N/S');
            $table->string('device_2_Name')->default('N/S');
            $table->string('device_3_Name')->default('N/S');
            $table->string('device_4_Name')->default('N/S');
            $table->string('device_5_Name')->default('N/S');
            $table->string('device_6_Name')->default('N/S');
            $table->string('device_7_Name')->default('N/S');
            $table->string('device_8_Name')->default('N/S');
            $table->string('device_9_Name')->default('N/S');
            $table->string('device_10_Name')->default('N/S');

            

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
