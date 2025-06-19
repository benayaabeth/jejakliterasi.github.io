<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class ModifyStatusColumnInOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Ubah kolom status menjadi ENUM dengan nilai yang valid
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('Pending', 'verified', 'rejected', 'Selesai') NOT NULL DEFAULT 'Pending'");
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->default('Pending')->change();
        });
    }
}