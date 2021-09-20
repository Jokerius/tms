<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class KeyController extends Controller {

    public function store(Request $request, $key){
        $validated = $request->validate(['name' => 'required|unique']);
        
        if($validated){
            $key = new Key();
            $key->name = $request->name();
            $key->save();
            
            return response()->json(['success' => 1]);             
        }        
    }
    
    public function update(Request $request, $key){
        $validated = $request->validate(['name' => 'required|unique']);
        
        if($validated){
            $key->name = $request->name();
            $key->save();
            
            return response()->json(['success' => 1]);            
        }
    }    
    
    public function delete($key){
        $key->delete();
        
        return response()->json(['success' => 1]);
    }        
    
    public function index(){
        $keys = Key::orderBy('name')->pluck('name')->all();
        
        return response()->json($keys);
    }        
    
    public function show($key){
        return response()->json($key);        
    }            
}
