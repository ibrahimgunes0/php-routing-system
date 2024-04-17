<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Listesi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="view/css/main.css">

</head>
<body>
<div class="container">

    <h1 class="text-center my-5">Movie List</h1>
    <div class="row">
    <?php foreach ($movies as $movie): ?>
        <div class="col-lg-4">
            <div class="film">
                <h2 style="text-align:center;"><?=$movie['name']?></h2>
                <img src="view/images/<?=$movie['image']?>" alt="Film Resmi" class="film-img mb-3">
                <p><?=$movie['explanation']?></p>
                <a href="/movies/<?=$movie['id']?>" style="background-color: #fcba03; color:black; border: none;" class="btn btn-primary">Detaylar</a>
            </div>
        </div>
    <?php endforeach; ?>
        <!-- Diğer filmler buraya eklenebilir -->
    </div>
</div>
<div class="text-center mt-5">
    <a href="/" class="btn btn-primary btn-lg">Home Page</a>
</div>

<!-- Bootstrap JS ve jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
