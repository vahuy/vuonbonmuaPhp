<?php
/**
 * Connect database
 * Created by PhpStorm.
 * User: Brian
 * Date: 1/8/2019
 * Time: 9:24 PM
 */
    class DatabaseConnector
    {
        private $connector;

        function createConnection(){
            $servername = "localhost";
            $username = "huy";
            $password = "123456";
            $dbname = "vuonbonmua";

//            $servername = "localhost";
//            $username = "laz87900_huy";
//            $password = "vuonbonmuatx22";
//            $dbname = "laz87900_vuonbonmua";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
			$conn->set_charset("utf8");
			if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $this->connector=$conn;
            return $conn;
        }

        function getAllProduct(){
            $sql = "SELECT * FROM product";
            $result = $this->connector->query($sql);

//            if ($result->num_rows > 0) {
//                echo "data found";
//            } else {
//                echo "0 results";
//            }
            return $result;
        }
        
    	function getClimbing(){
            $sql = "SELECT * FROM product WHERE type='climbing'";
            $result = $this->connector->query($sql);
            return $result;
        }

    	function getShrub(){
            $sql = "SELECT * FROM product WHERE type='shrub'";
            $result = $this->connector->query($sql);
            return $result;
        }
        
    	function getTreatment(){
            $sql = "SELECT * FROM product WHERE type='treatment'";
            $result = $this->connector->query($sql);
            return $result;
        }
        /**
         * Close Database connection
         * @param $conn
         */
        function closeConnection(){
            $this->connector->close();
//            mysqli::mysqli_get_server_info("localhost");
//            echo "close connection successfully";
        }
    }
