<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Sign In</title>
</head>
<body class="bg-dark">
    <div class="container text-light" style="margin-bottom: 50px; margin-top: 50px">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center">Sign In</h3>
            <hr>
            <form action="#" method="post">
                @csrf
                <div class="form-group mt-3">
                    <input type="text" name="login" id="login" placeholder="login..." class="form-control">
                </div>
                <div class="form-group mt-3">
                    <input type="text" name="email" id="email" placeholder="email..." class="form-control">
                </div>
                <div class="form-group mt-3">
                    <input type="password" name="password" id="password" placeholder="Your password..." class="form-control">
                </div>
                <div class="form-group mt-3">
                    <input type="password" name="repPassword" id="repPassword" placeholder="Repeat password..." class="form-control">
                </div>
                <hr>
                <input type="submit" class="btn btn-success btn-block col-12" value="To confirm">
            </form>
        </div>
    </div>
</body>
</html>