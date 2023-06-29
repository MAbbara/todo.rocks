$(document).ready(() => {
    $(".newListForm").submit(function(e) {
        e.preventDefault(e)
        let listName = $("#listName").val().trim()

        if (listName) {
            $.post(`create/${listName}`, {
                csrf_token: csrf_token
            }, data => {
                data = JSON.parse(data)

                if (data.success) {
                    
                    $.toast({
                        text: "List created successfully, redirecting.", // Text that is to be shown in the toast
                        
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'bottom-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#34d399',  // Background color of the toast loader
                        
                    });

                    setTimeout(function() {
                        window.location.replace("view/"+data.listID);
                    }, 3000);

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
        } else {
            $("#listName").val("");
            $.toast({
                text: "Fill out list name.", // Text that is to be shown in the toast
                
                icon: 'warning', // Type of toast icon
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