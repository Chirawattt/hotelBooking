<!-- โค้ดสำหรับการลงทะเบียนผู้ใช้งาน -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>Register</title>
</head>
<body>

<form action="./phpActions/registerCheck.php" method="post" class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1 items-center">
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
            <div class=" flex flex-col items-center">
                <h1 class="text-2xl xl:text-3xl font-extrabold">
                    ลงทะเบียน
                </h1>
                <div class="w-full flex-1 mt-8">

                    <div class="mx-auto max-w-xs">
                        <input
                            class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                            id="email" name="email" type="email" placeholder="อีเมล" required autofocus/>
                        <input
                            class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                            id="password" name="password" type="password" placeholder="รหัสผ่าน" required/>
                        <input
                            class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                            id="password2" name="password2" type="password" placeholder="ยืนยันรหัสผ่าน" required/>
                        <input
                            class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                            id="phone" name="phone" type="phone" placeholder="หมายเลขโทรศัพท์ (0123456789)" required/>
                        <input
                            class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                            id="fname" name="fname" type="text" placeholder="ชื่อจริง" required/>
                        <input
                            class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                            id="lname" name="lname" type="text" placeholder="นามสกุล" required/>
                        
                        
                        <button
                            class="mt-5 tracking-wide font-semibold bg-slate-800 text-gray-100 w-full py-4 rounded-lg hover:bg-slate-950 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                            <svg class="w-6 h-6 -ml-2" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="8.5" cy="7" r="4" />
                                <path d="M20 8v6M23 11h-6" />
                            </svg>
                            <span class="ml-3">
                                ลงทะเบียน
                            </span>
                        </button>
                        <p class="mt-6 text-xs text-gray-600 text-center">
                            มีบัญชีอยู่แล้ว?
                            <a href="login.php" class="border-b border-gray-500 border-dotted">
                                เข้าสู่ระบบ
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-full flex-1 bg-indigo-100 text-center hidden lg:flex">
            <div class="w-full bg-contain bg-center bg-no-repeat bg-cover"
                style="background-image: url('https://images.pexels.com/photos/189296/pexels-photo-189296.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
            </div>
        </div>
    </div>
</form>



</body>
</html>