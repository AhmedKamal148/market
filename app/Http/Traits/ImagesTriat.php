<?php

namespace App\Http\Traits;


use function PHPUnit\Framework\fileExists;

trait ImagesTriat
{
    /**
     * @param $file The Image U Wanna Upload IT.
     * @param $fileName We Make A Name To File .
     * @param $path The Path U Wanna Save An Image There .
     * @param $fileExists To Check If Image Was Found -> Delete It, We Will Use This In Update Method.
     * @return void
     *
     */
    private function UploadImage($file,$fileName,$path,$fileExist = null): void
    {
        $file->move(public_path('images/' . $path),$fileName);

        $imageName = explode('\\ ',$fileExist);
        $imageName= $imageName[count($imageName)-1];

        if(!is_null($fileExist))
        {

                if(str_contains($fileExist , '.jpg')||str_contains($fileExist , '.png') ||str_contains($fileExist , '.jpeg')){
                    unlink(public_path($fileExist));
                }else{
                    $fileExist = null;
                }


        }


    }
}
