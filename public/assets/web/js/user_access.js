
    $(document).on('click', '.userAccess', function (e) {
// alert('skjgjk');
    var hrefff = $(this).attr('data-href');
    var linktype = $(this).attr('link-type');


    
//    alert(href)
            $.ajax({
                type: 'GET',
                url: accessUrl, // Replace with the route to trigger the middleware
                data:{ linktype:linktype },
                success: function (response) {
                //  alert(response)
                    if (response==0) {

                        e.preventDefault();
                        $.alert({
                            title: 'Access denied!',
                            content: "You don't have access for this request.",
                        });
                    }else if(response==2){
                        window.location.href = loginUrl;
                    }
                    else{

                        // alert(hrefff)
                        window.location.href = hrefff
                    }
                }
            });
        });
 