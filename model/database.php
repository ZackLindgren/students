<?php
/**
 * Database class
 * User: laptop
 * Date: 5/20/2019
 * Time: 1:45 PM
 */
require '/home/zlindgre/config-students.php';
class Database
{
    private $_dbh;
    function __construct()
    {
        $this->connect();
    }

    function connect()
    {
        try {
            //Instantiate a db object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            //echo "Connected!!!";
            return $this->_dbh;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    function getStudents()
    {
        //1. Define the query
        $sql = "SELECT * FROM student
                ORDER BY last, first";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        //4. Execute the statement
        $statement->execute();

        //5. Return the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getDetails($sid)
    {
        //1. Define the query
        $sql = "SELECT * FROM student
                WHERE sid = :sid";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':sid', $sid, PDO::PARAM_STR);

        //4. Execute the statement
        $statement->execute();

        //5. Return the result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}