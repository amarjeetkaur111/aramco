
    $('.already_approved').on('click',function(){
        $.confirm({
          title: '', // Change "text" to "title"
          content: 'Your request for cancellation has been already sent to admin.',
          buttons: {
            Ok: function () {
              // Code to be executed when the user clicks "Ok"
            }
          }
        });
    })

    function successMsg(type,msgg){
        if(type == 1){
          $.confirm({
            title: '', // Change "text" to "title"
            content: msgg,
            buttons: {
              Ok: function () {
                // Code to be executed when the user clicks "Ok"
                location.reload();
              }
            }
          });
        }else if(type == 2){
          $.confirm({
            title: '', // Change "text" to "title"
            content: msgg,
            buttons: {
              Ok: function () {
                // Code to be executed when the user clicks "Ok"
                location.reload();
              }
            }
          });
        }
        
      }

      $('.delete-request').on('click', function () {
        var req_id = $(this).attr('data-id');
        var req_type = $(this).attr('data-type');
        $.confirm({
          title: 'Delete',
          content: 'Are you sure you want to cancel this request.', // Add your custom message here
          buttons: {
            Yes: function () {
              // Code to be executed when the user clicks "Ok" (i.e., selects "Yes")
              
              // Additional data to be sent in the request
              var additionalData = {
                id: req_id,
                field2: req_type
              };
              
              // Call your route or perform the desired action here
              // For example, using jQuery's AJAX to call a route:
              $.ajax({
                url: route,
                type: 'GET', // or 'POST', depending on your route configuration
                data: additionalData, // Sending additional data in the request
                success: function (data) {
                  // Handle the success response here
                  console.log(data);
                  if(data.status == "Success"){
                    successMsg('1',data.msg)
                  }else{
                    successMsg('2',data.msg)
                  }
                  // location.reload;
                  // alert('saved')
                },
                error: function (error) {
                  // Handle the error here
                }
              });
            },
            Cancel: function () {
              // Code to be executed when the user clicks "Cancel" (optional)
            }
          }
        });
      });
 