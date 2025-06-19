<?php 
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    class CreateOrdersTable extends Migration
    {
        public function up()
        {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->float('total_price');
                $table->enum('status', ['Pending', 'Selesai'])->default('Pending');
                $table->timestamps();
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('orders');
        }
    }
    