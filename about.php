<?php
    session_start();
    require 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/8fd7a24457.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>Add Type</title>
</head>
<body class="bg-[#f3f4f6] min-w-[360px]">
    <?php include './includes/navbar.php'; ?>
    <div class="flex items-center justify-center mt-5 mb-5">
        <h1 class="text-3xl font-semibold text-gray-700">รายชื่อสมาชิกกลุ่ม</h1>
    </div>
    <div class="flex items-center gap-4 py-2 px-4 border-t border-x hover:bg-gray-100 hover:text-black transition-all text-lg ">
        <div class="w-1/3 flex justify-center items-center">
            <img src="https://media.discordapp.net/attachments/1212393976049438740/1212995011046670356/image.png?ex=65f3dca2&is=65e167a2&hm=c20c722e9bbf38c97011d425b9510f2d61c3785c4260dcffc814e3dafed7f4fa&=&format=webp&quality=lossless&width=253&height=338" class="w-60 h-60 object-cover rounded-md">
        </div>
        <div class="w-1/3 ">Name : Chirawat Yana</div>
        <div class="w-1/3 ">Sutent ID : 6506021611017</div>
    </div>
    <div class="flex items-center gap-4 py-2 px-4 border-t border-x hover:bg-gray-100 hover:text-black transition-all text-lg ">
        <div class="w-1/3 flex justify-center items-center">
            <img src="https://media.discordapp.net/attachments/865440070487638016/1213006343863017492/IMG20230807162209.jpg?ex=65f3e730&is=65e17230&hm=d3387e74bbb31fffe5ef43cb70e3226e8f7b0e291ec88787386868bf1f289332&=&format=webp&width=254&height=338" class="w-60 h-60 object-cover rounded-md">
        </div>
        <div class="w-1/3 ">Name : Parinthonr Sutthikhun</div>
        <div class="w-1/3 ">Sutent ID : 6506021621080</div>
    </div>
    <div class="flex items-center gap-4 py-2 px-4 border-t border-x hover:bg-gray-100 hover:text-black transition-all text-lg ">
        <div class="w-1/3 flex justify-center items-center">
            <img src="https://media.discordapp.net/attachments/865440070487638016/1215950512159981648/103528.jpg?ex=65fe9d29&is=65ec2829&hm=cdc946c9ee129cf72fdfa77397c7d5d9bc654447ccdc0e9ce7221be2d8b2f99d&=&format=webp&width=376&height=662" class="w-60 h-60 object-cover rounded-md">
        </div>
        <div class="w-1/3 ">Name : Kittipong Srisuk</div>
        <div class="w-1/3 ">Sutent ID : 6506021621195</div>
    </div>
    <div class="flex items-center gap-4 py-2 px-4 border-t border-x hover:bg-gray-100 hover:text-black transition-all text-lg ">
        <div class="w-1/3 flex justify-center items-center">
            <img src="https://scontent.fbkk5-5.fna.fbcdn.net/v/t1.15752-9/429112150_3387546764876411_8642987010619854886_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=8cd0a2&_nc_eui2=AeE20vGvJYwIVPfB9rk8c4n0WEBL-N8JqYtYQEv43wmpiy0bET04QJGqTmIDIfSbabVxUAD3xgAIRv5uBVTTiVSo&_nc_ohc=kh0mD5vg8bgAX9ZbJgw&_nc_ht=scontent.fbkk5-5.fna&oh=03_AdR4VHPLGCF9HnjtdiQ0FS1DgkonWrcSeRWHnS0YaKz9Pw&oe=6608C48C" class="w-60 h-60 object-cover rounded-md">
        </div>
        <div class="w-1/3 ">Name : Parsinee Phanpha</div>
        <div class="w-1/3 ">Sutent ID : 6506021631026</div>
    </div>
    <div class="flex items-center gap-4 py-2 px-4 border-t border-x hover:bg-gray-100 hover:text-black transition-all text-lg ">
        <div class="w-1/3 flex justify-center items-center">
            <img src="https://scontent.fbkk5-4.fna.fbcdn.net/v/t1.15752-9/423454838_939017657588929_5062688350078785801_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=8cd0a2&_nc_eui2=AeFfK4mxuNnXd2Dg3TSlxX5SCkXpAF3_WJsKRekAXf9Ym8eaLLsPNy4w_FnVFPVvWfL6Vwucuo4Hhirg6dsp9PXr&_nc_ohc=SClmQXmCIAEAX-xUWq5&_nc_ht=scontent.fbkk5-4.fna&oh=03_AdTpPyTRkgXDOXlybnPb9Er3zClKHb-1zmDFlF02Nur8mw&oe=6608E4B2" class="w-60 h-60 object-cover rounded-md">
        </div>
        <div class="w-1/3 ">Name : Arunkamon Nukaew</div>
        <div class="w-1/3 ">Sutent ID : 6506021631034</div>
    </div>
    
    
</body>
</html>
