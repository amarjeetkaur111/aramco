    <!-- Footer -->
      <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
          <div class="mb-2 mb-md-0">
            ©
            <script>
              document.write(new Date().getFullYear());
            </script>
          </div>
        </div>
      </footer>
      <!-- / Footer -->
      <div class="content-backdrop fade"></div>
    </div>
        </div>
      </div>
     <!-- Content wrapper -->
     </div>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <!-- Datatables JS -->
    <script src="{{ asset('assets/vendor/js/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/datatables/dataTables.bootstrap4.min.js')}}"></script>


    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js')}}"></script>
    <script src="{{ asset('assets/js/pages-account-settings-account.js')}}"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
          // document.getElementById("hamMenu").style.display = "none";

          function openNav() {
      console.log('openNav')
      console.log(document.getElementById("layout-menu").style)
      document.getElementById("layout-menu").style.display = "block";
      document.getElementById("layout-menu").style.width = "250px";
      document.getElementById("side-html").style.paddingLeft = "260.5px";
      document.getElementById("hamMenu").style.display = "none";
 
    }
        </script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>    
<script>

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

    messaging.onMessage(function (payload) {
      // console.log('on message');
      // console.log(payload);
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
      var notice =  new Notification(title, options);  
      console.log(notice);      
    });
	</script>
