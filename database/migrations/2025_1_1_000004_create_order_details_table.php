<?php 
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    class CreateOrderDetailsTable extends Migration
    {
        public function up()
        {
            Schema::create('order_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
                $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
                $table->float('price');
                $table->integer('quantity');
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('order_details');
        }
    }
    