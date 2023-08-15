<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" , initial-scale="1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Добавить книгу</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
<div class="container mt-4">
    <h1>Добавить книгу</h1>
    <form method="post">
        <div class="mb-3">
            <label for="Name" class="form-label">Название книги</label>
            <input type="text" class="form-control" name="name" id="Name">
        </div>
        <div class="mb-3">
            <label for="Author" class="form-label">Автор</label>
            <input type="author" class="form-control" name="author" id="Author">
        </div>
        <div class="mb-3">
            <label for="Edition" class="form-label">Издание</label>
            <input type="edition" class="form-control" name="edition" id="Edition">
        </div>
        <div class="mb-3">
            <label for="Year" class="form-label">Год</label>
            <input type="year" class="form-control" name="year" id="Year">
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
</body>
</html><?php /**PATH C:\OSPanel\domains\localhost\src\Views/Book/create.blade.php ENDPATH**/ ?>