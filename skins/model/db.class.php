    <?php
    class db {
    	private $conn;
    	private $host;
    	private $user;
    	private $password;
    	private $baseName;
    	private $port;
    	private $Debug;
     
        function __construct($params=array()) {
    		$this->conn = false;
    		$this->host = '92.187.4.143'; //hostname
    		$this->user = 'david'; //username
    		$this->password = 'clon9897'; //password
    		$this->baseName = 'pordede'; //name of your database
    		$this->port = '3306';
    		$this->debug = true;
    		$this->connect();
    	}
     
        /*
        #local         
        function __construct($params=array()) {
    		$this->conn = false;
    		$this->host = 'localhost'; //hostname
    		$this->user = 'davidperezmillan'; //username
    		$this->password = ''; //password
    		$this->baseName = 'pordede'; //name of your database
    		$this->port = '3306';
    		$this->debug = true;
    		$this->connect();
    	}
    	*/
     
    	function __destruct() {
    		$this->disconnect();
    	}
    	
    	function connect() {
    		if (!$this->conn) {
    			try {
    				$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->baseName.'', $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));  
    			}
    			catch (Exception $e) {
    				die('Erreur : ' . $e->getMessage());
    			}
     
    			if (!$this->conn) {
    				$this->status_fatal = true;
    				echo 'Connection BDD failed';
    				die();
    			} 
    			else {
    				$this->status_fatal = false;
    			}
    		}
     
    		return $this->conn;
    	}
     
    	function disconnect() {
    		if ($this->conn) {
    			$this->conn = null;
    		}
    	}
    	
    	function getOne($query) {
    		$result = $this->conn->prepare($query);
    		$ret = $result->execute();
    		if (!$ret) {
    		   echo 'PDO::errorInfo():';
    		   echo '<br />';
    		   echo 'error SQL: '.$query;
    		   die();
    		}
    		$result->setFetchMode(PDO::FETCH_ASSOC);
    		$reponse = $result->fetch();
    		
    		return $reponse;
    	}
    	
    	function getAll($query) {
    		$result = $this->conn->prepare($query);
    		$ret = $result->execute();
    		if (!$ret) {
    		   echo 'PDO::errorInfo():';
    		   echo '<br />';
    		   echo 'error SQL: '.$query;
    		   die();
    		}
    		$result->setFetchMode(PDO::FETCH_ASSOC);
    		$reponse = $result->fetchAll();
    		
    		return $reponse;
    	}
    	
    	function execute($query) {
    		if (!$response = $this->conn->exec($query)) {
    			echo 'PDO::errorInfo():';
    		   echo '<br />';
    		   echo 'error SQL: '.$query;
    		   die();
    		}
    		return $response;
    	}
    }