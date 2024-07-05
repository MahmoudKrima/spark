 <!-- jQuery -->
 <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="{{ asset('assets') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
     $.widget.bridge('uibutton', $.ui.button)
 </script>
 <!-- Bootstrap 4 -->
 <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- ChartJS -->
 <script src="{{ asset('assets') }}/plugins/chart.js/Chart.min.js"></script>
 <!-- Sparkline -->
 <script src="{{ asset('assets') }}/plugins/sparklines/sparkline.js"></script>
 <!-- JQVMap -->
 <script src="{{ asset('assets') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
 <script src="{{ asset('assets') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
 <!-- jQuery Knob Chart -->
 <script src="{{ asset('assets') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
 <!-- daterangepicker -->
 <script src="{{ asset('assets') }}/plugins/moment/moment.min.js"></script>
 <script src="{{ asset('assets') }}/plugins/daterangepicker/daterangepicker.js"></script>
 <!-- Tempusdominus Bootstrap 4 -->
 <script src="{{ asset('assets') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
 <!-- Summernote -->
 <script src="{{ asset('assets') }}/plugins/summernote/summernote-bs4.min.js"></script>
 <!-- overlayScrollbars -->
 <script src="{{ asset('assets') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- AdminLTE App -->
 <script src="{{ asset('assets') }}/dist/js/adminlte.js"></script>
 <!-- AdminLTE for demo purposes -->
 <script src="{{ asset('assets') }}/dist/js/demo.js"></script>
 <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 <script src="{{ asset('assets') }}/dist/js/pages/dashboard.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

 <script src="{{ asset('vendor/toastr/build/toastr.min.js') }}"></script>
 <script>
     toastr.options = {
         "closeButton": false,
         "debug": false,
         "newestOnTop": false,
         "progressBar": false,
         "positionClass": "toast-top-right",
         "preventDuplicates": false,
         "onclick": null,
         "showDuration": "300",
         "hideDuration": "1000",
         "timeOut": "5000",
         "extendedTimeOut": "1000",
         "showEasing": "swing",
         "hideEasing": "linear",
         "showMethod": "fadeIn",
         "hideMethod": "fadeOut"
     }

     @if (session()->has('Success'))
         toastr.success('{{ session()->get('Success') }}');
     @endif
     @if (session()->has('Error'))
         toastr.error('{{ session()->get('Error') }}');
     @endif

     @if (session()->has('Warn'))
         toastr.warning('{{ session()->get('Warn') }}');
     @endif

     @if ($errors->any())
         @foreach ($errors->all() as $error)
             toastr.error('{{ $error }}');
         @endforeach
     @endif

     $('.btn-delete').on('click', function(e) {
         e.preventDefault();
         var form = $(this).closest('form');

         var url = form.attr('action');
         var method = form.attr('method');
         swal({
             title: 'Are You Sure ?',
             icon: 'warning',
             buttons: ["No", "Yes"],
         }).then(function(value) {
             if (value) {
                 form.submit();
             }
         });
     });
 </script>
 @yield('js')
