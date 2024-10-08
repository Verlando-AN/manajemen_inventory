<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_barang_id')->constrained('jenis_barangs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_barang');
            $table->string('barcode')->unique();
            $table->integer('stok')->default(0);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('foto_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->string('path'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('foto_barangs');
        Schema::dropIfExists('barangs');
    }
}
