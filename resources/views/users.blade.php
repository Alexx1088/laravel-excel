<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<div class="container pt-5">
    <div class="row">
        <div class="col-md-4">
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
     <div class="col-md-12"></div>
        <form class="row g-3" action="{{ route('import_user') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-auto">
                <label  class="visually-hidden">Excel</label>
                <input type="file" class="form-control" name="excel_file">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb">Upload excel file</button>
            </div>
            @error('excel_file')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </form>

        @if(Session::has('import_errors'))
@foreach(Session::get('import_errors') as $failure)
<div class="alert alert-danger" role="alert">
 {{ $failure->errors()[0]}} at line # {{ $failure->row()}}
</div>
            @endforeach
        @endif
    </div> {{--row--}}
    <div class="row">
        <div class="col-md-12">
    <h3>User List</h3>
        </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>

                </tr>
                </thead>
                <tbody>
                @if(count($users))
                    @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="3">No data found</td>
                </tr>
                @endif

                               </tbody>
            </table>
        </div>
    </div>
    </div>{{-- container--}}



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>