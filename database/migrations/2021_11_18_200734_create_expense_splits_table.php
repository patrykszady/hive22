<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseSplitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_splits', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->integer('expense_id')->unsigned();
            $table->integer('project_id')->unsigned()->nullable();
            $table->integer('distribution_id')->unsigned()->nullable();
            $table->string('reimbursment')->nullable();
            $table->integer('belongs_to_vendor_id');
            $table->integer('created_by_user_id');
            $table->string('note')->nullable();            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_splits');
    }
}
