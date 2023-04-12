<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>children</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Children Space</h2>

            </div>

            <div class="pull-right mb-2">

                <a class="btn btn-success" href="{{ route('children.create') }}"> ADD CHILD</a>

            </div>

        </div>

    </div>

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif

    <table class="table table-bordered">

        <tr>

            <th>#</th>

            <th>FirstName</th>

            <th>LastName</th>

            <th>Parent</th>

            <th>Age</th>


        </tr>

        @foreach ($children as $child)


            <tr>

                <td>{{ $child->id }}</td>

                <td>{{ $child->firstname }} </td>

                <td>{{ $child->lastname }}</td>

                <td>{{ $child->user->name ?? ''}}</td>

                <td>{{ $child->age }}</td>


                <td>


                    <form action="{{ route('children.destroy',$child->id) }}" method="Post">

                        <a class="btn btn-primary" href="{{ route('children.show',$child->id) }}">show</a>

                        <a class="btn btn-primary" href="{{ route('children.edit',$child->id) }}">Edit</a>

                        @csrf

                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>

                </td>

            </tr>

        @endforeach

    </table>

</div>

</body>
</html>
