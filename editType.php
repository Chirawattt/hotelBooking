<!-- form of profile to update or not update -->
<?php
    session_start();
    require 'config/database.php';
    $typeId = $_GET['id'];
    $sql = "SELECT * FROM type_room WHERE id = $typeId";
    $result = mysqli_query($conn, $sql);
    $typeData = mysqli_fetch_array($result);

    // query to get all type room for check if the type name is already exist
    $sql = "SELECT name FROM type_room";
    $result = mysqli_query($conn, $sql);
    $typesData = [];
    while ($type = mysqli_fetch_array($result)) {
        $typesData[] = $type['name'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8fd7a24457.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>Edit Type</title>
</head>
<body class="bg-[#f3f4f6] min-w-[360px]">
    <?php include './includes/navbar.php'; ?>
    <!-- form -->
    <div class="flex items-center justify-center mt-5">
        <h1 class="text-3xl font-semibold text-gray-700">แก้ไขข้อมูลประเภทห้องพัก</h1>
    </div>
    <div class="flex items-center justify-center mt-5">
        <form action="phpActions/editTypeCheck.php" method="post" enctype="multipart/form-data" class="w-full max-w-lg bg-white p-8 rounded-lg shadow-md">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="typeName" class="text-sm">ชื่อประเภทห้องพัก</label>
                    <div class="flex justify-between gap-1">
                        <input type="text" name="typeName" id="typeName" class="w-[80%] p-2 border border-gray-300 rounded mt-1" value="<?php echo $typeData['name']; ?>" autofocus>
                        <!-- button to check data input -->
                        <button type="button" class="w-[20%] text-sm  rounded bg-green-600 text-white hover:bg-gray-400 transition-all duration-300 ease-in-out" onClick="checkTypeName()">ตรวจสอบ</button>
                    </div>
                    <!-- p tag for alertMessage -->
                    <p id="alertMessage" class="text-red-500 text-sm hidden">ชื่อประเภทห้องพักนี้มีอยู่แล้ว</p>
                </div>
                <div class="flex items center justify-center">
                    <!-- send room id for easy to specify where to update -->
                    <input type="hidden" name="typeId" value="<?php echo $typeData['id']; ?>">
                    <!-- button type reset to reset data in form-->
                    <button type="reset" class="w-full py-2 px-4 bg-gray-300 text-gray-700 hover:bg-gray-400 transition-all duration-300 ease-in-out" onClick="window.location.reload()">ล้างข้อมูล</button>
                    <button type="submit" id="submitBtn" class="w-full py-2 px-4 bg-gray-300 text-gray-700 cursor-not-allowed transition-all duration-300 ease-in-out" disabled>แก้ไขข้อมูล</button>
                </div>
                <!-- back button with back icon -->
                <div class="flex items-center justify-center mt-3">
                    <a href="javascript:history.back()" class="flex items-center gap-2 text-gray-500 hover:text-gray-700 transition-all duration-300 ease-in-out">
                        <i class="fas fa-chevron-left"></i>
                        <span>ย้อนกลับ</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
    <script> 
        const submitBtn = document.getElementById('submitBtn');
        // funciton to disable submit button
        function disableSubmitBtn() {
            submitBtn.setAttribute('disabled', true);
            submitBtn.classList.remove('bg-gray-800', 'text-white', 'hover:bg-gray-700');
            submitBtn.classList.add('bg-gray-300', 'text-gray-700', 'cursor-not-allowed');
        }
        // function to enable submit button
        function enableSubmitBtn() {
            submitBtn.removeAttribute('disabled');
            submitBtn.classList.remove('bg-gray-300', 'text-gray-700', 'cursor-not-allowed');
            submitBtn.classList.add('bg-gray-800', 'text-white', 'hover:bg-gray-700');
        }

        const typeName = document.getElementById('typeName');
        const alertMessage = document.getElementById('alertMessage');
        
        // function to check if the type name is already exist
        function checkTypeName() {
            const typesData = <?php echo json_encode($typesData); ?>;

            if (typeName.value === '') {
                alertMessage.textContent = "กรุณากรอกชื่อประเภทห้องพัก";
                alertMessage.classList.remove('hidden');
                disableSubmitBtn();
            }else if (typeName.value === '<?php echo $typeData['name']; ?>') {
                alertMessage.textContent = "ชื่อประเภทห้องเดิม";
                alertMessage.classList.remove('text-green-500');
                alertMessage.classList.add('text-red-500');
                alertMessage.classList.remove('hidden');
                disableSubmitBtn();
            }
            else if (typesData.includes(typeName.value)) {
                alertMessage.classList.remove('hidden');
                disableSubmitBtn();
            } else {
                // change text display to "can use this type name"
                alertMessage.textContent = "สามารถใช้ชื่อประเภทห้องพักนี้ได้";
                alertMessage.classList.remove('text-red-500');
                alertMessage.classList.add('text-green-500');
                enableSubmitBtn();
            }
        }

    </script>
</body>
</html>
