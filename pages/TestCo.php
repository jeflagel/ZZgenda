<?php
class ConnectionTest extends PHPUnit_Framework_TestCase{
    public function setUp(){
        require_once 'identification.php';
    }

    public function testlogin(){
        assertTrue(isset($_SESSION['login']))
    }
}
?>
