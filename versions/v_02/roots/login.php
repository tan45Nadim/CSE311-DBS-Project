<?php
  error_reporting(0);
  session_start();
  include('../includes/header.php');
?>

<div class="container">
<!-- Outer Row -->
<div class="row justify-content-center">
  <div class="col-xl-7 col-lg-7 col-md-7">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-1">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
                <?php
                    if (isset($_SESSION['status']) && $_SESSION['status'] !='') {
                        echo '<h4 class="bg-danger text-white"> '.$_SESSION['status'].' </h4>';
                        unset($_SESSION['status']);
                    }
                ?>
              </div>
                <form class="user" action="source-codes.php" method="POST">
                    <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-user" placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group">
                    <br>
                    <input type="password" name="pass_word" class="form-control form-control-user" placeholder="Password" required>
                    </div>
                    <br>
                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Login </button>
                    <hr>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php
    include('../includes/footer.php');
?>