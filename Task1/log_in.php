<?php
session_start();
require 'database.php';
require 'user.php';
class log_in
{
    private $db;
    function __construct()
    {
        $database = new Database("localhost", "root", "", "test11");
        $this->db = $database->getConnection();
    }

    function log_in_validate($email, $password)
    {
        $user = $this->email_validate($email);
        var_dump($user);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['useremail'] = $user['email'];
                header("Location: lists.php");
                exit();
            } else {
                return "Invalid email or password";
            }
        } else {
            return "Invalid email or password";
        }
    }

    function email_validate($email)
    {
        $sql = "    SELECT *
    FROM registration
    WHERE email = '$email'";
        $res = $this->db->query($sql);
        if ($res && $res->num_rows > 0) {
            return $res->fetch_assoc();
        } else {
            return null;
        }
    }
}
$user = new log_in();
$error = "";
$l_email = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $l_email = $_POST['l_email'];
    $l_password = $_POST['l_password'];
    $error = $user->log_in_validate($l_email, $l_password);
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
        <h1 class="text-center text-[22px] text-purple-700 font-semibold">Welcome</h1>
        <p class="text-center font-semibold">Log in to your Account</p>
        <form action="" method="POST">
            <h1>
                <?php
                echo $error;
                ?>
            </h1>
            <label class="text-[18px] font-semibold" for="email_phone">Email</label>
            <input class="w-full border py-1 mb-2" type="email" id="l_email" name="l_email" required>
            <label class="text-[18px] font-semibold" for="password"> Password</label>
            <input class="w-full border py-1" type="password" id="l_password" name="l_password" required>
            <div class="flex justify-between mt-3">
                <div class="flex justify-start gap-2">
                    <input id="nextPayment" type="checkbox" name="rememberAccount">
                    <label for="nextPayment" class="text-[14px] font-semibold">Remember my account</label>
                </div>
                <p class="text-purple-500 font-semibold text-[14px]">Forgot password?</p>

            </div>
            <button class="bg-purple-700 text-white font-semibold w-[100px] py-1 mx-auto rounded-sm flex justify-center items-center" type="submit">Log In</button>
        </form>
    </main>
</body>

</html>