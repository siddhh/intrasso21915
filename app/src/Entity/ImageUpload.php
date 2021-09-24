<?php
<<<<<<< HEAD

=======
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
namespace RestoBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUpload
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDir(), $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
