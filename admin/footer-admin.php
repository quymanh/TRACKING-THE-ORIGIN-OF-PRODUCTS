<?php if ($_SESSION['role'] == '0' || $_SESSION['role'] == '1') { ?>
    <!-- Footer -->
    <div class="container-fluid my-auto">
        <footer class="card sticky-footer bg-white mt-4">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; QD Media</span>
            </div>
        </footer>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<?php 
    }else{
        header("Location: ".BASE_URL);
        exit();
}
?>
