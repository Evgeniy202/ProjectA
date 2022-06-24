<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sing in to administration panel</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark">
    <div class="container text-light" style="margin-bottom: 200px; margin-top: 160px">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center">Sign in</h3>
            <hr>
            <form action="/admin/adm/login/check" method="POST">
                @csrf
                <div class="form-group mt-3">
                    <input style="text-align: center" type="text" name="login" id="login" placeholder="login..." class="form-control">
                </div>
                <div class="form-group mt-3">
                    <input style="text-align: center" type="password" name="password" id="password" placeholder="Your password..." class="form-control">
                </div>
                <hr>
                <input type="submit" class="btn btn-success btn-block col-12" value="Sign in">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>