<?php $this->render('base-head'); ?>
<body class="bg-gradient-primary">

    <div class="container">
    <?php $this->render('errors'); ?>
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
                                    </div>
                                    <form class="user" action="<?php $this->route('/login'); ?>" method="POST">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control form-control-user"
                                                name="username"
                                                placeholder="Username"
                                                value="<?php $this->value('username'); ?>"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <input
                                                type="password"
                                                class="form-control form-control-user"
                                                name="password"
                                                placeholder="Password"
                                                value="<?php $this->value('password'); ?>"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input"
                                                    id="rememberCheck"
                                                    name="remember_me"
                                                    value="true"
                                                    <?php $this->checked('remember_me'); ?>
                                                >
                                                <label
                                                    class="custom-control-label"
                                                    for="rememberCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?php $this->route('/register'); ?>">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>

</html>