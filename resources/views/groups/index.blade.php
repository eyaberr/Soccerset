<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Groups</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Groups Space</h2>

            </div>

            <div class="pull-right mb-2">

                <a class="btn btn-success" href="{{ route('groups.create') }}"> ADD GROUP</a>

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

            <th>Name</th>

            <th>Number Of Players</th>



        </tr>

        @foreach ($groups as $group)


            <tr>

                <td>{{ $group->id }}</td>

                <td>{{ $group->name }} </td>

                <td>{{ $group->number_of_players }}</td>




                <td>


                    <form action="{{ route('groups.destroy',$group->id) }}" method="Post">

                        <a class="btn btn-primary" href="{{ route('groups.show',$group->id) }}">show</a>

                        <a class="btn btn-primary" href="{{ route('groups.edit',$group->id) }}">Edit</a>

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
