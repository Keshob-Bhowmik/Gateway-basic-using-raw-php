


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

        <header class="flex flex-col items-center gap-3 bg-gray-300 py-4 rounded-sm">
            <img class="w-[50px]" src="../Task1/images/pst.png" alt="">
            <h1 class="font-semibold text-[30px]">PayStation</h1>
        </header>
        <div class="mt-1">

            <form action="first.php" method='POST'>
                <label for="name" class="font-bold text-[14px]">Name<span class="text-red-600">*</span></label>
                <input id="name" class="w-full  border border-gray-400 rounded-sm py-1 mb-2" type="text" name="name" required>
                <label for="phone" class="font-bold text-[14px]">Moble No <span class="text-red-600">*</span></label>
                <input id="phone" class="w-full  border border-gray-400 rounded-sm py-1" type="number" name="phone" required>
                <label for="amount" class="font-bold text-[14px]">Amount <span class="text-red-600">*</span></label>
                <input id="amount" class="w-full  border border-gray-400 rounded-sm py-1" type="number" name="amount" required>
                <div class="text-center mt-4">

                    <button class="bg-[#9B1FA8] w-[470px]  py-2 text-white font-semibold rounded-sm cursor-pointer" type="submit">Pay</button>
                    <button class="border bg-red-600 w-[470px]  py-2 font-semibold text-white mt-1 rounded-sm" type="reset">Cancel</button>
                    <button class=" border bg-green-500 w-[470px]  py-2 font-semibold text-white mt-1 rounded-sm" type="button">Go to Home</button>
                </div>
            </form>

        </div>
       



        <footer class="bg-gray-200 w-[470] py-2 rounded-md mt-3">
            <img class="w-[450px] mx-auto" src="../Task1/images/PS_banner_final.png" alt="">
        </footer>
    </main>
</body>

</html>