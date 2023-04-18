<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{__('messages.permissions_space_title')}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>{{__('messages.permissions_space_title')}}</h2>

            </div>

            <div class="pull-right mb-2">

                <a class="btn btn-success" href="{{ route('permissions.create') }}"> {{__('messages.add_permission_title')}}</a>

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


        </tr>

        @foreach ($permissions as $permission)


            <tr>

                <td>{{ $permission->id }}</td>


                <td>{{ $permission->name }}</td>

                <td>


                    <form action="{{ route('permissions.destroy',$permission->id) }}" method="Post">

                        <a class="btn btn-primary"
                           href="{{ route('permissions.show',$permission->id) }}">{{__('messages.show_button')}}</a>

                        <a class="btn btn-primary"
                           href="{{ route('permissions.edit',$permission->id) }}">{{__('messages.edit_button')}}</a>

                        @csrf

                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">{{__('messages.delete_button')}}</button>

                    </form>

                </td>

            </tr>

        @endforeach

    </table>

</div>

</body>
</html>
