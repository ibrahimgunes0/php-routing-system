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
        <h1 class="text-center my-5">Add Movie</h1>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="/movie_process" method="POST" id="movie_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Movie Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div></br>
                    <div class="form-group">
                        <label for="image">Movie Image</label>
                        <input type="text" class="form-control" id="image" name="image">
                    </div></br>
                    <div class="form-group">
                        <label for="explanation">Movie Explanation</label>
                        <textarea class="form-control" id="explanation" name="explanation" rows="5"></textarea>
                    </div><br>
                    <button type="submit" class="btn btn-primary">Add Movie</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        document.getElementById('movie_form').addEventListener('submit', function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            fetch('/movie_process', {
                method: 'PUT',
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    window.location.href = '/movies?new_id='+data;
                })
                .catch(error => {
                    console.error('There was an error!', error);
                });
        });
    </script>
</body>

</html>