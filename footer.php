<footer class="container">
    <div class="row">
        <div class="col-6">
            <p>
                &copy; 2021 Company, Inc. - 
                <a href="#" class="text-info link-footer">Privacy</a>
                -
                <a href="#" class="text-info link-footer">Terms</a>
            </p>
        </div>
        <div class="col-6">
            <p class="back">
                <a href="#" class="text-info link-footer">Back to Top</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <p>Follow Us</p>
        </div>
        <div class="col-6">
            <small class="footer-sentence">Made with <i class="far fa-heart"></i> & <i class="fas fa-mug-hot"></i> by <em>Junior</em> </small>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <a href="https://instagram.com/lokutor_17" class="text-info link-footer social"><i class="fab fa-instagram"></i></a>
            <a href="https://github.com/Lokutor" class="text-info link-footer social"><i class="fab fa-github"></i></a>
            <a href="https://abakode.com" class="text-info link-footer social"><i class="fas fa-globe"></i></a>
        </div>
    </div>
    
</footer>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                        form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    
    <!------------------Ajax-------------------->
    <script src="ajax.js?v=3.48"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
</body>
</html>