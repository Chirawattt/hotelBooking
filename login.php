<?php
    session_start(); // Start the session and store the session data
    session_destroy(); // Destroy the session and all data in the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/8fd7a24457.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>Login</title>
</head>
<body>

<form action="./phpActions/loginCheck.php" method="post" class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1 items-center">
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
            <div class=" flex flex-col items-center">
                <h1 class="text-2xl xl:text-3xl font-extrabold">
                    เข้าสู่ระบบ
                </h1>
                <div class="w-full flex-1 mt-8">

                    <div class="mx-auto max-w-xs">
                        <input
                            class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                            id="email" name="email" type="email" placeholder="อีเมล" required autofocus/>
                        <input
                            class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                            id="password" name="password" type="password" placeholder="รหัสผ่าน" required/>

                        <button
                            class="mt-5 tracking-wide font-semibold bg-slate-800 text-gray-100 w-full py-4 rounded-lg hover:bg-slate-950 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span class="ml-3">
                                เข้าสู่ระบบ
                            </span>
                        </button>
                        <p class="mt-6 text-xs text-gray-600 text-center">
                            ไม่มีบัญชี?
                            <a href="register.php" class="border-b border-gray-500 border-dotted">
                                สมัครสมาชิก
                            </a>
                            มีบัญชีอยู่แล้ว?
                            <a href="#" class="border-b border-gray-500 border-dotted">
                                ลืมรหัสผ่าน?
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-full flex-1 bg-indigo-100 text-center hidden lg:flex">
            <div class="w-full bg-contain bg-center bg-no-repeat bg-cover"
                style="background-image: url('https://images.unsplash.com/photo-1496417263034-38ec4f0b665a?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
            </div>
        </div>
    </div>
</form>

</body>
</html>