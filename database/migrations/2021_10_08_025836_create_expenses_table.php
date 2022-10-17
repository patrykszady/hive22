<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('amount');
            $table->integer('project_id')->unsigned()->nullable();
            $table->integer('distribution_id')->unsigned()->nullable();
            $table->integer('vendor_id')->unsigned();
            $table->integer('check_id')->unsigned()->nullable();
            $table->string('reimbursment')->nullable();
            $table->integer('paid_by')->nullable();
            $table->string('invoice')->nullable();
            $table->integer('parent_expense_id')->nullable();
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
        Schema::dropIfExists('expenses');
    }
}
