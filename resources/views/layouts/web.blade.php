<!doctype html>
<html lang="en" data-assets-path="../assets/">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/web/images/favicon.jpg') }}" />
    <title>D&IT Lab Excellence</title>
    @include('includes.frontweb.header')    
    @yield('content')
    @include('includes.frontweb.sidebar') 
    @include('includes.frontweb.footer')    
    @include('includes.frontweb.searchmodal')  
    @include('includes.frontweb.membershipmodal')  
    @include('includes.frontweb.profilemodal')    
    @stack('custom-scripts')
	</body>
  <script>
      var today = new Date().toISOString().split('T')[0];
      
      // Set the minimum date for the input element to today
      document.getElementById('startDate').min = today;
      document.getElementById('endDate').min = today;
    </script>
</html>