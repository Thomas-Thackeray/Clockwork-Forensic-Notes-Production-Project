<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->string('two_factor_code')->nullable();
            $table->boolean('verified')->default('0');          
            // $table->dateTime('two_factor_expires_at')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('contact_number')->nullable();

            $table->string('username')->unique();
            $table->string('password');

            $table->timestamp('last_login')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('previous_login_1')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('previous_login_2')->default(DB::raw('CURRENT_TIMESTAMP')); 

            $table->unsignedBigInteger('user_role_id')->default('0');
            $table->foreign('user_role_id')->references('id')->on('user_roles');

            $table->unsignedBigInteger('company_id')->default('0');
            $table->foreign('company_id')->references('id')->on('companies');
            
            $table->timestamps();
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
