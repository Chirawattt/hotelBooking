<!-- form of profile to update or not update -->
<?php
    session_start();
    require 'config/database.php';
    $roomId = $_GET['id'];
    $sql = "SELECT * FROM room WHERE id = $roomId";
    $result = mysqli_query($conn, $sql);
    $roomData = mysqli_fetch_array($result);

    $sql = "SELECT * FROM type_room";
    $result = mysqli_query($conn, $sql);
    $typesData = [];
    while ($type = mysqli_fetch_array($result)) {
        $typesData[] = $type;
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
    <title>Edit Room</title>
</head>
<body class="bg-[#f3f4f6] min-w-[360px]">
    <?php include './includes/navbar.php'; ?>
    <!-- form -->
    <div class="flex items-center justify-center mt-5">
        <h1 class="text-3xl font-semibold text-gray-700">แก้ไขข้อมูลห้องพัก</h1>
    </div>
    <div class="flex items-center justify-center mt-5">
        <form action="phpActions/editRoomCheck.php" method="post" enctype="multipart/form-data" class="w-full max-w-lg bg-white p-8 rounded-lg shadow-md">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="roomName" class="text-sm">ชื่อห้องพัก</label>
                    <input type="text" name="roomName" id="roomName" class="w-full p-2 border border-gray-300 rounded mt-1" value="<?php echo $roomData['name']; ?>" autofocus>
                </div>
                <div>
                    <label for="typeId" class="text-sm">ประเภทห้องพัก</label>
                    <select name="typeId" id="typeId" class="w-full p-2 border border-gray-300 rounded mt-1">
                        <?php foreach ($typesData as $type) { ?>
                            <?php if ($type['id'] == $roomData['type_id']) {
                                echo "<option value='".$type['id']."' selected>".$type['name']."</option>";
                            } else {
                                echo "<option value='".$type['id']."'>".$type['name']."</option>";
                            }
                        }?>
                    </select>
                    <!-- alertType -->
                    <p id="alertType" class="text-red-500 text-sm hidden">คุณเลือกประเภทห้องพักอันเดิม</p>
                </div>
                <div>
                    <label for="roomDetail" class="text-sm">รายละเอียด</label>
                    <textarea name="roomDetail" id="roomDetail" class="w-full p-2 border border-gray-300 rounded mt-1"><?php echo $roomData['detail']; ?></textarea>
                </div>
                <div>
                    <label for="roomAmenities" class="text-sm">สิ่งอำนวยความสะดวก</label>
                    <textarea name="roomAmenities" id="roomAmenities" class="w-full p-2 border border-gray-300 rounded mt-1"><?php echo $roomData['facility']; ?></textarea>
                </div>
                <div class="relative">
                    <label for="maxGuest" class="text-sm">จำนวนผู้เข้าพักสูงสุด</label>
                    <input type="number" name="maxGuest" id="maxGuest" class="w-full p-2 border border-gray-300 rounded mt-1" min="1" max="10" value="<?php echo $roomData['max_people']; ?>">
                    <span id="alertMaxGuest" class="hidden text-sm text-red-500 transition-all duration-300 ease-in-out">จำนวนตัวเลขไม่ถูกต้อง</span>
                </div>
                <div>
                    <label for="price" class="text-sm">ราคา/คืน (฿)</label>
                    <input type="number" name="price" id="price" class="w-full p-2 border border-gray-300 rounded mt-1" min="500" max="20000" step="100" value="<?php echo $roomData['price']; ?>">
                    <span id="alertPrice" class="hidden text-sm text-red-500 transition-all duration-300 ease-in-out">จำนวนตัวเลขไม่ถูกต้อง</span>
                </div>
                <?php $roomImg = $roomData['img'] != null ? $roomData['img'] : null ?>
                <div class="relative">
                    <label for="roomImage" class="text-sm">รูปภาพห้องพัก</label>
                    <input type="file" name="roomImage" id="roomImage" class="w-full p-2 border border-gray-300 rounded mt-1">
                    <div class="flex justify-between items-center">
                        <div class="flex gap-2 justify-between items-center">
                            <span class="absolute top-1 right-0 text-gray-500">นามสกุล .jpg .png เท่านั้น</span>
                        </div>
                    </div>
                    <?php if ($roomImg != null){
                            echo "<img class='inline w-42 h-42 rounded-sm' src='./assets/photos/$roomImg' alt='user photo'>
                                    <p>$roomImg</p>";
                        }else {
                            echo "<p>ไม่มีรูปภาพ</p>";
                        }  ?>
                </div>
                <div>
                    <label for="roomStatus" class="text-sm">สถานะ</label>
                    <select name="roomStatus" id="roomStatus" class="w-full p-2 border border-gray-300 rounded mt-1">
                        <?php if ($roomData['status'] == 'available') {
                            echo "<option value='available' selected>ว่าง</option>
                            <option value='unavailable'>ไม่ว่าง</option>";
                        } else {
                            echo "<option value='available'>ว่าง</option>
                            <option value='unavailable' selected>ไม่ว่าง</option>";
                        } ?>
                    </select>
                </div>
                <div class="flex items center justify-center">
                    <!-- send room id for easy to specify where to update -->
                    <input type="hidden" name="roomId" value="<?php echo $roomData['id']; ?>">
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

        // event listener to check if roomName input value is equal to the original value
        const roomName = document.getElementById('roomName');
        roomName.addEventListener('input', () => {
            if (roomName.value == "<?php echo $roomData['name']; ?>") {
                disableSubmitBtn();
            } else {
                enableSubmitBtn();
            }
        });

        // event listener to check if typeId input value is equal to the original value
        const typeId = document.getElementById('typeId');
        const alertType = document.getElementById('alertType');
        typeId.addEventListener('input', () => {
            if (typeId.value == "<?php echo $roomData['type_id']; ?>") {
                alertType.classList.remove('hidden');
                disableSubmitBtn();
            } else {
                alertType.classList.add('hidden');
                enableSubmitBtn();
            }
        });

        // event listener to check if roomDetail input value is equal to the original value
        const roomDetail = document.getElementById('roomDetail');
        roomDetail.addEventListener('input', () => {
            if (roomDetail.value == "<?php echo $roomData['detail']; ?>") {
                disableSubmitBtn();
            } else {
                enableSubmitBtn();
            }
        });

        // event listener to check if roomAmenities input value is equal to the original value
        const roomAmenities = document.getElementById('roomAmenities');
        roomAmenities.addEventListener('input', () => {
            if (roomAmenities.value == "<?php echo $roomData['facility']; ?>") {
                disableSubmitBtn();
            } else {
                enableSubmitBtn();
            }
        });

        // event listener to check if maxGuest input value is equal to the original value
        const maxGuest = document.getElementById('maxGuest');
        const alertMaxGuest = document.getElementById('alertMaxGuest');
        maxGuest.addEventListener('input', () => {
            // function to change border color to red
            function changeToRed() {
                maxGuest.classList.remove('border-green-500');
                maxGuest.classList.add('border-red-500');
                alertMaxGuest.classList.remove('hidden');
            }
            // function to change border color to green
            function changeToGreen() {
                maxGuest.classList.remove('border-red-500');
                maxGuest.classList.add('border-green-500');
                alertMaxGuest.classList.add('hidden');
            }

            if (maxGuest.value == "<?php echo $roomData['max_people']; ?>") {
                changeToRed();
                // alertMaxGuest.value = "คุณกรอกเลขจำนวนผู้เข้าพักจำนวนเดิม";
                alertMaxGuest.value = "คุณกรอกเลขจำนวนผู้เข้าพักจำนวนเดิม";
                disableSubmitBtn();
            } else {
                if (maxGuest.value < 1 || maxGuest.value > 10) {
                    changeToRed();
                    alertMaxGuest.value = "จำนวนที่กรอกต้องอยู่ในช่วง 1-10"
                    disableSubmitBtn();
                }else {
                    changeToGreen();                    
                    enableSubmitBtn();
                }
            }
        });

        // event listener to check if price input value is equal to the original value
        const price = document.getElementById('price');
        const alertPrice = document.getElementById('alertPrice');
        price.addEventListener('input', () => {
            // function to change border color to red
            function changeToRed() {
                price.classList.remove('border-green-500');
                price.classList.add('border-red-500');
                alertPrice.classList.remove('hidden');
            }
            // function to change border color to green
            function changeToGreen() {
                price.classList.remove('border-red-500');
                price.classList.add('border-green-500');
                alertPrice.classList.add('hidden');
            }
            if (price.value == "<?php echo $roomData['price']; ?>") {
                changeToRed();
                disableSubmitBtn();
            } else {
                if (price.value < 500 || price.value > 20000) {
                    changeToRed();
                    disableSubmitBtn();
                }else {
                    changeToGreen();
                    enableSubmitBtn();
                }
            }
        });


        // detect if anything change in image input if same as before disable submit button else enable submit button
        document.getElementById('roomImage').addEventListener('change', function() {
            // remove C:\fakepath\ from image input
            let value = this.value.replace("C:\\fakepath\\", "");
            if (value == "<?php echo $roomImg; ?>") {
                disableSubmitBtn();
                // change border color to red
                this.classList.remove('border-green-500');
                this.classList.add('border-red-500');
            }else {
                enableSubmitBtn();
                // change border color to green
                this.classList.remove('border-red-500');
                this.classList.add('border-green-500');
            }                
        });

        // event listener to check if roomStatus input value is equal to the original value
        const roomStatus = document.getElementById('roomStatus');
        roomStatus.addEventListener('input', () => {
            if (roomStatus.value == "<?php echo $roomData['status']; ?>") {
                disableSubmitBtn();
            } else {
                enableSubmitBtn();
            }
        });
    </script>
</body>
</html>
