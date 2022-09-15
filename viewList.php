<?php
  include "./db.php";
  include "./functions.php";

  if (isset($_GET['listID'])):
    $listID = $con->real_escape_string($_GET['listID']);
    $listQuery = $con->query("SELECT * FROM lists WHERE listID='$listID'");

    if ($listQuery->num_rows == 0) {
      header("location: ./");
      die();
    }

    $listData = $listQuery->fetch_assoc();
    $listName = $listData['listName'];

    $overDue = $con->query("SELECT COUNT(*) AS c FROM list_items WHERE listID='$listID' AND UNIX_TIMESTAMP(CURDATE()) > (dueDate+(24*3600)) AND dueDate != 0")->fetch_assoc()['c'];
    $upcoming = $con->query("SELECT COUNT(*) AS c FROM list_items WHERE listID='$listID' AND dueDate > UNIX_TIMESTAMP(CURDATE())")->fetch_assoc()['c'];

    printf('
    <script>
      let listID = "%s"
    </script>
    ', $listID);
?>

<!doctype html>
<html class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../dist/output.css" rel="stylesheet">
  <link href="./assets/css/jquery.toast.css" rel="stylesheet">
  <title><?= $listName ?></title>

</head>

<body class="bg-gray-100 dark:bg-slate-900">

  <nav class="bg-white shadow dark:shadow-none dark:bg-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-20 lg:px-40">
      <div class="relative flex justify-between h-16">
        <div class="flex">
          <div class="-ml-2 mr-2 flex items-center md:hidden">
            <!-- Mobile menu button -->
            <button id="NavToggle" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
              
              <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
              
              <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="hidden md:ml-6 md:flex md:items-center md:space-x-8 dark:md:space-x-2">
            <!-- Current: "border-emerald-500 border-b-2 dark:bg-gray-800 dark:text-white", 
            Default: "text-gray-600 border-b-2 border-transparent hover:border-gray-300 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white " -->
            <a href="./" class="text-gray-600 border-b-2 border-transparent hover:border-gray-300 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white dark:border-none dark:px-3 px-1 py-2 dark:rounded-md text-sm font-medium" aria-current="page">Home</a>

            <a href="#" class="comingsoon text-gray-600 border-b-2 border-transparent hover:border-gray-300 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white dark:border-none dark:px-3 px-1 py-2 dark:rounded-md text-sm font-medium inline-flex">Contact </a>
            
          </div>
        </div>

        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          <div class="dark:mr-0 pr-0">
            <button type="button" id="toggleTheme" class="bg-gray-200 dark:bg-gray-800 p-1 rounded-full">
              <!-- Heroicon name: outline/bell -->
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true" class="h-6 w-6 lg:h-8 lg:w-8">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
              </svg>
            </button>
          </div>

          <div class="ml-3 relative">
              <a href="#" class="comingsoon text-gray-600 border-b-2 border-transparent hover:border-gray-300 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white dark:border-none dark:pt-1.5 px-1 py-2 dark:rounded-md text-sm font-medium inline-flex">Sign In </a>
          </div>
        </div>
        
      </div>
    </div>
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="hidden md:hidden relative w-full" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 dark:bg-transparent bg-white rounded-b-md">
        <!-- 
        Current: "text-emerald-500 bg-emerald-50 border-l-4 border-emerald-500 dark:border-none dark:bg-gray-900 dark:text-white", 
        Default: "text-gray-500 border-l-4 border-transparent hover:bg-gray-50 hover:border-gray-500 dark:border-none dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white" -->
        <a href="./" class=" text-gray-500 border-l-4 border-transparent hover:bg-gray-50 hover:border-gray-500 dark:border-none dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white block px-3 py-2 dark:rounded-md text-base font-medium" aria-current="page">Home</a>

        <a href="#" class="comingsoon text-gray-500 border-l-4 border-transparent hover:bg-gray-50 hover:border-gray-500 dark:border-none dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white block px-3 py-2 dark:rounded-md text-base font-medium">Contact</a>

      </div>
      
    </div>
  </nav>
  
  <div class="container">
    <div class="text-left w-full sm:w-1/4 mx-auto py-8 pl-9  lg:py-12 lg:px-8 ">
        <h2 class="text-2xl font-extrabold tracking-tight text-gray-800 sm:text-3xl dark:text-white">
          <?= $listName ?>
        </h2>
  
        <div class="text-gray-700 dark:text-gray-300 mt-2">
          <p class="text-sm">You've got <span class="text-red-500"><?=$overDue?></span> overdue tasks and <?=$upcoming?> tasks coming up</p>
        </div>

        <div class="mt-8 inline-flex">
            <input value="https://todo.rocks/viewList.php?listID=<?= $listID ?>" type="text" readonly class="listUrl mr-2 rounded-lg w-fit border-0 px-4 py-2 text-gray-700 bg-white dark:bg-gray-200">
            
            <button class="copyUrl px-4 py-2 text-sm font-medium tracking-wide text-gray-800 dark:text-gray-100 capitalize transition-colors rounded-lg bg-emerald-400 hover:bg-emerald-500 dark:hover:bg-emerald-600 dark:bg-emerald-500 ">
              <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 70.63l-61.25-61.25C435.4 3.371 427.2 0 418.7 0H255.1c-35.35 0-64 28.66-64 64l.0195 256C192 355.4 220.7 384 256 384h192c35.2 0 64-28.8 64-64V93.25C512 84.77 508.6 76.63 502.6 70.63zM464 320c0 8.836-7.164 16-16 16H255.1c-8.838 0-16-7.164-16-16L239.1 64.13c0-8.836 7.164-16 16-16h128L384 96c0 17.67 14.33 32 32 32h47.1V320zM272 448c0 8.836-7.164 16-16 16H63.1c-8.838 0-16-7.164-16-16L47.98 192.1c0-8.836 7.164-16 16-16H160V128H63.99c-35.35 0-64 28.65-64 64l.0098 256C.002 483.3 28.66 512 64 512h192c35.2 0 64-28.8 64-64v-32h-47.1L272 448z"/></svg>
            </button>
        </div>
        <p class="text-red-500 font-medium text-sm mt-2 ml-1">
          MAKE SURE TO SAVE YOUR LIST URL
        </p>

    </div>
        
    <div class="w-full px-4 mx-auto sm:max-w-7xl sm:px-4 pb-14 sm:pb-0" id="list">
      <?php
        $listItems = $con->query("SELECT * FROM list_items WHERE listID='$listID' ORDER BY checked ASC, dueDate ASC");
        
        if ($listItems->num_rows > 0) {
          while ($row = $listItems->fetch_assoc()) {
            $itemID = $row['itemID'];
            $item = $row['item'];
            $description = $row['description'];
            $date = $row['dueDate'];
            $checked = $row['checked'];

            $html = getHTML($itemID, $item, $description, $date, $checked);
            echo $html;
            // echo sprintf("<p class='text-white'>%s</p>", $html);
            // die();
            
          }
          // die();
        }

      ?>

      <!-- <div class="
        w-11/12
        mx-auto
        sm:w-4/6
        mt-3
        rounded-xl
        bg-white
        px-8
        py-6
        drop-shadow-xl
        dark:bg-slate-800
      ">
        <div class="flex items-center">
          <div class="flex-1">
            <div class="flex items-center">
              <div class="flex items-center h-5">
                <input type="checkbox" class="rounded-full border-2 border-emerald-500 focus:ring-emerald-500 h-6 w-6 text-emerald-500">
              </div>
              <div class="ml-3 text-sm">
                <label class="font-medium text-gray-700 dark:text-slate-100">Item Name</label>
                <p class="text-gray-600 dark:text-slate-200">Item description</p>
              </div>
            </div>
    
            <div class="flex mt-4 mb-0">
              <div class="inline-flex text-gray-800 dark:text-gray-100 pr-2">
                
                <svg class="fill-current h-6 w-6" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 1C4.77614 1 5 1.22386 5 1.5V2H10V1.5C10 1.22386 10.2239 1 10.5 1C10.7761 1 11 1.22386 11 1.5V2H12.5C13.3284 2 14 2.67157 14 3.5V12.5C14 13.3284 13.3284 14 12.5 14H2.5C1.67157 14 1 13.3284 1 12.5V3.5C1 2.67157 1.67157 2 2.5 2H4V1.5C4 1.22386 4.22386 1 4.5 1ZM10 3V3.5C10 3.77614 10.2239 4 10.5 4C10.7761 4 11 3.77614 11 3.5V3H12.5C12.7761 3 13 3.22386 13 3.5V5H2V3.5C2 3.22386 2.22386 3 2.5 3H4V3.5C4 3.77614 4.22386 4 4.5 4C4.77614 4 5 3.77614 5 3.5V3H10ZM2 6V12.5C2 12.7761 2.22386 13 2.5 13H12.5C12.7761 13 13 12.7761 13 12.5V6H2ZM7 7.5C7 7.22386 7.22386 7 7.5 7C7.77614 7 8 7.22386 8 7.5C8 7.77614 7.77614 8 7.5 8C7.22386 8 7 7.77614 7 7.5ZM9.5 7C9.22386 7 9 7.22386 9 7.5C9 7.77614 9.22386 8 9.5 8C9.77614 8 10 7.77614 10 7.5C10 7.22386 9.77614 7 9.5 7ZM11 7.5C11 7.22386 11.2239 7 11.5 7C11.7761 7 12 7.22386 12 7.5C12 7.77614 11.7761 8 11.5 8C11.2239 8 11 7.77614 11 7.5ZM11.5 9C11.2239 9 11 9.22386 11 9.5C11 9.77614 11.2239 10 11.5 10C11.7761 10 12 9.77614 12 9.5C12 9.22386 11.7761 9 11.5 9ZM9 9.5C9 9.22386 9.22386 9 9.5 9C9.77614 9 10 9.22386 10 9.5C10 9.77614 9.77614 10 9.5 10C9.22386 10 9 9.77614 9 9.5ZM7.5 9C7.22386 9 7 9.22386 7 9.5C7 9.77614 7.22386 10 7.5 10C7.77614 10 8 9.77614 8 9.5C8 9.22386 7.77614 9 7.5 9ZM5 9.5C5 9.22386 5.22386 9 5.5 9C5.77614 9 6 9.22386 6 9.5C6 9.77614 5.77614 10 5.5 10C5.22386 10 5 9.77614 5 9.5ZM3.5 9C3.22386 9 3 9.22386 3 9.5C3 9.77614 3.22386 10 3.5 10C3.77614 10 4 9.77614 4 9.5C4 9.22386 3.77614 9 3.5 9ZM3 11.5C3 11.2239 3.22386 11 3.5 11C3.77614 11 4 11.2239 4 11.5C4 11.7761 3.77614 12 3.5 12C3.22386 12 3 11.7761 3 11.5ZM5.5 11C5.22386 11 5 11.2239 5 11.5C5 11.7761 5.22386 12 5.5 12C5.77614 12 6 11.7761 6 11.5C6 11.2239 5.77614 11 5.5 11ZM7 11.5C7 11.2239 7.22386 11 7.5 11C7.77614 11 8 11.2239 8 11.5C8 11.7761 7.77614 12 7.5 12C7.22386 12 7 11.7761 7 11.5ZM9.5 11C9.22386 11 9 11.2239 9 11.5C9 11.7761 9.22386 12 9.5 12C9.77614 12 10 11.7761 10 11.5C10 11.2239 9.77614 11 9.5 11Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path></svg>                
                
              </div>
              <div class="inline-flex text-gray-800 dark:text-gray-100">
                <p>dd-mm-yyy</p>
              </div>
              
            </div>
          </div>

          <div class="ml-5 flex-shrink-0">
            <svg data-itemid="itemid" class="delete h-6 w-6 fill-red-600 hover:cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"/><path d="M9 9H11V17H9V9Z"  /><path d="M13 9H15V17H13V9Z"  />
            </svg>

          </div>
        </div>
  
      </div> -->

      <!-- <div class="
        w-11/12
        mx-auto
        sm:w-4/6
        mt-3
        rounded-xl
        bg-white
        px-8
        py-6
        drop-shadow-xl
        dark:bg-slate-800
      ">
        <div class="flex items-center">
          <div class="flex-1">
            <div class="flex items-center">
              <div class="flex items-center h-5">
                <input type="checkbox" class="rounded-full border-2 border-emerald-500 focus:ring-emerald-500 h-6 w-6 text-emerald-500">
              </div>
              <div class="ml-3 text-sm">
                <label class="font-medium text-gray-700 dark:text-slate-100">Item with no description</label>
              </div>
            </div>
    
            <div class="flex mt-4 mb-0">
              <div class="inline-flex text-gray-800 dark:text-gray-100 pr-2">
                <svg class="fill-current h-6 w-6" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 1C4.77614 1 5 1.22386 5 1.5V2H10V1.5C10 1.22386 10.2239 1 10.5 1C10.7761 1 11 1.22386 11 1.5V2H12.5C13.3284 2 14 2.67157 14 3.5V12.5C14 13.3284 13.3284 14 12.5 14H2.5C1.67157 14 1 13.3284 1 12.5V3.5C1 2.67157 1.67157 2 2.5 2H4V1.5C4 1.22386 4.22386 1 4.5 1ZM10 3V3.5C10 3.77614 10.2239 4 10.5 4C10.7761 4 11 3.77614 11 3.5V3H12.5C12.7761 3 13 3.22386 13 3.5V5H2V3.5C2 3.22386 2.22386 3 2.5 3H4V3.5C4 3.77614 4.22386 4 4.5 4C4.77614 4 5 3.77614 5 3.5V3H10ZM2 6V12.5C2 12.7761 2.22386 13 2.5 13H12.5C12.7761 13 13 12.7761 13 12.5V6H2ZM7 7.5C7 7.22386 7.22386 7 7.5 7C7.77614 7 8 7.22386 8 7.5C8 7.77614 7.77614 8 7.5 8C7.22386 8 7 7.77614 7 7.5ZM9.5 7C9.22386 7 9 7.22386 9 7.5C9 7.77614 9.22386 8 9.5 8C9.77614 8 10 7.77614 10 7.5C10 7.22386 9.77614 7 9.5 7ZM11 7.5C11 7.22386 11.2239 7 11.5 7C11.7761 7 12 7.22386 12 7.5C12 7.77614 11.7761 8 11.5 8C11.2239 8 11 7.77614 11 7.5ZM11.5 9C11.2239 9 11 9.22386 11 9.5C11 9.77614 11.2239 10 11.5 10C11.7761 10 12 9.77614 12 9.5C12 9.22386 11.7761 9 11.5 9ZM9 9.5C9 9.22386 9.22386 9 9.5 9C9.77614 9 10 9.22386 10 9.5C10 9.77614 9.77614 10 9.5 10C9.22386 10 9 9.77614 9 9.5ZM7.5 9C7.22386 9 7 9.22386 7 9.5C7 9.77614 7.22386 10 7.5 10C7.77614 10 8 9.77614 8 9.5C8 9.22386 7.77614 9 7.5 9ZM5 9.5C5 9.22386 5.22386 9 5.5 9C5.77614 9 6 9.22386 6 9.5C6 9.77614 5.77614 10 5.5 10C5.22386 10 5 9.77614 5 9.5ZM3.5 9C3.22386 9 3 9.22386 3 9.5C3 9.77614 3.22386 10 3.5 10C3.77614 10 4 9.77614 4 9.5C4 9.22386 3.77614 9 3.5 9ZM3 11.5C3 11.2239 3.22386 11 3.5 11C3.77614 11 4 11.2239 4 11.5C4 11.7761 3.77614 12 3.5 12C3.22386 12 3 11.7761 3 11.5ZM5.5 11C5.22386 11 5 11.2239 5 11.5C5 11.7761 5.22386 12 5.5 12C5.77614 12 6 11.7761 6 11.5C6 11.2239 5.77614 11 5.5 11ZM7 11.5C7 11.2239 7.22386 11 7.5 11C7.77614 11 8 11.2239 8 11.5C8 11.7761 7.77614 12 7.5 12C7.22386 12 7 11.7761 7 11.5ZM9.5 11C9.22386 11 9 11.2239 9 11.5C9 11.7761 9.22386 12 9.5 12C9.77614 12 10 11.7761 10 11.5C10 11.2239 9.77614 11 9.5 11Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path></svg>                
              </div>
              <div class="inline-flex text-gray-800 dark:text-gray-100">
                <p>dd-mm-yyy</p>
              </div>
              
            </div>
          </div>

          <div class="ml-5 flex-shrink-0">
            
            <svg data-itemid="itemid" class="delete h-6 w-6 fill-red-600 hover:cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"/><path d="M9 9H11V17H9V9Z"  /><path d="M13 9H15V17H13V9Z"  />
            </svg>

          </div>
        </div>
  
      </div>

      <div class="
        w-11/12
        mx-auto
        sm:w-4/6
        mt-3
        rounded-xl
        bg-white
        px-8
        py-6
        drop-shadow-xl
        dark:bg-slate-800
      ">
        <div class="flex items-center">
          <div class="flex-1">
            <div class="flex items-center">
              <div class="flex items-center h-5">
                <input type="checkbox" class="rounded-full border-2 border-emerald-500 focus:ring-emerald-500 h-6 w-6 text-emerald-500">
              </div>
              <div class="ml-3 text-sm">
                <label class="font-medium text-gray-700 dark:text-slate-100">Item with description and without date</label>
                <p class="text-gray-600 dark:text-slate-200">Item description</p>

              </div>
            </div>
          </div>

          <div class="ml-5 flex-shrink-0">
            
            <svg data-itemid="itemid" class="delete h-6 w-6 fill-red-600 hover:cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"/><path d="M9 9H11V17H9V9Z"  /><path d="M13 9H15V17H13V9Z"  />
            </svg>

          </div>
        </div>
  
      </div>

      <div class="
        w-11/12
        mx-auto
        sm:w-4/6
        mt-3
        rounded-xl
        bg-white
        px-8
        py-6
        drop-shadow-xl
        dark:bg-slate-800
      ">
        <div class="flex items-center">
          <div class="flex-1">
            <div class="flex items-center">
              <div class="flex items-center h-5">
                <input type="checkbox" class="rounded-full border-2 border-emerald-500 focus:ring-emerald-500 h-6 w-6 text-emerald-500">
              </div>
              <div class="ml-3 text-sm">
                <label class="font-medium text-gray-700 dark:text-slate-100">Item without description and without date</label>
              </div>
            </div>
          </div>

          <div class="ml-5 flex-shrink-0">
            
            <svg data-itemid="itemid" class="delete h-6 w-6 fill-red-600 hover:cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"/><path d="M9 9H11V17H9V9Z"  /><path d="M13 9H15V17H13V9Z"  />
            </svg>

          </div>
        </div>
  
      </div> -->

    </div>
  </div>

  <div class="relative z-10 hidden" id="modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="fixed inset-0 bg-gray-700 bg-opacity-75 transition-opacity modalBackground"></div>
  
    <div class="fixed z-10 inset-0 overflow-y-auto" >
      <div class="flex items-center justify-center min-h-full p-4 text-center sm:p-0">
        <div id="modal-content" class="relative bg-white dark:bg-slate-900 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-sm w-full sm:p-6">
          <div>
              <h3 class="text-3xl text-center leading-6 font-medium text-gray-900 dark:text-gray-50" id="modal-title">Add Task</h3>
              <form class="mt-8 addItem">
                <div class="mt-2">
                  <label class="dark:text-gray-50" for="taskName"><span class="text-red-500">*</span> Task Name</label>
                  <input type="text" required autocomplete="off" id="taskName" class="focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Task Name">
                </div>
                <div class="mt-2">
                  <label class="dark:text-gray-50" for="taskDescription">Task Description</label>
                  <textarea rows="3" maxlength="254" placeholder="Task description" id="description" class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>
                <div class="mt-2">
                  <label class="dark:text-gray-50" for="datePick">Task Due Date</label><br>
                  <input type="text" placeholder="dd.mm.yyyy" id="datePick" class="w-full focus:ring-emerald-500 focus:border-emerald-500 border-gray-300 rounded-md text-center">
                </div>
                <div class="mt-2">
                  <button type="submit" class="px-4 py-2.5 w-full border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-500 hover:bg-emerald-600 focus:outline-none">Add Task</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  


  <div class="fixed bottom-4 right-4 z-[100]">
    <button type="button" id="modal-open" class="inline-flex items-center rounded-full border border-transparent bg-emerald-500 p-3 text-white shadow-lg focus:outline-none dark:bg-emerald-400 dark:text-slate-900">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
    </button>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="./assets/js/jquery.toast.js"></script>
  <script src="./assets/js/viewlist.js" id="script"></script>
  <script src="./assets/js/main.js"></script>
  <script src="./assets/js/modal.js"></script>
</body>
</html>

<?php
  else:
    header("location: ./");
  endif;
?>