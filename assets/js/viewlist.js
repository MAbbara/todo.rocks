$(document).ready(() => {
  $(".checkItem").change(function() {
    let checked = $(this).is(":checked")
    let itemID = $(this).parent().data("itemid")
    let item = $(this).parent().parent().parent().parent().parent()

    if (checked) {
      checked = 1;
    } else {
      checked = 0
    }

    $.post("actions/lists/listItems.php", {
      action: "updateItem",
      listID: listID,
      itemID: itemID,
      checked: checked
    }, data => {
      data = JSON.parse(data)

      if (data.success) {
        if (checked == 1) {
          item.detach().appendTo("#list")
        } else {
          item.detach().prependTo("#list")
        }

      } else {
        $.toast({
          text: data.message, // Text that is to be shown in the toast
          
          icon: 'error', // Type of toast icon
          showHideTransition: 'fade', // fade, slide or plain
          allowToastClose: true, // Boolean value true or false
          hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
          stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
          position: 'bottom-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
          
          textAlign: 'left',  // Text alignment i.e. left, right or center
          loader: false,  // Whether to show loader or not. True by default
        });
      }
    })

    
  });

  $(".delete").click(function() {
    let item = $(this).parent().parent().parent()
    let itemID = $(this).data("itemid")

    $.post("actions/lists/listItems.php", {
      action: "deleteItem",
      listID: listID,
      itemID: itemID
    }, data => {
      data = JSON.parse(data)

      if (data.success) {
        item.remove()
      } else {
        $.toast({
          text: data.message, // Text that is to be shown in the toast
          
          icon: 'error', // Type of toast icon
          showHideTransition: 'fade', // fade, slide or plain
          allowToastClose: true, // Boolean value true or false
          hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
          stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
          position: 'bottom-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
          
          textAlign: 'left',  // Text alignment i.e. left, right or center
          loader: false,  // Whether to show loader or not. True by default
        });
      }
    })

    console.log(listID)
    console.log(itemID)
  })

  $("#modal-open").click(() => {
    let modal = $("#modal")
    if (modal.is(":visible")) {
      modal.fadeOut(200)
    } else {
      modal.fadeIn(300)
    }
  })

  $(document).click(function(e) {
    // console.log($(e.target).parents("#modal-content").length)
    // console.log($(e.target).parents("#modal-open").length)
    // console.log(e.target.id)
    if ((e.target.id !== 'modal-open' && $(e.target).parents('#modal-open').length === 0) &&
        (e.target.id !== "modal-content" && $(e.target).parents("#modal-content").length === 0)
    ) {
      $("#modal").fadeOut(200)
    }

    // if (!$(e.target).closest('.modal').length && (condition1 && condition2 && condition3)) {
    //     // console.log("here")

    // }
  });

  $(".addItem").submit(function(e) {
    e.preventDefault(e)

    let taskName = $('#taskName')
    let description = $("#description")
    let date = $("input[type='date']")
    if (date.length == 0) {
      date = ""
    } else {
      date = date.val()
    }

    $.post("actions/lists/listItems.php", {
      action: "addItem",
      listID: listID,
      itemName: taskName.val(),
      description: description.val(),
      date: date
    }, data => {
      console.log(data)
      data = JSON.parse(data)

      if (data.success) {
        let itemID = data.itemID;

        if (taskName.val().length > 0 && description.val().length > 0 && date.length > 0) {
          date = new Date(date)
          date = `${date.getDate()}-${date.getMonth()+1}-${date.getFullYear()}`
          let html = `
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
                  <div class="flex items-center h-5" data-itemid=${itemID}>
                    <input type="checkbox" class="checkItem rounded-full border-2 border-emerald-500 focus:ring-emerald-500 h-6 w-6 text-emerald-500">
                  </div>
                  <div class="ml-3 text-sm">
                    <label class="font-medium text-gray-700 dark:text-slate-100">${taskName.val()}</label>
                    <p class="text-gray-600 dark:text-slate-200">${description.val()}</p>
                  </div>
                </div>
        
                <div class="flex mt-4 mb-0">
                  <div class="inline-flex text-gray-800 dark:text-gray-100 pr-2">
                    <svg class="fill-current h-6 w-6" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 1C4.77614 1 5 1.22386 5 1.5V2H10V1.5C10 1.22386 10.2239 1 10.5 1C10.7761 1 11 1.22386 11 1.5V2H12.5C13.3284 2 14 2.67157 14 3.5V12.5C14 13.3284 13.3284 14 12.5 14H2.5C1.67157 14 1 13.3284 1 12.5V3.5C1 2.67157 1.67157 2 2.5 2H4V1.5C4 1.22386 4.22386 1 4.5 1ZM10 3V3.5C10 3.77614 10.2239 4 10.5 4C10.7761 4 11 3.77614 11 3.5V3H12.5C12.7761 3 13 3.22386 13 3.5V5H2V3.5C2 3.22386 2.22386 3 2.5 3H4V3.5C4 3.77614 4.22386 4 4.5 4C4.77614 4 5 3.77614 5 3.5V3H10ZM2 6V12.5C2 12.7761 2.22386 13 2.5 13H12.5C12.7761 13 13 12.7761 13 12.5V6H2ZM7 7.5C7 7.22386 7.22386 7 7.5 7C7.77614 7 8 7.22386 8 7.5C8 7.77614 7.77614 8 7.5 8C7.22386 8 7 7.77614 7 7.5ZM9.5 7C9.22386 7 9 7.22386 9 7.5C9 7.77614 9.22386 8 9.5 8C9.77614 8 10 7.77614 10 7.5C10 7.22386 9.77614 7 9.5 7ZM11 7.5C11 7.22386 11.2239 7 11.5 7C11.7761 7 12 7.22386 12 7.5C12 7.77614 11.7761 8 11.5 8C11.2239 8 11 7.77614 11 7.5ZM11.5 9C11.2239 9 11 9.22386 11 9.5C11 9.77614 11.2239 10 11.5 10C11.7761 10 12 9.77614 12 9.5C12 9.22386 11.7761 9 11.5 9ZM9 9.5C9 9.22386 9.22386 9 9.5 9C9.77614 9 10 9.22386 10 9.5C10 9.77614 9.77614 10 9.5 10C9.22386 10 9 9.77614 9 9.5ZM7.5 9C7.22386 9 7 9.22386 7 9.5C7 9.77614 7.22386 10 7.5 10C7.77614 10 8 9.77614 8 9.5C8 9.22386 7.77614 9 7.5 9ZM5 9.5C5 9.22386 5.22386 9 5.5 9C5.77614 9 6 9.22386 6 9.5C6 9.77614 5.77614 10 5.5 10C5.22386 10 5 9.77614 5 9.5ZM3.5 9C3.22386 9 3 9.22386 3 9.5C3 9.77614 3.22386 10 3.5 10C3.77614 10 4 9.77614 4 9.5C4 9.22386 3.77614 9 3.5 9ZM3 11.5C3 11.2239 3.22386 11 3.5 11C3.77614 11 4 11.2239 4 11.5C4 11.7761 3.77614 12 3.5 12C3.22386 12 3 11.7761 3 11.5ZM5.5 11C5.22386 11 5 11.2239 5 11.5C5 11.7761 5.22386 12 5.5 12C5.77614 12 6 11.7761 6 11.5C6 11.2239 5.77614 11 5.5 11ZM7 11.5C7 11.2239 7.22386 11 7.5 11C7.77614 11 8 11.2239 8 11.5C8 11.7761 7.77614 12 7.5 12C7.22386 12 7 11.7761 7 11.5ZM9.5 11C9.22386 11 9 11.2239 9 11.5C9 11.7761 9.22386 12 9.5 12C9.77614 12 10 11.7761 10 11.5C10 11.2239 9.77614 11 9.5 11Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path></svg>                                    
                  </div>
                  <div class="inline-flex text-gray-800 dark:text-gray-100">
                    <p>${date}</p>
                  </div>
                  
                </div>
              </div>
    
              <div class="ml-5 flex-shrink-0">
                
                <svg data-itemid="${itemID}" class="delete h-6 w-6 fill-red-600 hover:cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"/><path d="M9 9H11V17H9V9Z"  /><path d="M13 9H15V17H13V9Z"  />
                </svg>
    
              </div>
            </div>
      
          </div>
          `

          
          $("#list").prepend(html)
        } else if (taskName.val().length > 0 && description.val().length > 0 && date.length == 0) {
          let html = `
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
                    <div class="flex items-center h-5" data-itemid=${itemID}>
                      <input type="checkbox" class="checkItem rounded-full border-2 border-emerald-500 focus:ring-emerald-500 h-6 w-6 text-emerald-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label class="font-medium text-gray-700 dark:text-slate-100">${taskName.val()}</label>
                      <p class="text-gray-600 dark:text-slate-200">${description.val()}</p>
      
                    </div>
                  </div>
                </div>
      
                <div class="ml-5 flex-shrink-0">
                  
                  <svg data-itemid="${itemID}" class="delete h-6 w-6 fill-red-600 hover:cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"/><path d="M9 9H11V17H9V9Z"  /><path d="M13 9H15V17H13V9Z"  />
                  </svg>
      
                </div>
              </div>
        
            </div>
          `
          $("#list").prepend(html)

        } else if (taskName.val().length > 0 && description.val().length == 0 && date.length > 0) {
          date = new Date(date)
          date = `${date.getDate()}-${date.getMonth()+1}-${date.getFullYear()}`
          let html = `
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
                    <div class="flex items-center h-5" data-itemid=${itemID}>
                      <input type="checkbox" class="checkItem rounded-full border-2 border-emerald-500 focus:ring-emerald-500 h-6 w-6 text-emerald-500">
                    </div>
                    <div class="ml-3 text-sm">
                      <label class="font-medium text-gray-700 dark:text-slate-100">${taskName.val()}</label>
                    </div>
                  </div>
          
                  <div class="flex mt-4 mb-0">
                    <div class="inline-flex text-gray-800 dark:text-gray-100 pr-2">
                      <svg class="fill-current h-6 w-6" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 1C4.77614 1 5 1.22386 5 1.5V2H10V1.5C10 1.22386 10.2239 1 10.5 1C10.7761 1 11 1.22386 11 1.5V2H12.5C13.3284 2 14 2.67157 14 3.5V12.5C14 13.3284 13.3284 14 12.5 14H2.5C1.67157 14 1 13.3284 1 12.5V3.5C1 2.67157 1.67157 2 2.5 2H4V1.5C4 1.22386 4.22386 1 4.5 1ZM10 3V3.5C10 3.77614 10.2239 4 10.5 4C10.7761 4 11 3.77614 11 3.5V3H12.5C12.7761 3 13 3.22386 13 3.5V5H2V3.5C2 3.22386 2.22386 3 2.5 3H4V3.5C4 3.77614 4.22386 4 4.5 4C4.77614 4 5 3.77614 5 3.5V3H10ZM2 6V12.5C2 12.7761 2.22386 13 2.5 13H12.5C12.7761 13 13 12.7761 13 12.5V6H2ZM7 7.5C7 7.22386 7.22386 7 7.5 7C7.77614 7 8 7.22386 8 7.5C8 7.77614 7.77614 8 7.5 8C7.22386 8 7 7.77614 7 7.5ZM9.5 7C9.22386 7 9 7.22386 9 7.5C9 7.77614 9.22386 8 9.5 8C9.77614 8 10 7.77614 10 7.5C10 7.22386 9.77614 7 9.5 7ZM11 7.5C11 7.22386 11.2239 7 11.5 7C11.7761 7 12 7.22386 12 7.5C12 7.77614 11.7761 8 11.5 8C11.2239 8 11 7.77614 11 7.5ZM11.5 9C11.2239 9 11 9.22386 11 9.5C11 9.77614 11.2239 10 11.5 10C11.7761 10 12 9.77614 12 9.5C12 9.22386 11.7761 9 11.5 9ZM9 9.5C9 9.22386 9.22386 9 9.5 9C9.77614 9 10 9.22386 10 9.5C10 9.77614 9.77614 10 9.5 10C9.22386 10 9 9.77614 9 9.5ZM7.5 9C7.22386 9 7 9.22386 7 9.5C7 9.77614 7.22386 10 7.5 10C7.77614 10 8 9.77614 8 9.5C8 9.22386 7.77614 9 7.5 9ZM5 9.5C5 9.22386 5.22386 9 5.5 9C5.77614 9 6 9.22386 6 9.5C6 9.77614 5.77614 10 5.5 10C5.22386 10 5 9.77614 5 9.5ZM3.5 9C3.22386 9 3 9.22386 3 9.5C3 9.77614 3.22386 10 3.5 10C3.77614 10 4 9.77614 4 9.5C4 9.22386 3.77614 9 3.5 9ZM3 11.5C3 11.2239 3.22386 11 3.5 11C3.77614 11 4 11.2239 4 11.5C4 11.7761 3.77614 12 3.5 12C3.22386 12 3 11.7761 3 11.5ZM5.5 11C5.22386 11 5 11.2239 5 11.5C5 11.7761 5.22386 12 5.5 12C5.77614 12 6 11.7761 6 11.5C6 11.2239 5.77614 11 5.5 11ZM7 11.5C7 11.2239 7.22386 11 7.5 11C7.77614 11 8 11.2239 8 11.5C8 11.7761 7.77614 12 7.5 12C7.22386 12 7 11.7761 7 11.5ZM9.5 11C9.22386 11 9 11.2239 9 11.5C9 11.7761 9.22386 12 9.5 12C9.77614 12 10 11.7761 10 11.5C10 11.2239 9.77614 11 9.5 11Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path></svg>                
                    </div>
                    <div class="inline-flex text-gray-800 dark:text-gray-100">
                      <p>${date}</p>
                    </div>
                    
                  </div>
                </div>
      
                <div class="ml-5 flex-shrink-0">
                  
                  <svg data-itemid="${itemID}" class="delete h-6 w-6 fill-red-600 hover:cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"/><path d="M9 9H11V17H9V9Z"  /><path d="M13 9H15V17H13V9Z"  />
                  </svg>
      
                </div>
              </div>
        
            </div>
          `
          $("#list").prepend(html)
        } else if (taskName.val().length > 0 && description.val().length == 0 && date.length == 0) {
          let html = `
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
                  <div class="flex items-center h-5" data-itemid=${itemID}>
                    <input type="checkbox" class="checkItem rounded-full border-2 border-emerald-500 focus:ring-emerald-500 h-6 w-6 text-emerald-500">
                  </div>
                  <div class="ml-3 text-sm">
                    <label class="font-medium text-gray-700 dark:text-slate-100">${taskName.val()}</label>
                  </div>
                </div>
              </div>
    
              <div class="ml-5 flex-shrink-0">
                
                <svg data-itemid="${itemID}" class="delete h-6 w-6 fill-red-600 hover:cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"/><path d="M9 9H11V17H9V9Z"  /><path d="M13 9H15V17H13V9Z"  />
                </svg>
    
              </div>
            </div>
      
          </div>
          `

          $("#list").prepend(html)
        } 

        $("input[type='date']").prop({type:"text", placeholder: "dd.mm.yyyy", value: ""})
        taskName.val("")
        description.val("")

        $("#script").remove();
        $("body").append(`<script src="./assets/js/viewlist.js" id="script"></script>`)

        $("#modal").hide(200)

        $.toast({
          text: "Item added successfully, refreshing.", // Text that is to be shown in the toast
          
          icon: 'success', // Type of toast icon
          showHideTransition: 'fade', // fade, slide or plain
          allowToastClose: true, // Boolean value true or false
          hideAfter: 1500, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
          stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
          position: 'bottom-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
              
          textAlign: 'left',  // Text alignment i.e. left, right or center
          loader: true,  // Whether to show loader or not. True by default
          loaderBg: '#34d399',  // Background color of the toast loader
          
      });

      setTimeout(function() {
        document.location.reload();
      }, 1500);

      } else {
        $.toast({
          text: data.message, // Text that is to be shown in the toast
          
          icon: 'error', // Type of toast icon
          showHideTransition: 'fade', // fade, slide or plain
          allowToastClose: true, // Boolean value true or false
          hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
          stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
          position: 'bottom-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
          
          textAlign: 'left',  // Text alignment i.e. left, right or center
          loader: false,  // Whether to show loader or not. True by default
        });
      }
    })

  })

  $("#datePick").focus(function() {
      $(this).prop({type:"date"})
      $(this).focus()
    })
  
    $(".copyUrl").click(() => {
        let input = $(".listUrl");
  
        input.select();
  
        document.execCommand("copy");
  
        document.getSelection().removeAllRanges();
  
        $.toast({
          text: "Link copied", // Text that is to be shown in the toast
          
          icon: 'info', // Type of toast icon
          showHideTransition: 'fade', // fade, slide or plain
          allowToastClose: true, // Boolean value true or false
          hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
          stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
          position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
          
          
          
          textAlign: 'left',  // Text alignment i.e. left, right or center
          loader: false,  // Whether to show loader or not. True by default
      });
              
    })
})