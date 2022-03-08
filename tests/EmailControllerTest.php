<?php

namespace Test;

use App\EmailController;
use PHPUnit\Framework\TestCase;

class EmailControllerTest extends TestCase
{

    protected static $dbh;


    public function test_bad_email_is_not_inserted_in_db(){

        $_POST['email'] = 'john';        

        $response = (new EmailController(self::$dbh))->displayForm();

        $this->assertEquals(200,$response->getStatusCode());

        $sql = "SELECT count(*) FROM subscription WHERE address = :email"; 
        $stmt = self::$dbh->prepare($sql); 
        $stmt->execute(['email' => 'john@free.fr']); 
 
        $this->assertEquals(0,$stmt->fetchColumn());
        
    }

    public function test_existing_email_is_not_inserted(){

        $sql = "INSERT INTO `subscription` (address) VALUES ('john@free.fr')";
        $statement = self::$dbh->prepare($sql);
        $statement->execute();

        $_POST['email'] = 'john@free.fr';        

        $response = (new EmailController(self::$dbh))->displayForm();

        $this->assertEquals(200,$response->getStatusCode());

        $sql = "SELECT count(*) FROM subscription WHERE address = :email"; 
        $stmt = self::$dbh->prepare($sql); 
        $stmt->execute(['email' => 'john@free.fr']); 
 
        $this->assertEquals(1,$stmt->fetchColumn());

    }


    public function test_new_email_is_inserted_in_db(){

        $_POST['email'] = 'john@free.fr';        

        $response = (new EmailController(self::$dbh))->displayForm();

        $this->assertEquals(201,$response->getStatusCode());

        $sql = "SELECT count(*) FROM subscription WHERE address = :email"; 
        $stmt = self::$dbh->prepare($sql); 
        $stmt->execute(['email' => 'john@free.fr']); 
 
        $this->assertEquals(1,$stmt->fetchColumn());
        
    }

    
    public static function setUpBeforeClass():void
    {
        self::$dbh = new \PDO('sqlite::memory:', null, null);
        self::$dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
        self::$dbh->query('CREATE TABLE `subscription` (
            `address` varchar(255) NOT NULL
          )');
   
    }

    public function setUp():void
    {

        $sql = "DELETE FROM `subscription`";
        $statement = self::$dbh->prepare($sql);
        $statement->execute();

    }

    public static function tearDownAfterClass():void
    {
        self::$dbh = null;
    }

}