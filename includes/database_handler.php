<?php


class DataBaseHandler {
// Definning Server properties 
    private $servername;
private $dBusername;
private $dBPassword;
private $DBNmae;

//Singleton property
    private static $database_handler = null;
//Constructors to innitialize the Server property 
    private function __construct()
    {
        $this->servername = "localhost";
        $this->dBusername = "root";
        $this->dBPassword = "";
    }
    //Method to return an instance of the DataBaseHandler class
    public static function DBConnection()
    {
        if (self::$database_handler == null){
            self::$database_handler = new DataBaseHandler();
            return self::$database_handler;
        }
        else 
            return self::$database_handler;
    }
    //create a instantiating mysqli object and setting the DBNmae property if the connection is done
    public function DbOpenConnection() {
        $conn = new mysqli($this->servername, $this->dBusername, $this->dBPassword);
        
        if ($conn->connect_error){
            return FALSE;
        }

        $this->DBNmae = $conn;
        return true;
    }

// Method to connect to a specified database
    function connectToDB( $database){
        //Attempt to connect to the Database
        $connDB = mysqli_select_db($this->DBNmae, $database);
        //If connection to the Database failed save the system error message 
        if ($connDB === FALSE) {
            return FALSE;
        }
            return TRUE;
        }
 // Method to get the value of the databaseName property
    public function getDataBase() {
        return $this->DBNmae;
    }
}