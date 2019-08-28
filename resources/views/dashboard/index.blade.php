<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Admin Panel</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('items.index') }}">Admin Panel</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col">
            <hr>
            <h2 class="text-center">Add item</h2>
            <hr>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Options</label>
                    <label for="game-id" class="sr-only">Game ID</label>
                    <select id="game-id" class="custom-select rounded-0">
                        <option value="570" selected>Dota 2</option>
                        <option value="1">CS:GO</option>
                    </select>
                </div>
                <input type="text" class="form-control" aria-label="Text input with dropdown button">
            </div>
            <form id="add-item" class="mb-2" action="" method="post">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-4 pr-0">
                            <label for="game-id" class="sr-only">Game ID</label>
                            <select id="game-id" name="gameId" class="custom-select">
                                <option value="570" selected>Dota 2</option>
                                <option value="1">CS:GO</option>
                            </select>
                            <label for="nameItem" class="sr-only">Name item</label>
                            <input id="nameItem" class="form-control mr-sm-3" name="name" type="text"
                                   placeholder="Name item">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        <div class="col-2 pl-0">
                            <div id="waiting-createTable" class="spinner-border" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <span id="success-createTable" class="align-middle text-success"
                                  style="display: none;">Done</span>
                            <span id="error-createTable" class="align-middle text-danger" style="display: none;">Table exists</span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-5">
                    <button id="parser" class="btn btn-warning btn-block" type="button">Start parser</button>
                </div>
                <div class="col pl-0">
                    <div id="waiting-parser" class="spinner-border" role="status" style="display: none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <span id="success-parser" class="align-middle text-success" style="display: none;">Done</span>
                </div>
            </div>
        </div>
        <div class="col">
            <hr>
            <h2 class="text-center mb-3">List of items</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="api/delete/{{ $item->id }}" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/js/ajax.js"></script>
</body>
</html>
