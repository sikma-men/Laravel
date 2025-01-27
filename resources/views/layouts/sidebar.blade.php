<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Navigation</title>
</head>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
    }

    .container {
        display: flex;

    }

    .sidebar {
        position: fixed;
        height: 100vh;
        width: 200px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #333;
        color: #fff;
        display: flex;
        flex-direction: column;
        padding: 0px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .sidebar h1 {
        font-size: 1.5rem;
        margin-bottom: 20px;
        color: #fff;
        margin: 10px 20px;
    }
    .padding{
        padding: 10px;
        border: 0.5px solid gray;
    }
    .sidebar a {
        text-decoration: none;
        color: #fff;
        padding: 10px;
        margin: 0px 0;
        display: block;
        transition: background-color 0.3s ease;
    }

    .padding:hover {
        border-left: 5px dashed white;
        background-color: #444;
        transition: background-color 0.3s ease,border-left-color 0.3s ease;
    }

    .content {
        flex: 1;
        /* Konten mengambil sisa ruang */
        padding: 20px;
        /* Memberikan padding pada konten */
        box-sizing: border-box;
    }

    .content h1 {
        color: #333;
    }
</style>

<body>
    <div class="sidebar">
        <h1>Nabil</h1>
        <div class="padding">
            <a href="/add-location">Add Map</a>
        </div>
        <div class="padding">
            <a href="/view-location">View Map</a>
        </div>
    </div>
</body>

</html>
