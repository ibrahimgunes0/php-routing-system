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
        <div class="col-lg-4" id="movie-<?=$movie['id']?>">
            <div class="film">
                <h2 style="text-align:center;"><?=$movie['name']?></h2>
                <img src="<?=$movie['image']?>" alt="Film Resmi" class="film-img mb-3">
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
        e.preventDefault(); // Sayfanın yeniden yüklenmesini engellemek için varsayılan davranışı engelle
        var movieId = $(this).data('movie-id'); // Silinecek filmin kimliğini al
        $.ajax({
            url: '/movie_process/'+movieId, // Silinecek filmi temsil eden URL'yi belirt
            type: 'DELETE', // HTTP DELETE isteği
            success: function(result) {
                // İsteğin başarılı olması durumunda yapılacak işlemler
                console.log('Movie deleted successfully');
                // İsteğin başarılı olduğunu varsayarak, filmi DOM'dan kaldırabilirsiniz
                $('#movie-'+movieId).remove(); // Film div'ini kaldır
            },
            error: function(xhr, status, error) {
                // İsteğin başarısız olması durumunda yapılacak işlemler
                console.error('Error deleting movie:', error);
                // Hata durumunda kullanıcıya bir bildirim gösterebilirsiniz
                alert('Error deleting movie. Please try again later.');
            }
        });
    });
});
</script>
</body>
</html>
