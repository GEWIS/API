<?php

class Database {

    private $dbn;

    public function __construct($type, $username, $password, $database, $location) {
        $this->dbn = new PDO("$type:host=$location;dbname=$database", $username, $password);
        $this->dbn->setAttribute(PDO::ATTR_AUTOCOMMIT, TRUE);
        $this->dbn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, TRUE);
    }

    public function query($szQuery, $arr = array(), $flags = PDO::FETCH_BOTH) {

        $return = new stdClass();
        $return->ERROR=false;
        $return->ERRORINFO = array();

        $pStatement = $this->dbn->prepare($szQuery);

        if(!$pStatement) {
            $return->ERROR=true;
            $return->ERRORINFO[] = $pStatement->errorInfo();
        }

        $return->query = $szQuery;
        $return->executeResult = $ex = $pStatement->execute($arr);
        $return->COUNT = $pStatement->rowCount();

        if($ex === false){
            $return->ERROR=true;
            $return->ERRORINFO[] = $pStatement->errorInfo();
        }
        $return->lastInsertID = $this->dbn->lastInsertId();

        $aResult = $pStatement->fetchAll($flags);

        $return->RESULT = $aResult !== null ? $aResult : array();

        return $return;
    }

    public function getDBN() {
        return $this->dbn;
    }

}

?>
