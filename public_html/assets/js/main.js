if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.documentElement.classList.add('dark')
  $("#toggleTheme").html(`
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="white" aria-hidden="true" class="h-6 w-6 lg:h-8 lg:w-8">
      <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd">
      </path>
    </svg>
  `);
} else {
  document.documentElement.classList.remove('dark')
  $("#toggleTheme").html(`
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true" class="h-6 w-6 lg:h-8 lg:w-8">
      <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
    </svg>
  `);
}

function copyListUrl() {

}

$(document).ready(() => {

  $(".comingsoon").click(() => {
    $.toast({
        text: "Under development.", // Text that is to be shown in the toast
        
        icon: 'info', // Type of toast icon
        showHideTransition: 'fade', // fade, slide or plain
        allowToastClose: true, // Boolean value true or false
        hideAfter: 1500, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
        stack: 2, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
        position: 'bottom-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
        
        textAlign: 'left',  // Text alignment i.e. left, right or center
        loader: false,  // Whether to show loader or not. True by default
    });
            
  })

  $("#NavToggle").click(function() {
    let menu = $("#mobile-menu")

    if (menu.is(":visible")) {
      // $(this).children().last().addClass("hidden").removeClass("block")
      // $(this).children().first().removeClass("hidden").addClass("block")
      menu.slideUp(200);
    } else {
      // $(this).children().first().addClass("hidden").removeClass("block")
      // $(this).children().last().removeClass("hidden").addClass("block")
      menu.slideDown(300);
    }
  });

  $("#toggleTheme").click(function() {
    // alert("hi");
    if (localStorage.theme === "dark") {
      localStorage.theme = 'light'
      document.documentElement.classList.remove('dark')
      $("#toggleTheme").html(`
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true" class="h-6 w-6 lg:h-8 lg:w-8">
          <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
        </svg>
      `);
    } else {
      localStorage.theme = 'dark'
      document.documentElement.classList.add('dark')
      $("#toggleTheme").html(`
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="white" aria-hidden="true" class="h-6 w-6 lg:h-8 lg:w-8">
          <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd">
          </path>
        </svg>
      `);
    }

  })
})
// Whenever the user explicitly chooses light mode

// Whenever the user explicitly chooses dark mode

// Whenever the user explicitly chooses to respect the OS preference
// localStorage.removeItem('theme')