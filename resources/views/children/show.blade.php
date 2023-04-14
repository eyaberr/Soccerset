<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Show Child</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Show Child</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('children.index') }}"> {{__('messages.back_button')}}</a>

            </div>
            </br>

        </div>

    </div>

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif

    <table class="table table-bordered">

        <tr>

            <th>{{__('messages.user_id')}}</th>

            <th>{{__('messages.child_first_name')}}</th>

            <th>{{__('messages.child_last_name')}}</th>

            <th>{{__('messages.child_parent')}}</th>

            <th>{{__('messages.child_age')}}</th>

        </tr>

        <tr>

            <td>{{ $child->id }}</td>

            <td> {{$child->firstname }}</td>

            <td>{{ $child->lastname }}</td>

            <td>{{ $child->user->name }}</td>

             <td>{{ $child->age }}</td>
        </tr>

    </table>
</div>
</body>

</html>
