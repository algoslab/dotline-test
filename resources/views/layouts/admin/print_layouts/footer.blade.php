


      

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin_asset/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/custom.js') }}"></script>
    @yield('script')
    <script>
        window.print();
        setTimeout(window.close, 3000);
   </script>  
</body>

</html>
