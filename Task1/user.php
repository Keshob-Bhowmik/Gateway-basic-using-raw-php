<?php
class User
{
    private $db;
    public $name;
    public $phone;
    public $amount;
    function __construct()
    {
        $database = new Database("localhost", "root", "", "test11");
        $this->db = $database->getConnection();
    }
    public function insert($name, $phone, $amount)
    {
        $sql = "INSERT into payments (name, phone, amount) values('$name', '$phone', '$amount')";
        echo "SQL: $sql <br>";

        if ($this->db->query($sql) === true) {
            echo "record inserted successfully";
            return $this->db->insert_id;
        } else {
            echo "error" . $this->db->error;
        }
    }
    public function update($cardnumber, $month, $year, $cvv, $cardholdername, $savefornext, $status, $id)
    {
        echo $id;
        $sql = "UPDATE payments SET 
    card_number = '$cardnumber', 
    month = $month, 
    year = $year, 
    cvv = $cvv, 
    card_holder_name = '$cardholdername', 
    save_for_next_payment = $savefornext, 
    status = $status
    WHERE id = $id";
        if ($this->db->query($sql) === true) {
            echo "<h1 class='text-green-700'>Payment successfull</h1>";
        } else {
            echo "Error" . $this->db->error;
        }
    }
    public function cardNumbervalidate()
    {
        echo "card number must be in 16 digits";
    }
}
?>