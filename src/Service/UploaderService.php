<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderService
{
    /**
     * @var SluggerInterface
     */
    private $slugger;
    /**
     * @var ParameterBagInterface
     */
    private $parameter;

    /**
     * @param SluggerInterface $slugger
     * @param ParameterBagInterface $parameter
     */
    public function __construct(SluggerInterface $slugger, ParameterBagInterface $parameter)
    {
        $this->slugger = $slugger;
        $this->parameter = $parameter;
    }

    /**
     * @param $file
     * @param string $path
     * @return string
     */
    public function upload($file, string $path)
    {

        $dir = match($path){
            'service' => 'SERVICE',
            'profile' => 'PROFILE',
            'mp4'=>'VIDEOS',
            'params'=>'PARAMSIMG',
            'contact'=>'CONTACT_FILES'
        };

        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
        try {
            $file->move(
                $this->parameter->get($dir),
                $newFilename
            );
        } catch (FileException $e) {
            dd($e);
        }
        return $newFilename;

    }

    /**
     * @param $file
     * @return void
     */
    public function destroy($file):void
    {
        //delete the video if exist
        $filePath = $this->parameter->get('IMAGES') . '/' . $file;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}