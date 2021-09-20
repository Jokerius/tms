<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class LanguageController extends Controller {

    public function index(){
        $languages = Language::orderBy('name')->pluck('name')->all();
        
        return response()->json($languages);
    }        

}
