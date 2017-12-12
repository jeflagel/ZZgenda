<?php
class ConnectionTest extends PHPUnit_Framework_TestCase{
    public function setUp(){
        require_once 'fonction.php';
        require_once '../assets/lang.php';
    }

    public function testFile(){
      $ad = "ok" ;
      $this->assertTrue(lecture(OpenFile('/home/travis/build/jeflagel/ZZgenda/assets/db/database.txt'),"jeflagel","coucou",$ad)==1 );
      $this->assertTrue($ad=="y");
      $this->assertFalse(lecture(OpenFile('/home/travis/build/jeflagel/ZZgenda/assets/db/database.txt'),"jeflagel","aurevoir",$ad)==1 );
      $pass = "Test" ;
      $this->assertTrue(password_verify("$pass", Chiffrement($pass)));
      $this->assertTrue(OpenFile('fail')==0);
    }

    public function testCookie(){
      setcookie('login', "coucou",time()+3600*24*31);
      $this->assertTrue($_COOKIE['login']=="coucou");
      $this->assertFalse($_COOKIE['login']=="rate");
      setcookie('login');
      $this->assertFalse($_COOKIE['login']=="coucou");
    }

    public function testlangue(){
      $langage='en';
      $this->assertTrue($lang['identification']['login'][$langage]=="Enter login");
      $langage='fr';
      $this->assertTrue($lang['identification']['login'][$langage]=="Pseudo");
    }

}
?>
