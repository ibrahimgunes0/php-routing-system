<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../view/css/main.css">
</head>
<body>
<div class="container">
    <div class="film-detail">
        <div class="row align-items-center mb-4">
            <div class="col-md-4 text-center">
                <img src="../view/images/<?=$movie['image']?>" alt="Film Resmi" class="img-fluid film-image">
            </div>
            <div class="col-md-8">
                <h1 class="mb-3"><?= $movie['name'] ?></h1>
                <h2 class="text-primary">IMDb : <?= $movie['imdb'] ?></h2>
            </div>
        </div>
        <p><?= $movie['explanation'] ?></p>
        <hr>
        <a href="/movies" class="btn btn-primary">Back to Movie List</a>
    </div>
</div>
</body>
</html>
