<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;
use ZipArchive;
use App\Models\Language;
use App\Models\Translation;
use App\Models\Key;

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

    public function index(Request $request){
        $type = $request->type;
        
        $languages = Language::all();
        $keys = Key::leftJoin('translations', 'keys.id' ,'=', 'translations.key_id')->get();        
        $data = [];        

        if($type == 'json'){
            $zip_file = 'languages.zip'; 
            $zip = new ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
            
            foreach($languages as $language){
                $filename = $language->iso.'.json';
                foreach($keys->where('keys.language_id', $language->id) as $key){
                    $data[$key->name] = $key->text;
                }
                $file = fopen(storage_path().'/'.$filename, 'w');
                File::put(storage_path().'/'.$filename, json_encode($data));       
                fclose($file);                       
                $zip->addFile(storage_path().'/'.$filename, $filename);               
            }
            
            $zip->close(); 

            return response()->download($zip);            
        }elseif($type == 'yaml'){            
            foreach($languages as $language){
                $data[$language->iso] = [];
                foreach($keys->where('keys.language_id', $language->id) as $key){
                    $data[$language->iso][$key->name] = $key->text;
                }                
                
                $file = fopen(storage_path().'/translations.yaml', 'w');                        
                File::put(storage_path().'/translations.yaml', Yaml::dump($data));       
                fclose($file);                                   
                
                return response()->download(storage_path().'/translations.yaml');                            
            }
        }else{
            return response()->json(['success' => 0, 'error' => 'Incorrect type']);
        }
    }        

}
