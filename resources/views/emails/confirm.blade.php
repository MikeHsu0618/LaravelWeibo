<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>註冊確認連結</title>
</head>
<body>
  <h1>感谢您在網站進行註冊！</h1>

  <p>
    請點擊以下連結進行註冊：
    <a href="{{ route('confirm_email', $user->activation_token) }}">
      {{ route('confirm_email', $user->activation_token) }}
    </a>
  </p>

  <p>
    如果不是本人操作，請忽略此訊息。    
  </p>
</body>
</html>