<?php
class Database
{
    private $hostname;
    private $username;
    private $password;
    private $databasename;
    private $conn;

    public function __construct($hname, $uname, $password, $dbname)
    {
        $this->hostname = $hname;
        $this->username = $uname;
        $this->password = $password;
        $this->databasename = $dbname;
        $this->connection();
    }
    private function connection()
    {
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->databasename);
        if ($this->conn->connect_error) {
            die("connection failed: " . $this->conn->connect_error);
        }
        echo "connected successfully 123";
    }
    public function getConnection()
    {
        return $this->conn;
    }
    public function closeFunction()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>