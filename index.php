<?php include('includes/common-head.php'); ?>
    <title>Admin Login</title>
  </head>
  <body>
    <div class="wrapper">
      <h1>Admin Login</h1>
      <div class="form-container">
        <form action="login.php" method="POST">
          <div class="form-group">
            <label for="adm_email">Email</label>
            <input id="adm_email" class="error" type="email" name="adm_email" placeholder="Enter Admin Email" />
            <div class="adm_email-error error-description"></div>
          </div>
          <div class="form-group">
            <label for="adm_password">Password</label>
            <input id="adm_password" class="error" type="password" name="adm_password" placeholder="Enter Admin Password" />
            <div class="adm_password-error error-description"></div>
          </div>
          <div class="form-group">
            <input type="submit" onclick="validateInput()" value="Login" />
            <div class="error-description"></div>
          </div>
        </form>
        <div class="other-links">
          <div class="other-link forget-pwd"><a href="">Forgot Password?</a></div>
          <div class="other-link create-new-account"><a href="/signup">Create New Account</a></div>
        </div>
      </div>
    </div>

    <script src="js/main.js"></script>
  </body>
</html>
