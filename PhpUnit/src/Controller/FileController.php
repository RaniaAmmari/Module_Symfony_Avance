<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Finder\Finder;

// use App\Controller\Symfony\Component\Finder\Finder;

class FileController extends AbstractController


{
    /**
     * @Route("/create/{filename}/{text}", name="app_file")
     */
    public function createfile ($filename, $text): Response

    {    $filesystem = new Filesystem();
        // $current_dir_path="C:\Users\rammari\Desktop\Nouveau dossier\Services_Events\public";
         $current_dir_path = '\\vendor\symfony\http-client-contracts\Test\Fixtures\web\\ ';
        try {
            $filename = $current_dir_path . "$filename.txt";
         
            if (! $filesystem->exists($filename))
            {
                $filesystem->touch($filename);
                $filesystem->chmod($filename, 0777);
                 $filesystem->dumpFile($filename, $text );
                $filesystem->appendToFile($filename, "$text \n");
              
            }
        } catch (IOExceptionInterface $exception) {
            echo "Error creating file at". $exception->getPath();
        }
        return new Response($filename . ' is added with the text: ' . $text);
      
    }

    /**
     * @Route("/copy/{filename}/{filename_copy}", name="app_file_copy")
     */
//      public function copyfile ($filename):Response {
//         try {
//             $current_dir_path = getcwd();
//             $src_file_path = $current_file_path . "/$filename";
//             $dest_file_path = $current_file_path . "/$filename_copy";

//         if (!$filesystem->exists($dest_file_path))
//     {
//         $filesystem->copy($src_file_path, $dest_file_path);
//     } }
//     catch (IOExceptionInterface $exception) {
//         echo "Error copying file at". $exception->getPath();
//     }
// }
 /**
     * @Route("/copy/{filename}/{filename_copy}", name="app_file_copy")
     */
public function Copyfile(string $filename, string $filename_copy) {
 
    try {
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        $src_dir_path = $current_dir_path . "/$filename";
        $dest_dir_path = $current_dir_path . "/$filename_copy";
     
        if (!$fsObject->exists($dest_dir_path))
        {
            $fsObject->copy($src_dir_path, $dest_dir_path , true);
        }
 
    } catch (IOExceptionInterface $exception) {
        echo "Error copying directory at". $exception->getPath();
    }
    return new Response($filename . ' is COPIED');
}
/**
     * @Route("/delete/{filename}", name="app_file_copy")
     */
public function Deletefile (string $filename){
    try {
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        $src_dir_path = $current_dir_path . "/$filename";  

        if ($fsObject->exists($src_dir_path))
        {
            $fsObject->remove(['symlink', $src_dir_path, "/$filename" ]);
        }
    } catch (IOExceptionInterface $exception) {
        echo "Error copying directory at". $exception->getPath();
    }

 return new Response($filename . ' is deleted');

}

 /**
* @Route("/find", name="find_file")
*/
public function find( Filesystem $filesystem ): Response
{ 
   $bundles = array();  
$finder = new Finder();
$finder->directories()->in('../..')->name('web');

foreach ($finder as $f) {
$contents = $f->getRealPath();

}
return new Response($contents);
}
}
