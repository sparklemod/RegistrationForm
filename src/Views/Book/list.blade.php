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
    <h1>Список книг</h1>

    @foreach ($books as $book)
        <p>This is user {{ $book->getName() }}</p>


    <form method="post">
        <div class="mb-3">
            <label for="ID" class="form-label">ID</label>
            <input type="text" class="form-control" name="id" id="ID" value="{{$book->getId()}}">
        </div>
        <div class="mb-3">
            <label for="Name" class="form-label">Название книги</label>
            <input type="text" class="form-control" name="name" id="Name" value="{{$book->getName()}}">
        </div>
        <div class="mb-3">
            <label for="Author" class="form-label">Автор</label>
            <input type="author" class="form-control" name="author" id="Author" value="{{$book->getAuthor()}}">
        </div>
        <div class="mb-3">
            <label for="Edition" class="form-label">Издание</label>
            <input type="edition" class="form-control" name="edition" id="Edition" value="{{$book->getEdition()}}">
        </div>
        <div class="mb-3">
            <label for="Year" class="form-label">Год</label>
            <input type="year" class="form-control" name="year" id="Year" value="{{$book->getYear()}}">
        </div>


        <div class="pt-1">
            <a href="/?c=book&m=edit&id={{$book->getId()}}" class="btn btn-primary ">Редактировать</a>
            <a href="/?c=newUser&m=logOut" class="btn btn-primary ">Удалить</a>
        </div>

    </form>
    @endforeach
</div>
</body>
</html>