<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Language;
use App\Models\Key;
use App\Models\Translation;
use App\Models\Token;

class AddInitialData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $english = new Language();
        $english->name = 'English';
        $english->iso = 'en';
        $english->save();
        
        $italian = new Language();
        $italian->name = 'Italian';
        $italian->iso = 'it';
        $italian->save();        
        
        $key1 = new Key();
        $key1->name = 'cat';
        $key1->save();
        
        $key2 = new Key();
        $key2->name = 'dog';
        $key2->save();    
        
        $translation = new Translation();
        $translation->language_id = $english->id;
        $translation->key_id = $key1->id;
        $translation->text = 'cat';
        $translation->save();
        
        $translation = new Translation();
        $translation->language_id = $italian->id;
        $translation->key_id = $key1->id;
        $translation->text = 'gatto';
        $translation->save();

        $translation = new Translation();
        $translation->language_id = $english->id;
        $translation->key_id = $key2->id;
        $translation->text = 'dog';
        $translation->save();

        $translation = new Translation();
        $translation->language_id = $italian->id;
        $translation->key_id = $key2->id;
        $translation->text = 'cane';
        $translation->save();       
        
        $token = new Token();
        $token->token = "m3GhR0Z6HgjNr5lE";
        $token->access = 0;
        $token->save();
        
        $token = new Token();
        $token->token = "QZWm7dgIj0061uUZ";
        $token->access = 1;
        $token->save();        
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
