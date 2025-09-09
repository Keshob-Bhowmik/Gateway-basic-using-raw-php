<?php
// $servername = 'localhost';
// $username = "root";
// $password = "";
// $databasename = "test11";

// $conn = new mysqli($servername, $username, $password, $databasename);
// if($conn->connect_error){
//     die("Connection failed: ". $conn->connect_error);
// }
// echo "Connected successfull";

// $conn->close();

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
$db = new Database("localhost", "root", "", "test11");
$amount = 0;
$name;
$phone;
$cardnumber;
$month;
$year;
$cvv;
$cardholdername;
$savefornext;
$status;
$last_id;
$cardWarning = "";
$user = new User();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    if ($id) {

        $cardnumber = $_POST['card-number'];
        if (strlen($cardnumber) < 16 || strlen($cardnumber) > 16) {
            $cardWarning = "You have to put exactly 16 digits";
            $user->cardNumbervalidate();
        } else {
            $month = $_POST['mm'];
            $year = $_POST['YY'];
            $cvv = $_POST['cvv'];
            $cardholdername = $_POST['card-holder'];
            $savefornext = isset($_POST['savefornext']) ? 1 : 0;
            $status = 1;
            $user->update($cardnumber, $month, $year, $cvv, $cardholdername, $savefornext, $status, $id);
        }
    } else {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $amount = $_POST['amount'];
        $last_id = $user->insert($name, $phone, $amount);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <main class="border border-gray-300 shadow-xl shadow-gray-700 h-auto w-[501px] mx-auto mt-6 py-3">
        <header class="flex justify-between items-center mx-auto w-[470px]">
            <img class="h-[20px] w-[20px]" src="/images/icons8-play-30.png" alt="">
            <p class="font-semibold text-[#9B1FA8]">Payment</p>
            <img class="h-[20px] w-[20px]" src="images/icons8-cross-48.png" alt="">
        </header>

        <div class="profile flex justify-start gap-6 items-center  w-[470px] mx-auto bg-gray-200 py-1 px-1 rounded-md mt-2">
            <div class="h-[70px] w-[70px] border border-gray-100 bg-gray-400 rounded-full relative">
                <img class="w-[30px] h-[30px] absolute top-5 right-5" src="images/images__1_-removebg-preview.png" alt=" ">
            </div>
            <div>
                <h3 class="font-semibold">PAYSTATION</h3>
                <p class="text-gray-500">invoice: 88888</p>
            </div>
        </div>

        <div class="border border-dashed mt-3 border-gray-400  w-[470px] mx-auto">
        </div>

        <div class="card-information mt-4 w-[470px] mx-auto">
            <h1 class="text-[#9B1FA8] font-semibold bg-gray-200 py-2 text-center ">Card Information</h1>
            <div class="flex justify-start gap-3 mt-3">
                <img class="w-[70px] h-[50px] border" src="images/mastercard-symbol-02.jpg" alt="">
                <img class="w-[70px] h-[50px] shadow-sm shadow-gray-400" src="images/images.png" alt="">
            </div>
        </div>

        <div class="card-information-form w-[500px] mx-auto mt-5 bg-gray-200 py-4 px-4">
            <form action="" method='POST'>
                <input type="hidden" name='id' value="<?php echo $last_id ?? ''; ?>">
                <input id="card-number" class="border w-full px-3 py-2 bg-white rounded-sm" type="text" placeholder="card-number" name="card-number" required>
                <h1 id="cardNumberWarning" class="text-red-600 font-semibold">
                    <?php
                    if (strlen($cardWarning)) {
                        echo $cardWarning;
                    } else {
                        echo "";
                    }
                    ?>
                </h1>
                <div class="flex justify-between mt-3">
                    <input id="mm" class="border w-[100px] h-[30px] text-center bg-white rounded-sm" type="number" name="mm" placeholder="MM" required>
                    <input id="YY" class="border w-[100px] h-[30px] text-center bg-white rounded-sm" type="text" name="YY" placeholder="YY" required>
                    <input id="cvv" class="border w-[100px] h-[30px] text-center bg-white rounded-sm" type="text" name="cvv" placeholder="CVV" required>
                </div>
                <input id="card-holder" class="border w-full px-3 py-2 mt-3 bg-white rounded-sm" type="text" placeholder="Card holder Name" name="card-holder" required>
                <div class="flex justify-between mt-3">
                    <div class="flex justify-start gap-2">
                        <input id="nextPayment" type="checkbox" name="savefornext">
                        <label for="nextPayment" class="text-[14px] font-semibold">Save for next payment</label>
                    </div>
                    <p class="text-blue-600 font-semibold text-[14px]">Terms & Conditions</p>
                </div>
                <div class="text-center mt-4">

                    <button class="bg-[#9B1FA8] w-[470px]  py-1 text-white font-semibold rounded-sm" type="submit">
                        <?php
                        if ($amount > 0) {
                            echo "Pay BDT $amount Taka";
                        } else {
                            echo "Pay";
                        }
                        ?>
                    </button>
                    <button class="bg-white border border-[#9B1FA8] w-[470px]  py-1 font-semibold text-gray-400 mt-4 rounded-sm" type="submit">Cancel</button>

                </div>
            </form>

        </div>

        <div class="border border-dashed mt-3 border-gray-400  w-[470px] mx-auto">
        </div>

        <div class="w-[470px] mx-auto">
            <h1 class="text-[13px]">By clicking Pay, you agree to our <span class="text-blue-600 font-semibold text-[13px]">Terms & Conditions</span></h1>
        </div>
        <div class="flex justify-end items-center gap-3 w-[470px] mx-auto mt-3">
            <p class="text-[13px] text-gray-400 font-semibold">Powered by</p>
            <img class="w-[20px] h-[20px]" src="images/images (1).png" alt="">
        </div>
    </main>

    <script src="app.js"></script>
</body>

</html>