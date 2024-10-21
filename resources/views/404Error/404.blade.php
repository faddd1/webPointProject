<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .error-container {
            text-align: center;
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }
        .error-container img {
            width: 120px;
            margin-bottom: 20px;
        }
        .error-code {
            font-size: 80px;
            font-weight: bold;
            color: #ff4757;
        }
        .error-message {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .home-button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 18px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .home-button:hover {
            background-color: #0056b3;
            text-decoration: none;
        }
        .back-to-home {
            margin-top: 15px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <img src="https://1.bp.blogspot.com/-fhQrt5qoZVQ/Vk7JRkLvD4I/AAAAAAAAF-k/ePg_jf3sDwI/s1600/Smk-Negeri-1-Kawali-Logo.png" alt="Logo">
        <div class="error-code">404</div>
        <div class="error-message">Oops! The page you're looking for doesn't exist.</div>
        <a href="{{ url('/') }}" class="btn home-button">Go to Home</a>
    </div>
</body>
</html>
