<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: #6c757d;
        }
        .btn {
            display: block;
            margin: 10px auto;
            padding: 15px 30px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-brown {
            background-color: #795548;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .btn-brown:hover {
            background-color: #5d4037;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Ticketing System</h1>
        <p>Please choose your login type:</p>
        <a href="{{ route('client.login') }}" class="btn">Log in as Client</a>
        <a href="{{ route('support.login') }}" class="btn btn-secondary">Log in as Support Agent</a>
        <a href="{{ route('admin.login') }}" class="btn btn-brown">Log in as Admin</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
