<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="push-top">
    <div class="container mt-2">

        <div class="row">

            <div class="col-lg-12 margin-tb">

                <div class="pull-left mb-2">

                    <h2>Edit & Update User</h2>

                </div>

                <div class="pull-right">

                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>

                </div>

            </div>

        </div>
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @endif
    <table class="table">
        <thead>
        <tr class="table-warning">
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>

        </tr>
        </thead>
        <tbody>
        @foreach($user as $users)
            <tr>
                <td>{{$users->id}}</td>
                <td>{{$users->name}}</td>
                <td>{{$users->email}}</td>
                <td class="text-center">
                    <a href="{{ route('users.edit', $users->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                    <form action="{{ route('users.destroy', $users->id)}}" method="post" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>
