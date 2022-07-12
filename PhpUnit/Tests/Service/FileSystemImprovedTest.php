<?php
namespace App\Tests\Service;
use PHPUnit\Framework\TestCase;
use App\Service\FileSystemImproved;


Class FileSystemImprovedTest extends TestCase {


 public function testState()
    {
    $fsi=new FileSystemImproved();
      $this->assertSame(['test1','test2','test4','test5'], $fsi->state());
   }
   public function testcreateFile()
   {  
      $crs=new FileSystemImproved();
      $this->assertSame(['test1','test2','test4','test5','test6'], $crs->createFile('test6'));;
   }
   public function testdeleteFile()
      {
             $fsi = new FileSystemImproved();

      $this->assertSame(true, $fsi->deleteFile('test6'));
 }
   public function testWriteFile(){
     $fsi = new FileSystemImproved();
     $this->assertSame(true,$fsi->writeFile('test1', 'we are not doing good'));
}
   public function testReadFile(){
     $fsi = new FileSystemImproved();
      $this->assertNotFalse($fsi->readFile('test1'));
}
} 