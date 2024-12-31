<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد البريد الإلكتروني</title>
    <style>
        body {
            direction: rtl;
            text-align: right;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color:rgba(227, 229, 232, 0.8);
            padding: 20px;
            border: 1px solid #d9e6f2;
            border-radius: 10px;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            font-size: 1.5rem;
            color: #333;
        }
        .container p {
            font-size: 1rem;
            color: #555;
            margin: 15px 0;
        }
        .container a {
            display: inline-block;
            background-color: #2b2b2b;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
        }
        .container a:hover {
            background-color:#494949;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>مرحباً {{ $name }}</h1>
        <p>لتأكيد عنوان بريدك الإلكتروني أنقر على الزر أدناه</p>
        <a href="{{ $url }}">تأكيد البريد الإلكتروني</a>
        <p>إدارة منصة تدبير المراسلات</p>
        <p>&copy; 2025</p>

    </div>
</body>
</html>

