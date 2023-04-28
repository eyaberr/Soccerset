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

            <td>{{__("messages." .$types[$event->type])}}</td>

            <td>{{ $event->user->name }}</td>

            <td>{{$event->start_date}}</td>

            <td>{{$event->end_date}}</td>
        </tr>
    </table>
<h4>Players Details</h4><br>
    <table class="table table-bordered">
        <tr>
            <th>#</th>

            <th>FirstName</th>

            <th>LastName</th>

            <th>Attendance</th>

            <th>Stats</th>

        </tr>
        @foreach ($subscribedChildren as $child)
            <tr>
                <td>{{$child->id}}</td>
                <td>{{ $child->firstname }}</td>
                <td>{{ $child->lastname }}</td>
                <td>
                    <form action="{{ route('events.show', $child->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <a class="btn btn-outline-primary" href="{{ route('events.show',$child->id) }}">Present</a>
                        <a class="btn btn-outline-danger" href="{{ route('events.show',$child->id) }}">Absent</a>
                    </form> <br>
{{--                    @if ($child->status == 'present')--}}
{{--                        <p>This player is present</p>--}}
{{--                    @elseif($child->status == 'absent')--}}
{{--                        <p>This player is absent</p>--}}
{{--                    @endif--}}
                </td>
                <td><form action="{{ route('events.update', $child->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                        <button type="submit" name="stats" value="Show Stats" class="btn btn-outline-secondary">Show Stats</button>
                    </form> </td>

            </tr>
    @endforeach


</div>
</body>

</html>
