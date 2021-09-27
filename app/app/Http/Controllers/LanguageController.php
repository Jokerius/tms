<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller {

    public function index(){
        $languages = Language::orderBy('name')->pluck('name')->all();
        
        return response()->json($languages);
    }        

}
