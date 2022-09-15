
<?php
  include "./db.php";

?>
<!doctype html>
<html class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./assets/css/output.css" rel="stylesheet">
<<<<<<< HEAD
  <link href="../dist/output.css" rel="stylesheet">
=======
>>>>>>> 02369bbe28cc3a9c48c9bd9e50e8dc46e719db4d
  <link href="./assets/css/jquery.toast.css" rel="stylesheet">
  <title>Todo lists rocks!</title>
</head>

<body class="bg-gray-100 dark:bg-gray-900">
  
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
            <a href="#" class="border-emerald-500 border-b-2 dark:bg-gray-800 dark:text-white dark:border-none dark:px-3 px-1 py-2 dark:rounded-md text-sm font-medium" aria-current="page">Home</a>

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
        <a href="#" class=" text-emerald-500 bg-emerald-50 border-l-4 border-emerald-500 dark:border-none dark:bg-gray-900 dark:text-white block px-3 py-2 dark:rounded-md text-base font-medium" aria-current="page">Home</a>

        <a href="#" class="comingsoon text-gray-500 border-l-4 border-transparent hover:bg-gray-50 hover:border-gray-500 dark:border-none dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white block px-3 py-2 dark:rounded-md text-base font-medium">Contact</a>

      </div>
      
    </div>
  </nav>

  <div class="flex mt-8 pt-4">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:py-12 lg:px-8 lg:justify-between">
      <h2 class="text-3xl font-extrabold tracking-tight text-gray-800 sm:text-4xl dark:text-white">
        <span class="block">Ready to dive in?</span>
        <span class="block text-emerald-400 dark:text-emerald-500">Create your todo list now.</span>
      </h2>

      <!-- <p class="mt-2 text-l italic tracking-tight text-gray-800 sm:text-xl dark:text-slate-400">
        some info here? help
      </p> -->
      
      <form class="sm:flex flex mt-6 newListForm">

        <div class=" sm:flex-auto w-56 mr-1 sm:w-72">
          <input
            required
            autocomplete="off"
            type="text"
            name="listName"
            id="listName"
            class="
              sm:w-72
              w-56
              px-3
              py-2
              text-base
              border border-gray-300
              rounded
              outline-none
              focus:ring-emerald-500 focus:border-emerald-500 focus:ring-1
            "
            placeholder="Enter List Name"
          />

        </div>
        <div class="mt-0 sm:mt-0 sm:flex-auto sm:w-32 w-32">
          <button type="submit" id="createList" class="sm:w-32 w-32 shadow inline-flex items-center justify-center px-5 py-2 border border-transparent text-base font-medium rounded-md text-white bg-emerald-400 hover:bg-emerald-500 dark:bg-emerald-500 dark:hover:bg-emerald-600">
            Create List
          </button>
        </div>
      </form>


        
    </div>
  </div>

  <div class="fixed bottom-4 right-4 z-[100]">
    <a href="https://www.instagram.com/_u/ma_abbara/" target="_blank" class="inline-flex items-center rounded-full border border-transparent bg-emerald-400 p-3 text-white shadow-lg focus:outline-none dark:bg-emerald-500 dark:text-slate-900">
      <svg class="h-5 w-5 text-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 7C9.23858 7 7 9.23858 7 12C7 14.7614 9.23858 17 12 17C14.7614 17 17 14.7614 17 12C17 9.23858 14.7614 7 12 7ZM9 12C9 13.6569 10.3431 15 12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12Z" fill="currentColor" /><path d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z" fill="currentColor" /><path fill-rule="evenodd" clip-rule="evenodd" d="M5 1C2.79086 1 1 2.79086 1 5V19C1 21.2091 2.79086 23 5 23H19C21.2091 23 23 21.2091 23 19V5C23 2.79086 21.2091 1 19 1H5ZM19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" fill="currentColor" /></svg>
    </a>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="./assets/js/jquery.toast.js"></script>
  <script src="./assets/js/main.js"></script>
  <script src="./assets/js/index.js"></script>
</body>
</html>