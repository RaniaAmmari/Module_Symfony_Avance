<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\FileSystemImproved;



class ImprovedController extends AbstractController
{
      /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('Improved/home.html.twig', [
            'controller_name' => 'ImprovedController',
        ]);
    }
    /**
     * @Route("/Improved", name="app_Improved")
     */
    public function index(): Response
    {
        return $this->render('Improved/index.html.twig', [
            'controller_name' => 'ImprovedController',
        ]);
    }

    /**
     * @Route("/state", name="state")
     */
    public function state(FileSystemImproved $fileSystemImproved): Response
    {
        $res = $fileSystemImproved->state();
        return new JsonResponse($res);
    }

     /**
     * @Route("/create-file/{filename}", name="create_empty_file")
     */
    // public function create_Empty_File( FileSystemImproved $fileSystemImproved, $filename): Response
   
    // { $file= $fileSystemImproved->createEmptyFile($filename);
    //     $this->addFlash('success', 'json file will be generated ');
    //    return new JsonResponse(json_encode($file));
   
    
    // }

    /**
     * @Route("/write-in-file/{filename}/{text}", name="create_file_with_text")
     */
    // public function create_File( FileSystemImproved $fileSystemImproved, $filename, $text ): Response
    // {  
    //     $file= $fileSystemImproved-> createFile($filename, $text );
    //       return new JsonResponse(json_encode($file));
    // }


    /**
     * @Route("/create_file/{file_name}", name="create_file_fsi")
     */
    public function createFileFsi(FileSystemImproved $fileSystemImproved,$file_name): Response
    {
        $res = $fileSystemImproved->createFile($file_name);
        return new JsonResponse($res);}

           /**
     * @Route("/delete-file/{filename}", name="remove_text")
     */
    public function remove_file(FileSystemImproved $fileSystemImproved, $filename ): Response
    { 
        $file= $fileSystemImproved->removeFile($filename);
        return new JsonResponse(json_encode($file));
    }
    /**
     * @Route("/write_in_file/{file_name}/{content}/{offset?}", name="write_file_fsi")
     */
    public function writeFsi(FileSystemImproved $fileSystemImproved,$file_name,$content,$offset): Response
    {
        $res = $fileSystemImproved->writeInFile($file_name,$content,$offset);
        return new JsonResponse($res);
    }

    /**
     * @Route("/read_file/{file_name}", name="read_file_fsi")
     */
    public function readFsi(FileSystemImproved $fileSystemImproved,$file_name): Response
    {
        $res = $fileSystemImproved->readFile($file_name);
        return new JsonResponse($res);
    }

}