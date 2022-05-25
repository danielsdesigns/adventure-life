<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <h2 class="mt-5 text-center">Adventure Life <br />Event Calendar</h2>
            <div class="card mt-5">
                <div class="card-body">
                    <h3>Sign In</h3>
                    <?php if(!empty($error)){?>
                        <div class="alert alert-danger m-3" role="alert">
                            Login Failed! Please double check your details.
                        </div>
                    <?php } ?>
                    <form method="post" action="/authorize">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="E-mail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Password" name="password"/>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Login" class="btn btn-sm btn-primary"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>