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
    <h1 class="mb-4"> Список книг</h1>
    <div class="pt-1">
        <a href="/?c=book&m=create" class="btn btn-primary mb-2">Добавить</a>
    </div>


    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Author</th>
            <th scope="col">Edition</th>
            <th scope="col">Year</th>
            <th scope="col">Act</th>
        </tr>
        </thead>
        <tbody>

        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="col"><?php echo e($book->getId()); ?></th>
                <th scope="col"><?php echo e($book->getName()); ?></th>
                <th scope="col"><?php echo e($book->getAuthor()); ?></th>
                <th scope="col"><?php echo e($book->getEdition()); ?></th>
                <th scope="col"><?php echo e($book->getYear()); ?></th>
                <th scope="col">

                <div class="pt-1">
                    <a href="/?c=book&m=edit&id=<?php echo e($book->getId()); ?>" class="btn btn-primary ">Ред.</a>
                    <a href="/?c=book&m=delete&id=<?php echo e($book->getId()); ?>" class="btn btn-primary ">Удалить</a>
                </div>
                </th>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table>
</div>
</body>
</html><?php /**PATH C:\OSPanel\domains\localhost\src\Views/Book/list.blade.php ENDPATH**/ ?>