<nav class="bg-gray-800">
  <div class="mx-auto max-w-screen-xl px-4">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 
        hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
          <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
          <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex flex-shrink-0 items-center">
          <a href="./index.php" class="flex items-center space-x-3 rtl:space-x-reverse ">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white hover:text-amber-400 transition-all duration-300 ease-in-out">Hotels</span>
          </a>
          <div class="h-[80%] w-[3px] bg-white rounded-md ml-2"></div> <!-- Divider -->
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4 font-normal text-base">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href='#' class='text-gray-300 hover:bg-gray-700  rounded-md px-3 py-2 hover:text-amber-400 transition-all duration-300 ease-in-out'>เกี่ยวกับ</a>
            <a href='#' class='text-gray-300 hover:bg-gray-700  rounded-md px-3 py-2 hover:text-amber-400 transition-all duration-300 ease-in-out'>ติดต่อ</a>
          </div>
        </div>
      </div>

        <!-- Profile dropdown -->
        <div class="relative ml-3">
          <div>
            <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white 
              focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">Open user menu</span>
              <?php if ($_SESSION['user']['img'] !== null) {
                  $userImg = $_SESSION['user']['img'];
                  echo "<img class='w-9 h-9 rounded-full' src='./assets/photos/$userImg' alt='user photo'>";
              }else {
                  echo "<img class='w-9 h-9 rounded-full' src='./assets/photos/user.png' alt='user photo'>";
              }?>
            </button>
          </div>

          <div class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 
          ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" id="drop-down-memu">
            <!-- Active: "bg-gray-100", Not Active: "" -->
            <?php 
              $email = $_SESSION['user']['email'];
              $fname = $_SESSION['user']['fname'];
              $lname = $_SESSION['user']['lname'];
            ?>

            <!-- display fname lname in div -->
            <div class="px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">
              <div class="font-semibold"><?php echo $fname . ' ' . $lname; ?></div>
              <div class="text-xs text-gray-500"><?php echo $email; ?></div>
            </div>
            <?php if ($_SESSION['user']['role'] === 'admin') {
              echo "
                <a href='./manageRoom.php' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-600 hover:text-white transition-all duration-300 ease-in-out' role='menuitem' tabindex='-1' id='user-menu-item-0'>จัดการห้องพัก</a>
                <a href='./dashboard.php' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-600 hover:text-white transition-all duration-300 ease-in-out' role='menuitem' tabindex='-1' id='user-menu-item-1'>แดชบอร์ด</a>
                <a href='./profile.php' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-600 hover:text-white transition-all duration-300 ease-in-out' role='menuitem' tabindex='-1' id='user-menu-item-2'>โปรไฟล์ของฉัน</a>
                <a href='./signOut.php?Email=$email' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-600 hover:text-white transition-all duration-300 ease-in-out' role='menuitem' tabindex='-1' id='user-menu-item-3'>ลงชื่อออก</a>
              ";} else {
                echo "
                <a href='./myBooking.php' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-600 hover:text-white transition-all duration-300 ease-in-out' role='menuitem' tabindex='-1' id='user-menu-item-0'>การจองของฉัน</a>
                <a href='./profile.php' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-600 hover:text-white transition-all duration-300 ease-in-out' role='menuitem' tabindex='-1' id='user-menu-item-1'>โปรไฟล์ของฉัน</a>
                <a href='./signOut.php?Email=$email' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-600 hover:text-white transition-all duration-300 ease-in-out' role='menuitem' tabindex='-1' id='user-menu-item-2'>ลงชื่อออก</a>";
              }
            ?>            
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="sm:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href='#' class='text-gray-300 hover:bg-gray-700  rounded-md px-3 py-2 hover:text-amber-400 transition-all duration-300 ease-in-out'>เกี่ยวกับ</a>
        <a href='#' class='text-gray-300 hover:bg-gray-700  rounded-md px-3 py-2 hover:text-amber-400 transition-all duration-300 ease-in-out'>ติดต่อ</a>
    </div>
  </div>
</nav>

<script>
  let dropdown = document.getElementById('drop-down-memu');
  let dropdownButton = document.getElementById('user-menu-button');
  dropdownButton.addEventListener('click', function() {
      dropdown.classList.toggle('hidden');
  });
</script>