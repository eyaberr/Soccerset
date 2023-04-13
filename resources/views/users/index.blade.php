<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>USERS SPACE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>{{__('messages.users_space_title')}}</h2>

            </div>

            <div class="pull-right mb-2">

                <a class="btn btn-success" href="{{ route('users.create') }}"> {{__('messages.add_user_title')}}</a>

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

            <th>{{__('messages.user_id')}}</th>

            <th>{{__('messages.user_name')}}</th>

            <th>{{__('messages.user_email')}}</th>

            <th>{{__('messages.user_role')}}</th>


        </tr>

        @foreach ($users as $user)

            <tr>

                <td>{{ $user->id }}</td>

                <td>{{ $user->name }} </td>

                <td>{{ $user->email }}</td>

                <td>{{ $user->role->name }}</td>


                <td>

                    <form action="{{ route('users.destroy',$user->id) }}" method="Post">

                        <a class="btn btn-primary" href="{{ route('users.show',$user->id) }}">{{__('messages.show_button')}}</a>

                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">{{__('messages.edit_button')}}</a>

                        @csrf

                        @method('DELETE')
                        @if($user->id !== 1 )
                            <button type="submit" class="btn btn-danger">{{__('messages.delete_button')}}</button>
                        @endif
                    </form>

                </td>

            </tr>

        @endforeach

    </table>

    {!! $users->links() !!}
</div>
</body>
</html>
