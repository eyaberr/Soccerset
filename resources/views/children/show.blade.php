<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>children</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="push-top">
    <div class="container mt-2">

        <div class="row">

            <div class="col-lg-12 margin-tb">

                <div class="pull-left mb-2">

                    <h2>Show Child</h2>

                </div>

                <div class="pull-right">

                    <a class="btn btn-primary" href="{{ route('children.index') }}"> Back</a>

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
                <td>FirstName</td>
                <td>LastName</td>
                <td>Parent</td>
                <td>Age</td>

            </tr>
            </thead>
            <tbody>
            @foreach($child as $children)
                <tr>
                    <td>{{$child->id}}</td>
                    <td>{{$child->firstname}}</td>
                    <td>{{$child->lastname}}</td>
                    <td>{{$child->user->name}}</td>
                    <td>{{$child->Age}}</td>
                    <td class="text-center">
                        <a href="{{ route('children.edit', $children->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('children.destroy', $children->id)}}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
