<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>{{__('messages.show_event_title')}}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>{{__('messages.show_event_title')}}</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('events.index') }}"> {{__('messages.back_button')}}</a>

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

            <th>{{__('messages.event_title')}}</th>

            <th>{{__('messages.event_description')}}</th>

            <th>{{__('messages.event_type')}}</th>
            <th>{{__('messages.event_trainer')}}</th>

            <th>{{__('messages.event_start_date')}}</th>

            <th>{{__('messages.event_end_date')}}</th>
        </tr>
        <tr>
            <td>{{ $event->id }}</td>

            <td>{{ $event->title }} </td>

            <td>{{ $event->description }}</td>

            <td>{{$event->type}}</td>

            <td>{{ $event->user->name }}</td>

            <td>{{$event->start_date}}</td>

            <td>{{$event->end_date}}</td>
        </tr>
    </table>
</div>
</body>

</html>
