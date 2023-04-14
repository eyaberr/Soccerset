<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>{{__('messages.show_group_title')}}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>{{__('messages.show_group_title')}}</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('groups.index') }}"> {{__('messages.back_button')}}</a>

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

            <th>{{__('messages.group_name')}}</th>

            <th>{{__('messages.number_of_players')}}</th>

            <th>{{__('messages.players_list')}}</th>

        </tr>

        <tr>

            <td>{{ $group->id }}</td>

            <td> {{$group->name }}</td>

            <td>{{ $group->number_of_players }}</td>

            <td>{{ $child->firstname }} {{ $child->lastname }}</td>

        </tr>

    </table>
</div>
</body>

</html>
