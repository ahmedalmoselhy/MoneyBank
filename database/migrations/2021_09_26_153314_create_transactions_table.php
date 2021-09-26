<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->enum('type', ['spend', 'add', 'transfer']);
            $table->unsignedBigInteger('account_id')->nullable(true);
            $table->unsignedBigInteger('category_id')->nullable(true);
            $table->unsignedBigInteger('sub_id')->nullable(true);
            $table->unsignedBigInteger('file_id')->nullable(true);
            $table->timestamps();

//            Foreign key constrain
            $table->foreign('file_id')->references('id')->on('files')
                ->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('account_id')->references('id')->on('accounts')
                ->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('sub_id')->references('id')->on('sub_categories')
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
        Schema::dropIfExists('transactions');
    }
}
