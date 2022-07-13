<?php
namespace App\Tests\Service;
use PHPUnit\Framework\TestCase;
use App\Service\FileSystemImproved;


Class FileSystemImprovedTest extends TestCase {


 public function testState()
    {
    $fsi=new FileSystemImproved();
      $this->assertSame(['test2','test4'], $fsi->state());
   }
   public function testcreateFile()
   {  
      $crs=new FileSystemImproved();
      $this->assertSame(["test2","test4"], $crs->createFile("test1"));;
   }
   public function testdeleteFile()
      {
             $fsi = new FileSystemImproved();

      $this->assertSame(true, $fsi->deleteFile("test4"));
 }
   public function testWriteFile(){
     $fsi = new FileSystemImproved();
     $this->assertSame(true,$fsi->writeFile('test2', 'we are not doing good'));
}
   public function testReadFile(){
     $fsi = new FileSystemImproved();
      $this->assertNotFalse($fsi->readFile('test2'));

} 
}
