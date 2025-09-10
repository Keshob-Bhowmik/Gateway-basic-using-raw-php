<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: log_in.php');
    exit();
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
    function get__data()
    {
        $sql = "SELECT * from payments";
        $result = $this->db->query($sql);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }
}
$getData = new get_data();
$data = $getData->get__data();
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
    <main class="border border-gray-300 shadow-xl shadow-gray-700 h-auto w-[1200px] mx-auto mt-6 py-3 px-3">
        <header class="flex justify-between items-center gap-3 bg-gray-300 py-4 rounded-sm px-2">
            <div class="flex justify-start gap-2 items-center">
                <img class="w-[30px]" src="../Task1/images/pst.png" alt="">
                <h1 class="font-semibold text-[20px]">PayStation</h1>
            </div>
            <div class="flex justify-between items-center gap-2">
                <h1><?=
                $_SESSION['username'];
                
                ?></h1>
                <a href="log_out.php" class="bg-red-600 px-2 text-white font-semibold rounded-sm">Log out</a>
            </div>
        </header>
        <div>
            <h1 class="text-center font-bold text-[28px] mt-4">Paymet List</h1>
        </div>
        <table class="w-full border mt-4">
            <thead class="border">
                <tr class="border">
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Card Number</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>CVV</th>
                    <th>Card Holder Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($data as $row) : ?>
                    <tr class="border">
                        <td class="px-2 py-1 border"><?= $row['name'] ?></td>
                        <td class="px-2 py-1 border"><?= $row['amount'] ?></td>
                        <td class="px-2 py-1 border"><?= $row['card_number'] ?></td>
                        <td class="px-2 py-1 border"><?= $row['month'] ?></td>
                        <td class="px-2 py-1 border"><?= $row['year'] ?></td>
                        <td class="px-2 py-1 border"><?= $row['cvv'] ?></td>
                        <td class="px-2 py-1 border"><?= $row['card_holder_name'] ?></td>
                        <td class="px-2 py-1 border"><?= $row['status'] ?></td>
                        <td class="px-2 py-1 border">
                            <a href="update.php?id=<?php echo $row['id']?>" class="bg-purple-400 px-1  text-white">Edit</a>
                            <button class="bg-red-500 text-white px-1">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </main>
</body>

</html>