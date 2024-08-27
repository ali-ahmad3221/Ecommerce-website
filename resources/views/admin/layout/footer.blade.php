<!-- plugins:js -->
<script src="{{asset('adminassets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{asset('adminassets/vendors/chart.js')}}"></script>
<script src="{{asset('adminassets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('adminassets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('adminassets/js/dataTables.select.min.js')}}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('adminassets/js/off-canvas.js')}}"></script>
<script src="{{asset('adminassets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('adminassets/js/template.js')}}"></script>
<script src="{{asset('adminassets/js/settings.js')}}"></script>
<script src="{{asset('adminassets/js/todolist.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{asset('adminassets/js/dashboard.js')}}"></script>
<script src="{{asset('adminassets/js/Chart.roundedBarCharts.js')}}"></script>
<!-- End custom js for this page-->

<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this product?')) {
            // Code for deleting the product
            alert('Product deleted successfully!');
        }
    }
</script>
