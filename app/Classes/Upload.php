<?php

namespace App\Classes;

use Illuminate\Http\UploadedFile;
use File;
use Auth;

class Upload
{
    public $fileName = '';
    public $filePath = '';
    
    public function save(UploadedFile $file, $path = null)
    {
        $name = $file->hashName();
        
        if(is_null($path)){
            $this->setPath();
            $this->makeFolder();
            $path = $this->getPath();
        }
        
        $file->move("uploads/$path", $name);
        return $path . '/' . $name;
    }
    
    public function setPath()
    {
        $user_id = Auth::user()->id;
        $name = mb_substr(md5(microtime()), 0, 5);
        $this->filePath = $user_id . '_' . $name;
    }
    
    public function getPath()
    {
        return $this->filePath;
    }
    
    public function makeFolder()
    {
        if(!File::isDirectory('uploads/' . $this->filePath)){
            File::makeDirectory('uploads/' . $this->filePath, 0777, true);
        }
    }
}