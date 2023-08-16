<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" , initial-scale="1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Профиль</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<section class="vh-100" style="background-color: #9de2ff;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-md-9 col-lg-7 col-xl-5">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <div class="d-flex text-black">
                            <div class="flex-shrink-0">
                                <img src="https://is2-ssl.mzstatic.com/image/thumb/Music114/v4/73/da/73/73da735a-d2b1-f63b-1185-499fc3de4b18/artwork.jpg/1200x1200bf-60.jpg"
                                     alt="Generic placeholder image" class="img-fluid"
                                     style="width: 180px; border-radius: 10px;">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">{{$user['name']}}</h5>
                                <p class="mb-2 pb-1" style="color: #2b2a2a;">{{$user['email']}}</p>
                                <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                                     style="background-color: #efefef;">
                                    <div>
                                        <a href="/?c=book&m=list" class="small text-muted mb-1">Books
                                        </a>
                                        <p class="mb-0">41</p>
                                    </div>
                                    <div class="px-3">
                                        <p class="small text-muted mb-1">Followers</p>
                                        <p class="mb-0">976</p>
                                    </div>
                                    <div>
                                        <p class="small text-muted mb-1">Rating</p>
                                        <p class="mb-0">8.5</p>
                                    </div>
                                </div>
                                <div class="d-flex pt-1">
                                    <a href="/?c=newUser&m=edit" class="btn btn-outline-primary me-1 flex-grow-1">Изменить
                                    </a>
                                    <a href="/?c=newUser&m=logOut" class="btn btn-primary flex-grow-1">Выйти</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

