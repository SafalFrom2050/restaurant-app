<?php

namespace Services;


use Models\Image;

class ImageService {
    public $pdo;
    public $imageDir;
    private $imageId;

    public function __construct($imageDir)
    {
        $this->imageDir = $imageDir;
        $this->pdo = getPDO();
    }

    public static function create($imageDir)
    {
        return new ImageService($imageDir);
    }

    public function getImageId()
    {
        return $this->imageId;
    }

    public function uploadImage()
    {
        $dir = $this->imageDir;
        $imageTypes = ['jpg','png','jpeg','gif'];

        $fileNames = array_filter($_FILES['photos']['name']);

        // TODO: remove
        $errorMsg = '';

        $image = Image::create(getPDO());

        if (!empty($fileNames)) {
            foreach($_FILES['photos']['name'] as $key=>$val){
                // File upload path
                $fileName = basename($_FILES['photos']['name'][$key]);
                $fileName = $this->getUniqueFileName($fileName, $dir);
                $targetFilePath = $dir . $fileName;

                // Check whether file type is valid
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                $fileType = strtolower($fileType);
                if(in_array($fileType, $imageTypes, true)){
                    // Upload file to server

                    if(move_uploaded_file($_FILES["photos"]["tmp_name"][$key], $targetFilePath)){
                        // Add to database
                        $image->fileName = $fileName;
                        $this->imageId = $image->save();
                    }else{
                        $errorMsg .= 'Error uploading: ' . $_FILES['photos']['name'][$key].' | ';
                    }
                }else{
                    $errorMsg .= 'Invalid file type: ' . $_FILES['photos']['name'][$key].' | ';
                }
            }
        }
        echo $errorMsg;
    }

    private function getUniqueFileName($fileName, $path)
    {
        $file_name_new = $fileName;
        $count = 0;
        // If filename already exists, append the file count
        while (file_exists($path . $file_name_new)) {
            $file_name_new = $fileName;
            $count += 1;
            $name_only = pathinfo($file_name_new, PATHINFO_FILENAME);
            $file_ext = pathinfo($file_name_new, PATHINFO_EXTENSION);

            // Renames duplicates like filename(1).png, filename(2).png...
            $file_name_new = $name_only . '(' . $count . ').' . $file_ext;
        }

        return $file_name_new;
    }
}