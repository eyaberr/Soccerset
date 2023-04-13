<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>{{__('messages.show_user_title')}}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>{{__('messages.show_user_title')}}</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('users.index') }}"> {{__('messages.back_button')}}</a>

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

            <th>{{__('messages.user_name')}}</th>

            <th>{{__('messages.user_email')}}</th>

            <th>{{__('messages.user_role')}}</th>

            @if ($user->id !== 1)
                <th>{{__('messages.user_password')}}</th>@endif

        </tr>

        <tr>

            <td>{{ $user->id }}</td>

            <td> {{$user->name }}</td>

            <td>{{ $user->email }}</td>

            <td>{{ $user->role->name }}</td>

            @if ($user->id !== 1)
                <td>{{ $user->password }}</td>>@endif
        </tr>

    </table>
</div>
</body>

</html>
