<!-- form of profile to update or not update -->
<?php
    session_start();
    require 'config/database.php';
    // get all phone number except current user
    $sql = "SELECT phone FROM user WHERE email != '{$_SESSION['user'][0]['email']}'";
    $result = mysqli_query($conn, $sql);
    $phones = [];
    while ($phone = mysqli_fetch_array($result)) {
        $phones[] = $phone['phone'];
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
    <title>Profile</title>
</head>
<body class="bg-[#f3f4f6] min-w-[360px]">
    <?php include './includes/navbar.php'; ?>
    <!-- form -->
    <div class="flex items-center justify-center mt-5">
        <form action="../phpActions/profileCheck.php" method="post" class="w-1/2 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-normal mb-2" for="email">
                    อีเมล
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none 
                focus:shadow-outline bg-gray-200" name="email" id="email" type="email" placeholder="อีเมล" value="<?php echo $_SESSION['user'][0]['email']; ?>" disabled>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-normal mb-2" for="password">
                    รหัสผ่าน
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none 
                focus:shadow-outline bg-gray-200" name="password" id="password" type="text" placeholder="รหัสผ่าน" value="<?php echo $_SESSION['user'][0]['password']; ?>" disabled>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-normal mb-2" for="phone">
                    หมายเลขโทรศัพท์
                </label>
                <!-- div to group input and button checkValidPhone -->
                <div class="flex gap-2">
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none 
                    focus:shadow-outline bg-gray-200" name="phone" id="phone" type="phone" placeholder="หมายเลขโทรศัพท์" value="<?php echo $_SESSION['user'][0]['phone']; ?>" disabled>
                    <button type="button" id="checkPhoneBtn" class="flex items-center text-white rounded-lg hover:bg-gray-100 bg-gray-300 
                        hover:text-amber-400 transition-all duration-300 ease-in-out justify-center group" onclick="checkValidPhone()" disabled>
                        <span class="text-sm">ตรวจสอบ</span>
                    </button>
                </div>
                
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-normal mb-2" for="fname">
                    ชื่อจริง
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none 
                focus:shadow-outline" name="fname" id="fname" type="text" placeholder="ชื่อจริง" value="<?php echo $_SESSION['user'][0]['fname']; ?>">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-normal mb-2" for="lname">
                    นามสกุล
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none 
                focus:shadow-outline" name="lname" id="lname" type="text" placeholder="นามสกุล" value="<?php echo $_SESSION['user'][0]['lname']; ?>">
            </div>
            <!-- insert image file -->
            <?php $userImg = $_SESSION['user'][0]['img'] == null ? "" : $_SESSION['user'][0]['img'];  ?>
            <div class="mb-4 relative">
                <label class="block text-gray-700 text-sm font-normal mb-2" for="image">
                    รูปภาพ
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none 
                focus:shadow-outline" name="image" id="image" type="file" placeholder="รูปภาพ">
                <div class="flex justify-between items-center">
                    <div class="flex gap-2 justify-between items-center">
                        <span class="absolute top-1 right-0 text-gray-500">นามสกุล .jpg, .png .gif เท่านั้น</span>
                        <?php if ($userImg != ""){
                            echo "<img class='inline w-9 h-9 rounded-full' src='./assets/photos/$userImg' alt='user photo'>
                                    <span>$userImg</span>";
                        }else {
                            echo "<span>ไม่มีรูปภาพ</span>";
                        }  ?>
                    </div>
                    <!-- clear image button -->
                    <button type="button" title="Clear Image" class="text-red-500 text-md" onclick="clearImage()">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" id="submitBtn" class="flex items-center p-2 text-red-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700
                    hover:text-amber-400 transition-all duration-300 ease-in-out justify-center group" disabled>
                    <!-- xmark icon -->
                    <i id="submitIcon" class="fa-solid fa-xmark"></i>
                    <span class="ms-3">อัพเดทข้อมูล</span>
                </button>
                <!-- button to enabled phone input -->
                <button type="button" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700
                    hover:text-amber-400 transition-all duration-300 ease-in-out justify-center group" onclick="enablePhone()">
                    <i class="fa-solid fa-plus"></i>
                    <span class="ms-3">อัพเดทหมายเลขโทรศัพท์</span>
                </button>
                <!-- button to enabled password input -->
                <button type="button" class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700
                    hover:text-amber-400 transition-all duration-300 ease-in-out justify-center group" onclick="enablePassword()">
                    <i class="fa-solid fa-plus"></i>
                    <span class="ms-3">อัพเดทรหัสผ่าน</span>
                </button>

                <!-- button back to previous page -->
                <a href="javascript:history.back()" class="flex items-center p-2 text-gray-500 rounded-lg bg-gray-300 hover:bg-red-600
                    hover:text-white transition-all duration-300 ease-in-out justify-center group">
                    <!-- back icon -->
                    <i class="fa-solid fa-arrow-left"></i>
                    <span class="ms-3">ย้อนกลับ</span>
                </a>
            </div>
        </form>
    </div>

    <script>

        // detect if anything change in fname input if same as before disable submit button else enable submit button
        document.getElementById('fname').addEventListener('input', function() {
            var submitBtn = document.getElementById('submitBtn');
            var submitIcon = document.getElementById('submitIcon');
            if (this.value == "<?php echo $_SESSION['user'][0]['fname']; ?>") {
                submitBtn.setAttribute('disabled', 'true');
                submitBtn.classList.remove('text-green-600');
                submitBtn.classList.add('text-red-500');
                // remove check icon
                submitIcon.classList.remove('fa-check');
                submitIcon.classList.add('fa-xmark');
                
            } else {
                submitBtn.removeAttribute('disabled');
                submitBtn.classList.remove('text-red-500');
                submitBtn.classList.add('text-green-600');
                submitIcon.classList.remove('fa-xmark');
                submitIcon.classList.add('fa-check');
            }
        });
        
        // detect if anything change in lname input if same as before disable submit button else enable submit button
        document.getElementById('lname').addEventListener('input', function() {
            var submitBtn = document.getElementById('submitBtn');
            var submitIcon = document.getElementById('submitIcon');
            if (this.value == "<?php echo $_SESSION['user'][0]['lname']; ?>") {
                submitBtn.setAttribute('disabled', 'true');
                submitBtn.classList.remove('text-green-600');
                submitBtn.classList.add('text-red-500');
                // remove check icon
                submitIcon.classList.remove('fa-check');
                submitIcon.classList.add('fa-xmark');
            } else {
                submitBtn.removeAttribute('disabled');
                submitBtn.classList.remove('text-red-500');
                submitBtn.classList.add('text-green-600');
                submitIcon.classList.remove('fa-xmark');
                submitIcon.classList.add('fa-check');
            }
        });

        function enablePassword() {
            var password = document.getElementById('password');
            password.removeAttribute('disabled');
            password.classList.remove('bg-gray-200');
            // set cursor to password input
            password.focus();
        }

        // check password input if same as before disable submit button else enable submit button
        document.getElementById('password').addEventListener('input', function() {
            var submitBtn = document.getElementById('submitBtn');
            var submitIcon = document.getElementById('submitIcon');
            if (this.value == "<?php echo $_SESSION['user'][0]['password']; ?>") {
                submitBtn.setAttribute('disabled', 'true');
                submitBtn.classList.remove('text-green-600');
                submitBtn.classList.add('text-red-500');
                // remove check icon
                submitIcon.classList.remove('fa-check');
                submitIcon.classList.add('fa-xmark');
            } else {
                submitBtn.removeAttribute('disabled');
                submitBtn.classList.remove('text-red-500');
                submitBtn.classList.add('text-green-600');
                submitIcon.classList.remove('fa-xmark');
                submitIcon.classList.add('fa-check');
            }
        });

        function enablePhone() {
            var phone = document.getElementById('phone');
            // enable check button
            var checkPhoneBtn = document.getElementById('checkPhoneBtn');
            checkPhoneBtn.removeAttribute('disabled');
            checkPhoneBtn.classList.remove('bg-gray-300');
            checkPhoneBtn.classList.add('bg-green-500');
            // enable phone input
            phone.removeAttribute('disabled');
            phone.classList.remove('bg-gray-200');
            // set cursor to phone input
            phone.focus();
        }

        function checkValidPhone() {
            var phone = document.getElementById('phone').value;
            var submitBtn = document.getElementById('submitBtn');
            var submitIcon = document.getElementById('submitIcon');
            var isSubmit = true;
            // check if phone is already exist
            if (phone != "") {
                // check if phone is valid
                if (phone.length == 10) {
                    // check if phone is number
                    if (!isNaN(phone)) {
                        // check if phone is same as before cancle button
                        if (phone == "<?php echo $_SESSION['user'][0]['phone']; ?>") {
                            isSubmit = false;
                            alert('หมายเลขโทรศัพท์เหมือนเดิม');
                        } else if (!<?php echo json_encode($phones); ?>.includes(phone)) {
                            isSubmit = true;
                            alert('หมายเลขโทรศัพท์ถูกต้อง');
                        } else {
                            isSubmit = false;
                            alert('หมายเลขโทรศัพท์นี้มีอยู่แล้ว');
                        }
                    } else {
                        isSubmit = false;
                        alert('หมายเลขโทรศัพท์ต้องเป็นตัวเลขเท่านั้น');
                    }
                } else {
                    isSubmit = false;
                    alert('หมายเลขโทรศัพท์ต้องมี 10 หลัก');
                }
            } else {
                isSubmit = false;
                alert('กรุณากรอกหมายเลขโทรศัพท์');
            }

            if (isSubmit) {
                submitBtn.removeAttribute('disabled');
                submitBtn.classList.remove('text-red-500');
                submitBtn.classList.add('text-green-600');
                submitIcon.classList.remove('fa-xmark');
                submitIcon.classList.add('fa-check');
            }else {
                submitBtn.setAttribute('disabled', 'true');
                submitBtn.classList.remove('text-green-600');
                submitBtn.classList.add('text-red-500');
                submitIcon.classList.remove('fa-check');
                submitIcon.classList.add('fa-xmark');
            }
        }

        // detect if anything change in image input if same as before disable submit button else enable submit button
        document.getElementById('image').addEventListener('change', function() {
            var submitBtn = document.getElementById('submitBtn');
            var submitIcon = document.getElementById('submitIcon');
            // remove C:\fakepath\ from image input
            console.log(this.value);
            let value = this.value.replace("C:\\fakepath\\", "");
            if (value == "<?php echo $_SESSION['user'][0]['img']; ?>") {
                submitBtn.setAttribute('disabled', 'true');
                submitBtn.classList.remove('text-green-600');
                submitBtn.classList.add('text-red-500');
                // remove check icon
                submitIcon.classList.remove('fa-check');
                submitIcon.classList.add('fa-xmark');
            }else if (value == "") {
                submitBtn.setAttribute('disabled', 'true');
                submitBtn.classList.remove('text-green-600');
                submitBtn.classList.add('text-red-500');
                // remove check icon
                submitIcon.classList.remove('fa-check');
                submitIcon.classList.add('fa-xmark');
            }else {
                submitBtn.removeAttribute('disabled');
                submitBtn.classList.remove('text-red-500');
                submitBtn.classList.add('text-green-600');
                submitIcon.classList.remove('fa-xmark');
                submitIcon.classList.add('fa-check');
            }
        });

        function clearImage() {
            var image = document.getElementById('image');
            var submitBtn = document.getElementById('submitBtn');
            var submitIcon = document.getElementById('submitIcon');
            image.value = "";
            submitBtn.setAttribute('disabled', 'true');
            submitBtn.classList.remove('text-green-600');
            submitBtn.classList.add('text-red-500');
            // remove check icon
            submitIcon.classList.remove('fa-check');
            submitIcon.classList.add('fa-xmark');
        }
    </script>
</body>
</html>
