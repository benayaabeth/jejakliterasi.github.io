<?php 
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    class CreateBooksTable extends Migration
    {
        public function up()
        {
            Schema::create('books', function (Blueprint $table) {
                $table->id();
                $table->string('title', 255);
                $table->string('author', 255);
                $table->text('synopsis');
                $table->string('kategori', 255);
                $table->float('price');
                $table->string('image', 255)->nullable();
                $table->string('pdf_file', 255)->nullable();
                $table->timestamps();
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('books');
        }
    }
    