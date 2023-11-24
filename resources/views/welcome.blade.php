<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Scout In Laravel</title>
    <style>
        .upper, .bottom{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .upper input{
            padding: 10px 15px;
            outline: none;
        }
        table, tr, td, th{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h3 class="text-center my-2">Scout Search Implementation In Laravel</h3>
    <div class="container my-2">
        <div class="upper">
            <input type="search" placeholder="Search Here" id="search" name="search">
        </div>
        <div class="bottom">
            <table class="my-2">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        $.ajax({
    type: "GET",
    url: "/fetch", // Adjust the URL to match your route
    dataType: "json",
    success: function(data) {
        // Access and manipulate the JSON data here
        for(var i = 0; i < data.length; i++){
            $('tbody').append('<tr><td>'+data[i].name+'</td><td>'+data[i].email+'</td></tr>');
        }
    },
    error: function(xhr, status, error) {
        // Handle errors here
        console.error(xhr.responseText);
    }
});

$('#search').on('input', function() {
        // Get the CSRF token value
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var search = $('#search').val();
        // Make the AJAX request with the CSRF token
        $.ajax({
            type: "POST",
            url: "/search", // Adjust the URL to match your route
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                search: search
                // Add other input data properties as needed
            },
            success: function(data) {
                $('tbody').html('');
                for(var i = 0; i < data.length; i++){
            $('tbody').append('<tr><td>'+data[i].name+'</td><td>'+data[i].email+'</td></tr>');
        }
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error(xhr.responseText);
            }
        });
    });
        
    </script>
</body>
</html>