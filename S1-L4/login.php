<?php require_once ("header.php"); ?>
<?php require_once ("navbar.php"); ?>

<div class="d-flex justify-content-center mt-4">
<form method="POST" class="g-3 needs-validation m-3" action="gestione.php?mode=login" enctype="multipart/form-data"
        novalidate>
        <div class="col mb-4">
            <label for="validationCustomUsername" class="form-label">Username</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" class="form-control" name="username" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Please Enter a username.
                </div>
            </div>
        </div>
       
        <div class="col mb-4">
            <label for="validationCustom06" class="form-label">Password</label>
            <input type="password" class="form-control" name="password"  required>
            <div class="invalid-feedback">
                Please provide a valid Password
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Log in</button>
        </div>
    </form>
</div>

<?php require_once ("footer.php"); ?>