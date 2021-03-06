<?php
class ConnectionTest extends PHPUnit_Framework_TestCase{
    public function setUp(){
        require_once 'fonction.php';
    }

    public function testFile(){
      $ad = "ok" ;
      $this->assertTrue(lecture(OpenFile('/home/travis/build/jeflagel/ZZgenda/assets/db/database.txt'),"jeflagel","coucou",$ad)==1 );
      $this->assertTrue($ad=="y");
      $this->assertFalse(lecture(OpenFile('/home/travis/build/jeflagel/ZZgenda/assets/db/database.txt'),"jeflagel","aurevoir",$ad)==1 );
      $pass = "Test" ;
      $this->assertTrue(Chiffrement($pass)!="$pass");
      $this->assertTrue(OpenFile('fail')==0);
    }

    public function testlangue(){
      require('/home/travis/build/jeflagel/ZZgenda/assets/lang.php') ;
      $langage='en';
      $this->assertTrue($lang['identification']['login'][$langage]=="Enter login");
      $langage='fr';
      $this->assertTrue($lang['identification']['login'][$langage]=="Pseudo");
    }

    public function testconf(){
      require('/home/travis/build/jeflagel/ZZgenda/assets/lang.php') ;
      $_POST['location'] ="paris";
      $_POST['prenom'] ="jere" ;
      $_POST['nom'] ="flagel" ;
      $_POST['intitule'] ="testConf" ;
      $_POST['le-message'] = "bienvenue a la conf";
      $_POST['day'] ="02-10-2019" ;
      $_POST['hour'] ="12:30" ;
      $key=add(); //add conference
      $this->assertTrue(displayConf(true)==1);  // display admin
      $this->assertTrue(displayConf(false)==0);  // display simple user
      $this->assertTrue(empty($_POST['prenom'])); // before edit() $_POST is empty
      edit($key);  // recover conf data in $_POST
      $this->assertTrue($_POST['prenom'] =="jere"); //chekc that information is well recovered
      $key=add(); //add conference after changes
      $this->assertTrue(delete($key));//delete conference added before
    }

}
?>
