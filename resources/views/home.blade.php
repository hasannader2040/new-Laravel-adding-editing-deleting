<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Display a message if the user is authenticated -->
    @auth
        <p>Thank you, you are logged in</p>
        <!-- Correct the logout form method and action -->
        <form action="/logout" method="POST">
            @csrf
            @method('POST')
            <button type="submit">Logout</button>
        </form>

        <div style="border: 3px solid black;">
            <h1> create a new post </h1>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="post title">
                <textarea name="body" placeholder=" body content..."></textarea>
                <button> save Post</button>
            </form>
        </div>

        <div style="border: 3px solid black;">
            <h2>All posts</h2>
            @if (count($posts) > 0)
                @foreach ($posts as $post)
                    <div style="background-color: gray; padding: 10px; margin: 10px;">
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->body }}</p>
                        <p> <a href="/edit-post/{{ $post->id }}">Edit</a></p>
                        <form action="/delete-post/{{ post->id }}>" method="POST" @@csrf
                            @@method('DELETE') <button> Delete </button>
                        </form>
                    </div>
                @endforeach
            @else
                <p>No posts available.</p>
            @endif
        </div>

        <h2>Register</h2>
        <!-- The form should properly enclose the inputs -->
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="Name">
            <input name="email" type="text" placeholder="Email">
            <input name="password" type="password" placeholder="Password">
            <button type="submit">Register</button>
        </form>


        <h2>Login</h2>

        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="Email"> <!-- This is the email field -->
            <input name="loginpassword" type="password" placeholder="Password">
            <button type="submit">Login</button>
        </form>

    @endauth

</body>

</html>
