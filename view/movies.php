<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Listesi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="view/css/main.css">

</head>
<body>
<div class="container">

    <h1 class="text-center my-5">Movie List</h1>
    <div class="row">
    <?php
    foreach ($movies as $movie): ?>
        <div class="col-lg-4" id="movie-<?=$movie['id']?>">
            <div class="movie" <?php if ($_GET['new_id'] == $movie['id']) echo 'style="background-color:#358334;"'?>>
                <h2 style="text-align:center;"><?=$movie['name']?></h2>
                <img src="<?=$movie['image']?>" alt="Image Movie" class="movie-img mb-3">
                <p><?=$movie['explanation']?></p>
                <a href="/movies/<?=$movie['id']?>" style="background-color: #fcba03; color:black; border: none;" class="btn btn-primary">Detail</a>
                <a href="#" data-movie-id="<?=$movie['id']?>" style="margin-left:10px;border: none;" class="btn btn-danger">Delete</a>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>
<div class="text-center mt-5">
    <a href="/add_movie_form" class="btn btn-success btn-lg">Add Movie</a>
    <a href="/" class="btn btn-primary btn-lg">Home Page</a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function(){
    $(".btn-danger").click(function(e){
        e.preventDefault();
        var movieId = $(this).data('movie-id');
        $.ajax({
            url: '/movie_process/'+movieId,
            type: 'DELETE',
            success: function(result) {
                console.log('Movie deleted successfully');
                $('#movie-'+movieId).remove();
            },
            error: function(xhr, status, error) {
                console.error('Error deleting movie:', error);
                alert('Error deleting movie. Please try again later.');
            }
        });
    });
});
</script>
</body>
</html>
