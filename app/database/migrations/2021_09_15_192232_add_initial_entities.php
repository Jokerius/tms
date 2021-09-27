<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInitialEntities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();            
            $table->string('name');
            $table->string('iso');
            $table->boolean('rtl')->default(0);
        });
       
        Schema::create('keys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();            
            $table->string('name')->unique();
        });             
        
        Schema::create('translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();            
            $table->text('text');
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
            $table->foreignId('key_id')->constrained()->onDelete('cascade');
        });                      
        
        Schema::create('tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();            
            $table->string('token')->unique();
            $table->boolean('access')->default(0);
        });          
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
        Schema::dropIfExists('translations');
        Schema::dropIfExists('keys');
        Schema::dropIfExists('tokens');        
    }
}
