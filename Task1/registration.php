<?php
require 'user.php';
require 'database.php';
class registration
{
    private $db;
    function __construct()
    {
        $database = new Database("localhost", "root", "", "test11");
        $this->db = $database->getConnection();
    }
    function validate($email, $password, $confirm_password, $name)
    {
        if (strlen($password) > 7) {
            if ($password == $confirm_password) {
                $hash_pass = password_hash($password, PASSWORD_DEFAULT);
                $this->reg_insert($email, $hash_pass, $name);
                header("Location: log_in.php");
                exit();
            } else {
                return "Password do not match";
            }
        } else {
            return "Password should contain atleast 8 characters";
        }
    }

    function reg_insert($email, $hash_pass, $name)
    {
        $sql = "INSERT INTO registration (name,email, password) VALUES ('$name','$email', '$hash_pass')";
        if ($this->db->query($sql) === true) {
            echo "Inserted! ID: " . $this->db->insert_id;
            return $this->db->insert_id;
        } else {
            echo "Error inserting: " . $this->db->error;
        }
    }
}
$reg_user = new registration();
$email = "";
$error = "";
$name = "";
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $name = $_POST['name'];
    
    $error = $reg_user->validate($email, $password, $confirm_password, $name);
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
    <main class="border border-gray-300 shadow-xl shadow-gray-700 h-auto w-[501px] mx-auto mt-6 py-3 px-3">
        <!-- <h1 class="text-center text-[22px] text-purple-700 font-semibold">Welcome</h1> -->
        <p class="text-center font-semibold text-[22px] text-purple-700">Register YourSelf</p>
        <form action="" method="POST">

            <label class="text-[18px] font-semibold" for="name">Name</label>
            <input class="w-full border py-1 mb-2 px-2" type="text" id="name" name="name" required>
            <label class="text-[18px] font-semibold" for="email_phone">Email</label>
            <input class="w-full border py-1 mb-2 px-2" type="email" id="email" name="email" required>

            <label class="text-[18px] font-semibold" for="password"> Password</label>
            <input class="w-full border py-1 px-2" type="password" id="password" name="password" required>
            <h1>
                <?php
                echo $error;
                ?>
            </h1>

            <label class="text-[18px] font-semibold mt-2" for="confirm_password">Confirm Password</label>
            <input class="w-full border py-1 px-2" type="password" id="confirm_password" name="confirm_password" required>

            <button class="bg-purple-700 text-white font-semibold w-[100px] py-1 mx-auto rounded-sm flex justify-center items-center mt-3" type="submit">Sign In</button>
        </form>
    </main>
</body>

</html>