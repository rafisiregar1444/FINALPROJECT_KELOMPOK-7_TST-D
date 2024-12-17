<!-- resources/views/categories.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <h1>Categories</h1>
    <ul>
        @foreach ($data as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
</body>
</html>
