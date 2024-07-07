<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Care</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/PetCARE.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/user-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user1.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <form method="post" action="{{ route('test.store') }}">
        @csrf
        @method('POST')
        <input type="file" multiple name="n[]">
        <button type="submit">click</button>
    </form>
    {{-- <form action="{{ route('test.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('POST')
        <input type="file" name="file[]" multiple>
        <button type="submit">click</button>
    </form> --}}

</body>
<script href="{{ asset('assets/js/script.js') }}"></script>

</html>