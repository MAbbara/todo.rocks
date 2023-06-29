$(document).ready(() => {
  $(".checkItem").change(function() {
    var checkbox = this;
    let checked = $(this).is(":checked")
    let itemID = $(this).parent().data("itemid")
    let item = $(this).parent().parent().parent().parent().parent()

    if (checked) checked = 1;
    else checked = 0
    

    $.post(`../updateItem/${listID}`, {
      itemID: itemID,
      checked: checked,
      csrf_token: csrf_token
    }, data => {
      data = JSON.parse(data)

      if (data.success) {
        if (checked == 1) {
          item.detach().appendTo("#list")
        } else {
          item.detach().prependTo("#list")
        }

      } else {
        if (checked == 1) $(checkbox).prop("checked", false);
        else $(checkbox).attr("checked", "");
        
        $.toast({
          text: data.message, 
          
          icon: 'error',
          showHideTransition: 'fade',
          allowToastClose: true, 
          hideAfter: 3000, 
          stack: 5, 
          position: 'bottom-center',
          
          textAlign: 'left',  
          loader: false, 
        });
      }
    })

    
  });

  $(".delete").click(function() {
    let item = $(this).parent().parent().parent()
    let itemID = $(this).data("itemid")

    $.ajax({
      url: `../deleteItem/${listID}`,
      type: 'DELETE',
      contentType: "application/json; charset=utf-8",
      data: {
        itemID: itemID,
        csrf_token: csrf_token
      }
    }).done(data => {
      data = JSON.parse(data);

      if (data.success) {
        item.remove()
      } else {
        $.toast({
          text: data.message, 
          
          icon: 'error',
          showHideTransition: 'fade', 
          allowToastClose: true,
          hideAfter: 3000, 
          stack: 5, 
          position: 'bottom-center',
          
          textAlign: 'left', 
          loader: false, 
        });
      }
    })



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

    if ((e.target.id !== 'modal-open' && $(e.target).parents('#modal-open').length === 0) &&
        (e.target.id !== "modal-content" && $(e.target).parents("#modal-content").length === 0)
    ) {
      $("#modal").fadeOut(200)
    }

  });

  // $(".addItem").submit(function(e) {
  //   e.preventDefault(e)

  //   let taskName = $('#taskName')
  //   let description = $("#description")
  //   let date = $("#datePick")

  //   if (date.length == 0) {
  //     date = ""
  //   } else {
  //     date = date.val()
  //   }


  //   $.post(`../addItem/${listID}`, {
  //     item: taskName.val(),
  //     description: description.val(),
  //     dueDate: date,
  //     csrf_token: csrf_token
  //   }, data => {
  //     data = JSON.parse(data)

  //     if (data.success) {
  //       let itemID = data.itemID;

  //       if (taskName.val().length > 0 && description.val().length > 0 && date.length > 0) {
  //         date = new Date(date)
  //         date = `${date.getDate()}-${date.getMonth()+1}-${date.getFullYear()}`
  //         let html = `
  //           <div class="
  //           w-11/12
  //           mx-auto
  //           sm:w-4/6
  //           mt-3
  //           rounded-xl
  //           bg-white
  //           px-8
  //           py-6
  //           drop-shadow-xl
  //           dark:bg-slate-800
  //         ">
  //           <div class="flex items-center">
  //             <div class="flex-1">
  //               <div class="flex items-center">
  //                 <div class="flex items-center h-5" data-itemid=${itemID}>
  //                   <input type="checkbox" class="checkItem rounded-full border-2 border-emerald-500 focus:ring-emerald-500 h-6 w-6 text-emerald-500">
  //                 </div>
  //                 <div class="ml-3 text-sm">
  //                   <label class="font-medium text-gray-700 dark:text-slate-100">${taskName.val()}</label>
  //                   <p class="text-gray-600 dark:text-slate-200">${description.val()}</p>
  //                 </div>
  //               </div>
        
  //               <div class="mt-4 mb-0">
  //                 <div class="inline-flex text-gray-800 dark:text-gray-100">
  //                   <p>Due: ${date}</p>
  //                 </div>
  //               </div>
  //             </div>
    
  //             <div class="ml-5 flex-shrink-0">
                
  //               <svg data-itemid="${itemID}" class="delete h-6 w-6 fill-red-600 hover:cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  //                 <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"/><path d="M9 9H11V17H9V9Z"  /><path d="M13 9H15V17H13V9Z"  />
  //               </svg>
    
  //             </div>
  //           </div>
      
  //         </div>
  //         `

          
  //         $("#list").prepend(html)
  //       } else if (taskName.val().length > 0 && description.val().length > 0 && date.length == 0) {
  //         let html = `
  //           <div class="
  //           w-11/12
  //           mx-auto
  //           sm:w-4/6
  //           mt-3
  //           rounded-xl
  //           bg-white
  //           px-8
  //           py-6
  //           drop-shadow-xl
  //           dark:bg-slate-800
  //           ">
  //             <div class="flex items-center">
  //               <div class="flex-1">
  //                 <div class="flex items-center">
  //                   <div class="flex items-center h-5" data-itemid=${itemID}>
  //                     <input type="checkbox" class="checkItem rounded-full border-2 border-emerald-500 focus:ring-emerald-500 h-6 w-6 text-emerald-500">
  //                   </div>
  //                   <div class="ml-3 text-sm">
  //                     <label class="font-medium text-gray-700 dark:text-slate-100">${taskName.val()}</label>
  //                     <p class="text-gray-600 dark:text-slate-200">${description.val()}</p>
      
  //                   </div>
  //                 </div>
  //               </div>
      
  //               <div class="ml-5 flex-shrink-0">
                  
  //                 <svg data-itemid="${itemID}" class="delete h-6 w-6 fill-red-600 hover:cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  //                   <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"/><path d="M9 9H11V17H9V9Z"  /><path d="M13 9H15V17H13V9Z"  />
  //                 </svg>
      
  //               </div>
  //             </div>
        
  //           </div>
  //         `
  //         $("#list").prepend(html)

  //       } else if (taskName.val().length > 0 && description.val().length == 0 && date.length > 0) {
  //         date = new Date(date)
  //         date = `${date.getDate()}-${date.getMonth()+1}-${date.getFullYear()}`
  //         let html = `
  //           <div class="
  //             w-11/12
  //             mx-auto
  //             sm:w-4/6
  //             mt-3
  //             rounded-xl
  //             bg-white
  //             px-8
  //             py-6
  //             drop-shadow-xl
  //             dark:bg-slate-800
  //           ">
  //             <div class="flex items-center">
  //               <div class="flex-1">
  //                 <div class="flex items-center">
  //                   <div class="flex items-center h-5" data-itemid=${itemID}>
  //                     <input type="checkbox" class="checkItem rounded-full border-2 border-emerald-500 focus:ring-emerald-500 h-6 w-6 text-emerald-500">
  //                   </div>
  //                   <div class="ml-3 text-sm">
  //                     <label class="font-medium text-gray-700 dark:text-slate-100">${taskName.val()}</label>
  //                   </div>
  //                 </div>
          
  //                 <div class="flex mt-4 mb-0">
  //                   <div class="inline-flex text-gray-800 dark:text-gray-100">
  //                     <p>Due: ${date}</p>
  //                   </div>
                    
  //                 </div>
  //               </div>
      
  //               <div class="ml-5 flex-shrink-0">
                  
  //                 <svg data-itemid="${itemID}" class="delete h-6 w-6 fill-red-600 hover:cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  //                   <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"/><path d="M9 9H11V17H9V9Z"  /><path d="M13 9H15V17H13V9Z"  />
  //                 </svg>
      
  //               </div>
  //             </div>
        
  //           </div>
  //         `
  //         $("#list").prepend(html)
  //       } else if (taskName.val().length > 0 && description.val().length == 0 && date.length == 0) {
  //         let html = `
  //           <div class="
  //             w-11/12
  //             mx-auto
  //             sm:w-4/6
  //             mt-3
  //             rounded-xl
  //             bg-white
  //             px-8
  //             py-6
  //             drop-shadow-xl
  //             dark:bg-slate-800
  //         ">
  //           <div class="flex items-center">
  //             <div class="flex-1">
  //               <div class="flex items-center">
  //                 <div class="flex items-center h-5" data-itemid=${itemID}>
  //                   <input type="checkbox" class="checkItem rounded-full border-2 border-emerald-500 focus:ring-emerald-500 h-6 w-6 text-emerald-500">
  //                 </div>
  //                 <div class="ml-3 text-sm">
  //                   <label class="font-medium text-gray-700 dark:text-slate-100">${taskName.val()}</label>
  //                 </div>
  //               </div>
  //             </div>
    
  //             <div class="ml-5 flex-shrink-0">
                
  //               <svg data-itemid="${itemID}" class="delete h-6 w-6 fill-red-600 hover:cursor-pointer" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  //                 <path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"/><path d="M9 9H11V17H9V9Z"  /><path d="M13 9H15V17H13V9Z"  />
  //               </svg>
    
  //             </div>
  //           </div>
      
  //         </div>
  //         `

  //         $("#list").prepend(html)
  //       } 

  //       $("input[type='date']").prop({type:"text", placeholder: "dd.mm.yyyy", value: ""})
  //       taskName.val("")
  //       description.val("")

        
  //       $("#modal").hide(200)
        
  //       $("#script").remove();
  //       $("body").append(`<script src="${base}/assets/js/viewlist.js" id="script"></script>`)
        
  //       $.toast({
  //         text: "Item added successfully.", 
          
  //         icon: 'success',
  //         showHideTransition: 'fade',
  //         allowToastClose: true, 
  //         hideAfter: 1500,
  //         stack: 5, 
  //         position: 'bottom-center', 
              
  //         textAlign: 'left',
  //         loader: true,
  //         loaderBg: '#34d399', 
          
  //     });

  //     } else {
  //       $.toast({
  //         text: data.message, 
          
  //         icon: 'error', 
  //         showHideTransition: 'fade',
  //         allowToastClose: true, 
  //         hideAfter: 3000,
  //         stack: 5, 
  //         position: 'bottom-center', 
          
  //         textAlign: 'left', 
  //         loader: false, 
  //       });
  //     }
  //   })

  // })

  $("#datePick").mouseover(function() {
      $(this).prop("type", "date")

    })
  
    $(".copyUrl").click(() => {
        let input = $(".listUrl");
  
        input.select();

        navigator.clipboard.writeText(input.val());
  
        document.getSelection().removeAllRanges();
  
        $.toast({
          text: "Link copied",
          
          icon: 'info', 
          showHideTransition: 'fade',
          allowToastClose: true, 
          hideAfter: 3000, 
          stack: 5,
          position: 'bottom-right', 
          
          
          
          textAlign: 'left', 
          loader: false, 
      });
              
    })
})