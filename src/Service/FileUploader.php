<?php
// src/Service/FileUploader.php
namespace App\Service;

use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class FileUploader
{
    private $targetDirectory;
    private $slugger;

    public function __construct(string $targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
        //$this->slugger = $file;
    }

    public function uploadByEmpresa(UploadedFile $file, Integer $idEempresa, string $cat)
    {
        return $this->upload($file);
    }

    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        //$safeFilename = $this->slugger->slug($originalFilename);
        $safeFilename = $originalFilename;
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
