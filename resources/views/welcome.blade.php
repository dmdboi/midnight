<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Forum</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 80px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 40px 30px; text-align: center; }
        h1 { color: #2c3e50; margin-bottom: 16px; }
        p { color: #555; margin-bottom: 32px; }
        .btn {
            display: inline-block;
            background: #3490dc;
            color: #fff;
            padding: 12px 28px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1.1em;
            transition: background 0.2s;
        }
        .btn:hover { background: #2779bd; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Forum!</h1>
        <p>
            Join our community to discuss topics, share knowledge, and connect with others.<br>
            Browse the latest discussions or start your own thread.
        </p>
        <a href="{{ url('/login') }}" class="btn">Login</a>
    </div>
</body>
</html>
