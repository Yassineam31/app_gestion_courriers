<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسالة من الأكاديمية الجهوية</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 5px auto;
            background: #ffffff;
        }
    
        .header {
            padding: 5px;
            line-height: 1.6;
            display: flex;
        }
        
        
    </style>
</head>
<body>
    <div class="email-container" dir='rtl'>
        <div class="header">
            @isset($object)
            <p style='margin-left:5px;'><b>الموضوع:</b></p>
            <p>{{ $object }}</p>
            @endisset
        </div>
        <p>{{ $messageContent }}</p>
    </div>
</body>
</html>
