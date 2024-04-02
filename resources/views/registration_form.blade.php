<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Facebook</title>
</head>
<body style="background-color: #F2F3F5;">
    <div class="container">
        <div class="row vertical-center mt-5 pt-5">
            <div class="col-md-6">
                <h1 class="text-primary">facebook</h1>
                <p>Facebook helps you connect and share with the people in your life.</p>
            </div>
            <div class="col-md-6">
                <div class="signup-form">
                    <h2>Registration</h2>
                    <form action="" method="POST">
                      @csrf
                      <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Enter Name</label>
                        <input type="text" name="name" id="form2Example1" class="form-control" />
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Email Address</label>
                        <input type="email" name="email" id="form2Example1" class="form-control" />
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">Password</label>
                        <input type="password" name="password" id="form2Example2" class="form-control" />
                      </div>
                      <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">Password</label>
                        <input type="password" name="password_confirmation" id="form2Example2" class="form-control" />
                      </div>
                      <input type="submit" class="btn btn-primary btn-block mb-4" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="footer-links">
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-6 text-md-right">
                    <p>&copy; 2024 Facebook. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
