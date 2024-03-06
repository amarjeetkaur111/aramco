<div class="offcanvas w-100 offcanvas-start offcanvas-top"  data-bs-scroll="true" data-bs-backdrop="false" id="notificationDrop">
    <div class="offcanvas-header border-bottom" style="align-items: start;">
          <div class="notiDropBellContainer">
              <span class="fa-stack me-3 float-start" style="vertical-align: top;color: #00A3E0;">
                  <i class="fa-solid fa-circle fa-stack-2x"></i>
                  <i class="fa-solid fa-bell fa-stack-1x fa-inverse"></i>
              </span>
              <div class=" notiDropBellText"> Your browser has blocked notifications from Aramco Website. Please go to your browser's settings and allow notifications for this website. </div>
          </div>
      <button type="button" class="btn-close notificationDrop-close ms-2 me-1" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
  </div>

<footer class="footer">

	<div class="footer__container container">

		<div class="footer__navigation">
			<h3>Behind D&IT Excellence Lab</h3>
			<ul>
				<li><a href="{{ route('about-lab', ['pageid'=>'1']) }}" title="About">About</a></li>
				<li><a href="{{ route('terms') }}" title="Terms">Terms</a></li>
				<li><a href="{{ route('privacy') }}" title="Privacy">Privacy</a></li>
				<li><a href="{{ route('cookies') }}" title="Cookies">Cookies</a></li>
				<li><a href="#" title="Help">Help</a></li>
			</ul>
		</div>
		<div class="footer__social">
			<h3>Connect us on</h3>
			<ul>
				<li>
					<a href="https://www.linkedin.com/company/aramco/" class="footer__social__linkedin" title="LinkedIn" target="_blank" rel="noreferrer">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M9.429 8.969H13.143V10.819C13.678 9.755 15.05 8.799 17.111 8.799C21.062 8.799 22 10.917 22 14.803V22H18V15.688C18 13.475 17.465 12.227 16.103 12.227C14.214 12.227 13.429 13.572 13.429 15.687V22H9.429V8.969ZM2.57 21.83H6.57V8.799H2.57V21.83ZM7.143 4.55C7.14315 4.88528 7.07666 5.21724 6.94739 5.52659C6.81812 5.83594 6.62865 6.11651 6.39 6.352C5.9064 6.83262 5.25181 7.10165 4.57 7.1C3.88939 7.09954 3.23631 6.8312 2.752 6.353C2.51421 6.11671 2.32539 5.83582 2.19634 5.52643C2.0673 5.21704 2.00058 4.88522 2 4.55C2 3.873 2.27 3.225 2.753 2.747C3.23689 2.26816 3.89024 1.9997 4.571 2C5.253 2 5.907 2.269 6.39 2.747C6.872 3.225 7.143 3.873 7.143 4.55Z" fill="#00A3E0" />
						</svg>
					</a>
				</li>
				<li>
					<a href="https://www.twitter.com/aramco" class="footer__social__twitter" title="Twitter" target="_blank" rel="noreferrer">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M18.205 2.25H21.513L14.286 10.51L22.788 21.75H16.13L10.916 14.933L4.94997 21.75H1.63997L9.36997 12.915L1.21497 2.25H8.03997L12.753 8.481L18.203 2.25H18.205ZM17.044 19.77H18.877L7.04497 4.126H5.07797L17.044 19.77Z" fill="#00A3E0" />
						</svg>
					</a>
				</li>
				<li>
					<a href="https://www.facebook.com/aramco" class="footer__social__fb" title="Facebook" target="_blank" rel="noreferrer">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M15.12 5.32003H17V2.14003C16.0897 2.04538 15.1751 1.99865 14.26 2.00003C11.54 2.00003 9.67999 3.66003 9.67999 6.70003V9.32003H6.60999V12.88H9.67999V22H13.36V12.88H16.42L16.88 9.32003H13.36V7.05003C13.36 6.00003 13.64 5.32003 15.12 5.32003Z" fill="#00A3E0" />
						</svg>
					</a>
				</li>
			</ul>
		</div>

	</div>
</footer>

</main>
</div>

<script src="{{asset('assets/web/js/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('assets/web/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://kit.fontawesome.com/70d4a5351c.js" crossorigin="anonymous"></script>
<script src="{{asset('assets/web/js/aramco.js')}}"></script>
<script src="{{asset('assets/web/js/classie.js')}}"></script>
<script src="{{asset('assets/web/js/main3.js')}}"></script>
<script src="{{asset('assets/web/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/web/js/parsley.min.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="{{asset('assets/web/js/user_access.js')}}"></script>


<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-analytics.js"></script>

@php

if(Auth::id()){



$usersD = Auth()->id();
$roleUser = getRoleName($usersD);


@endphp


            <script>


        var UserRole = "{{trim($roleUser)}}";
        var myArray = ['Admin','Super Admin','Full Access User'];
        var index =  $.inArray(UserRole, myArray);

        if(index !== -1){

                    navigator.permissions.query({
                                name: 'notifications',
                                }).then(function(permission) {
                                if (permission.state === 'granted') {






                                            const firebaseConfig = {
                                                apiKey: "AIzaSyDteFX7PR66KWPnPVwh014CUt3SK5zz41c",
                                                authDomain: "aramco-3e6ad.firebaseapp.com",
                                                projectId: "aramco-3e6ad",
                                                storageBucket: "aramco-3e6ad.appspot.com",
                                                messagingSenderId: "346867505533",
                                                appId: "1:346867505533:web:3a9441714b2e2d3f609414",
                                                measurementId: "G-QXD0YFGG7C"
                                            };
                                            // Initialize Firebase
                                            firebase.initializeApp(firebaseConfig);
                                            const messaging = firebase.messaging();
                                            console.log(messaging)


                                                        // The user has granted the notification permission


                                            messaging.onMessage(function(payload) {
                                                // console.log('on message');
                                                // console.log(payload);
                                                const title = payload.notification.title;
                                                const options = {
                                                    body: payload.notification.body,
                                                    icon: payload.notification.icon,
                                                };
                                                var notice = new Notification(title, options);
                                                console.log(notice);
                                            });



                                            messaging.requestPermission()
                                                        .then(function() {
                                                            return messaging.getToken()
                                                        })
                                                        .then(function(response) {
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                }
                                                            });
                                                            $.ajax({
                                                                url: '{{ route("fcmToken") }}',
                                                                type: 'POST',
                                                                data: {
                                                                    token: response
                                                                },
                                                                dataType: 'JSON',
                                                                success: function(response) {
                                                                    // alert('Token stored.');
                                                                    console.log('Token stored.');
                                                                },
                                                                error: function(error) {
                                                                    // alert(error);
                                                                },
                                                            });
                                                        }).catch(function(error) {
                                                            // alert(error);
                                                        });


                                } else {
                                    // The user has not granted the notification permission

                                        //    alert("permissions from browser not granted");

                                        $("#notificationDrop").addClass("show");
                                }


                    });
        }


            </script>

@php

}
@endphp
<script>

	$(document).on('click','#searchClose',function(){
		$('.searchBoxInput').val('');
		$('#results___').html('');
	})
</script>




