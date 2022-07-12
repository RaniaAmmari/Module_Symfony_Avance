<?php

namespace App\Service;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;



class FileSystemImproved

{    public $finder;
     public $filesystem;

     public function __construct()
     {
        $this->filesystem = new FileSystem();
        $this->finder  = new Finder() ;

     }

     public function state(){
        $this->finder->in(dirname(getcwd()))->path('fsi');
        foreach ($this->finder as $file) {
            $path = $file->getPath().'\\';
        }

        $resultat = $this->finder->files()->in($path);
        foreach ($resultat as $file) {
            $files[] = $file->getFilename();
        }
        return $files;
    }

public function createFile($filename){

    $this->filesystem->touch(
        "C:\Users\\rammari\Desktop\Module-Symfony-Avancé\Php Unit test\\vendor\symfony\http-client-contracts\Test\Fixtures\web\\fsi\\".$filename);
    $this->finder->in(dirname(getcwd()))->path('fsi');
    foreach ($this->finder as $file) {
        $path = $file->getPath().'\\';
    }

    $resultat = $this->finder->files()->in($path);
    foreach ($resultat as $file) {
        $files[] = $file->getFilename();
    }
    return $files;
}

public function deleteFile($filename)
{
    $files = $this->finder->in(dirname(getcwd()))->path($filename);
    if (!$files->hasResults()) {
        return false;
    }

    foreach ($files as $file) {
        $path = $file->getRealPath();
    }

    $this->filesystem->remove($path);
    return true;
}

public function writeInFile($filename, $text, $offset = 0)
    {
        $files = $this->finder->in(dirname(getcwd()))->path($filename);
        if (!$files->hasResults()) {
            return false;
        }
        foreach ($files as $file) {
            $path = $file->getRealPath();
        }
        $file = fopen($path,'a+');
        fseek($file,$offset);
        fwrite($file,$text);
        fclose($file);
        return true;
    }

    public function readFile($filename){
        $files = $this->finder->in(dirname(getcwd()))->path($filename);
        if (!$files->hasResults()) {
            return false;
        }
        foreach ($files as $file) {
            $path = $file->getRealPath();
        }
        $file = fopen($path,'r+');
        $res = fread($file,filesize($path));
        return $res;
    }
}