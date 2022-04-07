<?php
namespace ASPTest\Model;
use \PDO;
use \PDOException;
use \RuntimeException;

class Connection {

    /**
     * Defines the schema to be used
     * @var string 
     */
    private $bd;

    /**
     * Defines the database user
     * @var string 
     */
    private $user;

    /**
     * User's password
     * @var senha
     */
    private $password;

    /**
     * Database driver (MySQL, PGSQL, DB2 e etc)
     * @var string
     */
    private $driver;

    /**
     * Database host (IP address or server name )
     * @var string
     */
    private $host;

    /**
    * Database PORT
    * MySQL Defaults to 3306
    * @var string
    */
    private $port;

    /**
     * Database connection resource
     * @var resource
     */
    private $con;
    
    /**
     * Set the database environment, based on 
     * the configuration file
     * Defaults to PROD or DEV
     * @var string 
     */
    private $env = "DEV";
    
    /**
     * Class constructor, sets values to class atributes according to
     * the loaded .ini file
     * @throws RuntimeException
     * @returns void
     */
    function __construct() {
        try {

            $base = __DIR__ . '/../../';

            if ($config = parse_ini_file( $base."conf".DIRECTORY_SEPARATOR."config.ini.php", true)) {

                $this->bd = $config[$this -> env]["DATABASE"];
                $this->user = $config[$this -> env]["USER"];
                $this->password = $config[$this -> env]["PASSWORD"];
                $this->driver = $config[$this -> env]["DRIVER"];
                $this->host = $config[$this -> env]["HOST"];
                $this->port = $config[$this ->env]["PORT"];
                
                return  $this;
            } else {
                throw new RuntimeException("Runtime Error, please try again.");
            }
        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Stabilish a new connection to the database
     * @return resource
     */
    private function connect() {

        try {

            $this->con = new PDO($this->driver . $this->bd . $this->host.$this->port, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            return $this->con;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Returns the connection resource
     * @return resource
     */
    public function getConnection() {
        return $this->connect();
    }

}
