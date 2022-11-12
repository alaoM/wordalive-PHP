<?php
if (isset($_COOKIE["jwt"])) {
  require_once('assets/includes/libs.php');
  $user = $database->validate($_COOKIE["jwt"]);
  if ($user===false) { setcookie("jwt", null, -1); }
  else { header("Location: index.php"); exit(); }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit." />

  <title>:: Word Alive Admin :: Sign In</title>
  <!-- Favicon-->
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <!-- Custom Css -->
  <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/style.min.css" />
</head>

<body class="theme-blush">
  <div class="authentication">
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-lg-4 col-sm-12 ">
          <form id="login" class="card auth_form" enctype="multipart/form-data">
            <div class="header">
              <img class="logo" src="assets/images/logo.png" alt="logo" />
              <h5>Log in</h5>
              <div id="error" class="col-12">
                <div class="alert alert-warning" role="alert">
                   <strong class="error"></strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
                    </button>
                </div>
            </div>
            </div>
            <div class="body">
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="email" placeholder="Email" />
                <div class="input-group-append">
                  <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" required placeholder="Password" />
                <div class="input-group-append">
                  <span class="input-group-text"><i class="zmdi zmdi-lock"></i>
                  </span>
                </div>
              </div>
              <input id="submit" type="submit" value="SIGN IN"
                class="btn btn-primary btn-block waves-effect waves-light" />
            </div>
          </form>
          <div class="copyright text-center">
            &copy;
            <script>
              document.write(new Date().getFullYear());
            </script>
            ,
            <span>Word Alive</span>
          </div>
        </div>

      </div>
    </div>
  </div>


 
  <script src="assets/bundles/libscripts.bundle.js"></script>
  <script src="assets/bundles/vendorscripts.bundle.js"></script>
  <script src="assets/js/pages/forms/main.js"></script>
</body>

</html>