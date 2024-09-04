<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        <div>
            <h2>
                Register 
            </h2>
            <!-- The form should properly enclose the inputs -->
            <form action="/register" method="POST">
                @csrf 
                <input name="name" type="text" placeholder="name" name="name">
                <input name= "email" type="text" placeholder="email" name="email">
                <input name= "password" type="password" placeholder="password" name="password">
                <button type="submit">Register</button>
            </form>
        </div>
    </h1>
</body>
</html>
