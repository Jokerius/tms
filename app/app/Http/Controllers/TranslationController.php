<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class TranslationController extends Controller {

    public function update(Request $request){
        $key = Key::where('name', $request->key)->first();        
        if(!$key){
            return response()->json(['success' => 0, 'error' => 'Key not found']);
        }
        
        $language = Language::where('iso', $request->language)->first();        
        if(!$language){
            return response()->json(['success' => 0, 'error' => 'Language not found']);
        }        
        
        $translation = Translation::where('key_id', $key->id)
                ->where('language_id', $language->id)
                ->first();
        
        if(!$translation){
            $translation = new Translation();            
            $translation->key_id = $key->id;
            $translation->language_id = $language->id;
        }
        
        $translation->text = $request->text;
        $translation->save();
        
        return response()->json(['success' => 1]);

    }    

    public function index(){
        
    }        

}
