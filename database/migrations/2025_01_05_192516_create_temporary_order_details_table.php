<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('temporary_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->timestamp('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('temporary_order_details');
    }
}