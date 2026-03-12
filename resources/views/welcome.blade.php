<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Jagger') }}</title>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }
            .container {
                text-align: center;
                background: white;
                padding: 40px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                max-width: 600px;
                width: 100%;
            }
            h1 { color: #333; }
            p { color: #666; }
            .btn {
                display: inline-block;
                padding: 10px 20px;
                background: #4a90d9;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                margin: 5px;
            }
            .btn:hover { background: #357abd; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Welcome to Jagger</h1>
            <p>Federation(s) (SAML) management system</p>
            <p>
                <a href="/auth/login" class="btn">Login</a>
                <a href="/setup" class="btn">Setup</a>
            </p>
        </div>
    </body>
</html>
