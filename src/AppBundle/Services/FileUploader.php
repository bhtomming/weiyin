<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\6\5 0005
 * Time: 15:21
 */

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir){
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file){
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($this->targetDir,$fileName);
        return $fileName;
    }

}