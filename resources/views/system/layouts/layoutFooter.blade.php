  <!-- Footer opened -->
  <a href="#top" id="back-to-top"><i class="la la-chevron-up"></i></a>

  <script src="{{asset('js/jquery.min.js')}}"></script>

  <!-- Bootstrap js-->
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

  <!-- Ionicons js-->
  <script src="{{asset('js/ionicons.js')}}"></script>

  <!-- Moment js -->
  <script src="{{asset('js/moment.js')}}"></script>

  <!-- P-scroll js -->
  <script src="{{asset('js/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('js/p-scroll.js')}}"></script>

  <!-- Rating js-->
  <script src="{{asset('js/jquery.rating-stars.js')}}"></script>
  <script src="{{asset('js/jquery.barrating.js')}}"></script>

  <!-- Custom Scroll bar Js-->
  <script src="{{asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>

  <!-- eva-icons js -->
  <script src="{{asset('js/eva-icons.min.js')}}"></script>

  <!-- Sidebar js -->
  <script src="{{asset('js/sidemenu.js')}}"></script>

  <!-- Right-sidebar js -->
  <script src="{{asset('js/sidebar.js')}}"></script>
  <script src="{{asset('js/sidebar-custom.js')}}"></script>

  <!-- Sticky js-->
  <script src="{{asset('js/sticky.js')}}"></script>


  <!-- Datepicker js -->
  <script src="{{asset('js/datepicker.js')}}"></script>

  <!--Chart bundle min js -->
  <script src="{{asset('js/Chart.bundle.min.js')}}"></script>
  <script src="{{asset('js/raphael.min.js')}}"></script>
  <script src="{{asset('js/jquery.peity.min.js')}}"></script>

  <!-- JQuery sparkline js -->
  <script src="{{asset('js/jquery.sparkline.min.js')}}"></script>

  <!-- Sampledata js -->
  <script src="{{asset('js/chart.flot.sampledata.js')}}"></script>

  <!-- Perfect-scrollbar js -->
  <script src="{{asset('js/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('js/p-scroll.js')}}"></script>

  <!-- Internal  Flot js-->
  <script src="{{asset('js/jquery.flot.js')}}"></script>
  <script src="{{asset('js/jquery.flot.pie.js')}}"></script>
  <script src="{{asset('js/jquery.flot.categories.js')}}"></script>
  <script src="{{asset('js/dashboard.sampledata.js')}}"></script>
  <script src="{{asset('js/chart.flot.sampledata.js')}}"></script>

  <!-- Internal Newsticker js-->
  <script src="{{asset('js/jquery.jConveyorTicker.js')}}"></script>
  <script src="{{asset('js/newsticker.js')}}"></script>

  <!-- Internal Nice-select js-->
  <script src="{{asset('js/jquery.nice-select.js')}}"></script>
  <script src="{{asset('js/nice-select.js')}}"></script>

  <!-- index js -->
  <script src="{{asset('js/dashboard.js')}}"></script>


  <!-- Custom js-->
  <script src="{{asset('js/custom.js')}}"></script>

  <!-- Switcher js -->
  <script src="{{asset('js/switcher.js')}}"></script>

  <!-- Script Principal -->
  <script src="{{asset('js/main-script.js')}}"></script>
  <script src="{{ asset('compiledCssAndJs/js/system.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script src="{{ asset('toast/jquery.toast.min.js')}}"></script>
  <script>
  $(function() {
    var check = `{{$errors->first('success')}}`;
    if (check !== "") {
      $.toast({
        heading: 'success',
        text: `{{$errors->first('success')}}`,
        showHideTransition: 'plain',
        icon: 'success',
        position: 'top-right',
      });
    }

    let sideBarState = localStorage.getItem('sidebarToggle')
    if (sideBarState == 1) {
      $(".page-wrapper").addClass('toggle-page')
    }
  })

  $(".toggle-button").on('click', function() {
    let sideBarState = localStorage.getItem('sidebarToggle')
    if (sideBarState == 0) localStorage.setItem('sidebarToggle', 1)
    if (sideBarState == 1) localStorage.setItem('sidebarToggle', 0)
    $(".page-wrapper").toggleClass("toggle-page")
  })

</script>