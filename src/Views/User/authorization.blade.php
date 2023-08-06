<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" , initial-scale="1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Авторизация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
<div class="container mt-4">
    <h1>Авторизация</h1>
    <form method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Введите email</label>
            <input type="text" class="form-control" name="email" id="email">
        </div>
        <div class="mb-3">
            <label for="Pass" class="form-label">Пароль</label>
            <input type="password" class="form-control" name="pass" id="Pass">
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>

    @if ($msg != '')
        <div class="alert alert-danger mt-4" role="alert">
            {{$msg}}
        </div>
    @endif

</div>
</body>
</html>