<section class="home">
    <div class="container">
        <h1 class="font-new-rocker text-uppercase"><?= $setting['nama_website'] ?></h1>
        <p class="font-neucha text-uppercase"><?= $setting['tagline'] ?></p>
        <?php 
            if(isset($_SESSION['login_user']) <> true) {
        ?>
            <div class="d-grid gap-2 d-md-block d-sm-block mt-5">
                <a href="index.php?p=login" class="btn btn-custom font-nerko-one mr-3">Login</a>
                <a href="index.php?p=register" class="btn btn-custom font-nerko-one ml-3">Register</a>
            </div>
        <?php
            }
        ?>
    </div>
</section>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>