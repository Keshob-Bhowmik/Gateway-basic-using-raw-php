<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: log_in.php');
    exit();
}
$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
require 'database.php';
class get_data
{
    private $db;
    function __construct()
    {
        $database = new Database("localhost", "root", "", "test11");
        $this->db = $database->getConnection();
    }
    function get__data($id)
    {
        $sql = "SELECT * from payments where id = $id";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows > 0) {
            $result = $result->fetch_assoc();
            print_r($result);
            return $result;
        }
        return null;
    }
    public function update($name,$phone,$amount,$cardnumber, $month, $year, $cvv, $cardholdername, $id)
    {
        echo $id;
        $sql = "UPDATE payments SET 
    name = '$name',
    phone = '$phone',
    amount = '$amount',
    card_number = '$cardnumber', 
    month = $month, 
    year = $year, 
    cvv = $cvv, 
    card_holder_name = '$cardholdername'
    WHERE id = $id";
        if ($this->db->query($sql) === true) {

            echo "<h1 class='text-green-700'>update successfull</h1>";
            header("Location: lists.php");
            exit();
        } else {
            echo "Error" . $this->db->error;
        }
    }
}

$getData = new get_data();
$result = $getData->get__data($id);
$amount = 0;
$name = "";
$phone = "";
$cardnumber = "";
$month = 0;
$year = 0;
$cvv = 0;
$cardholdername = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_post = $_POST['id']; 
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $amount = $_POST['amount'];
    $month = $_POST['mm'];
    $year = $_POST['YY'];
    $cvv = $_POST['cvv'];
    $cardholdername = $_POST['card-holder'];
    $cardnumber = $_POST['card-number'];
    $getData->update($name,$phone,$amount,$cardnumber, $month, $year, $cvv, $cardholdername, $id_post);

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
    <div class="card-information-form w-[500px] mx-auto mt-5 bg-gray-200 py-4 px-4">
        <h1 class="text-[28px] font-bold text-center">Edit</h1>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label for="name" class="font-bold text-[14px]">Name<span class="text-red-600">*</span></label>
            <input id="name" class="w-full  border border-gray-400 rounded-sm py-1 mb-2" type="text" name="name" value="<?= $result ? $result['name'] : '' ?>" required>
            <label for="phone" class="font-bold text-[14px]">Moble No <span class="text-red-600">*</span></label>
            <input id="phone" class="w-full  border border-gray-400 rounded-sm py-1" type="number" name="phone" value="<?= $result ? $result['phone'] : '' ?>" required> required>
            <label for="amount" class="font-bold text-[14px]">Amount <span class="text-red-600">*</span></label>
            <input id="amount" class="w-full  border border-gray-400 rounded-sm py-1 mb-2" type="number" name="amount" value="<?= $result ? $result['amount'] : '' ?>" required>

            <input id="card-number" class="border w-full px-3 py-2 bg-white rounded-sm" type="text" placeholder="card-number" name="card-number" value="<?= $result ? $result['card_number'] : '' ?>" required>

            <div class="flex justify-between mt-3">
                <input id="mm" class="border w-[100px] h-[30px] text-center bg-white rounded-sm" type="number" name="mm" placeholder="MM" value="<?= $result ? $result['month'] : '' ?>" required>
                <input id="YY" class="border w-[100px] h-[30px] text-center bg-white rounded-sm" type="text" name="YY" placeholder="YY" value="<?= $result ? $result['year'] : '' ?>" required>
                <input id="cvv" class="border w-[100px] h-[30px] text-center bg-white rounded-sm" type="text" name="cvv" placeholder="CVV" value="<?= $result ? $result['cvv'] : '' ?>" required>
            </div>
            <input id="card-holder" class="border w-full px-3 py-2 mt-3 bg-white rounded-sm" type="text" placeholder="Card holder Name" name="card-holder" value="<?= $result ? $result['card_holder_name'] : '' ?>" required>

            <div class="text-center mt-4">

                <button class="bg-[#9B1FA8] w-[470px] block  py-1 text-white font-semibold rounded-sm" type="submit">
                    update
                </button>
                <button class="bg-white border border-[#9B1FA8] w-[470px]  py-1 font-semibold text-gray-400 mt-4 rounded-sm" type="submit">Cancel</button>

            </div>
        </form>
    </div>
</body>

</html>