<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('name', 100);
            $table->string('email', 60)->unique(true);
            $table->string('password', 255);
            $table->enum('role', ['admin', 'employee', 'customer']);
            $table->boolean('is_verified')->default(0);
            $table->unsignedBigInteger('file_id')->nullable(true);
            $table->unsignedBigInteger('plan_id')->nullable(true);
            $table->timestamps();

//            Foreign key constrain
            $table->foreign('file_id')->references('id')->on('files')
                ->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('plan_id')->references('id')->on('plans')
                ->onDelete('SET NULL')->onUpdate('CASCADE');
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
