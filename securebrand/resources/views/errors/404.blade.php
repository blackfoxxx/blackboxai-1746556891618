<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Page Not Found - 404</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            color: #2d3748;
            text-align: center;
            padding: 50px;
        }
        h1 {
            font-size: 72px;
            margin-bottom: 0;
        }
        p {
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        a {
            color: #3182ce;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>404</h1>
    <p>Sorry, the page you are looking for could not be found.</p>
    <p><a href="{{ url('/') }}">Return to homepage</a></p>
</body>
</html>
