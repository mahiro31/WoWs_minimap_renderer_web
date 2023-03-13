<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>WoWs Minimap Renderer</title>
</head>
<body>

    <h3>WoWs Minimap Renderer</h3>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="/" enctype="multipart/form-data">

        {{ csrf_field() }}

        <input type="file" id="file" name="file" class="form-control" accept=".wowsreplay">
        <br>
        <button type="submit">Minimap Render</button>
    </form>

</body>
</html>