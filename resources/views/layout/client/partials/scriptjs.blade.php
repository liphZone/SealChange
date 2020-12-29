<!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('AdminTemplate/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('AdminTemplate/assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('AdminTemplate/assets/js/shared/off-canvas.js') }}"></script>
    <script src="{{ asset('AdminTemplate/assets/js/shared/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('AdminTemplate/assets/js/demo_1/dashboard.js') }}"></script>
    <!-- End custom js for this page-->

<script>
        function closeModal() {
    var modal = document.getElementById('modal');
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function showModal() {
    var modal = document.getElementById('modal');
    modal.style.display = "block";
}

</script>