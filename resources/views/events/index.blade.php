<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{__('messages.events_space_title')}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>{{__('messages.events_space_title')}}</h2>

            </div>

            <div class="pull-right mb-2">

                <a class="btn btn-success" href="{{ route('events.create') }}"> {{__('messages.add_event_title')}}</a>

            </div>

        </div>

    </div>

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif
    @if(session('errors'))

        <div class="alert alert-success mb-1 mt-1">

            {{ session('errors') }}

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

            <th>{{__('messages.children_of_events')}}</th>

            <th></th>

        </tr>

        @foreach ($events as $event)


            <tr>

                <td>{{ $event->id }}</td>

                <td>{{ $event->title }} </td>

                <td>{{ $event->description }}</td>


                <td>{{ __("messages." .$types[$event->type]) }}</td>


                <td>{{ $event->user->name }}</td>


                <td>{{$event->start_date}}</td>

                <td>{{$event->end_date}}</td>
                <td>{{$event->subscriptions_count}}</td>
                <td>
                    <form action="{{ route('events.destroy',$event->id) }}" method="Post">

                        <a class="btn btn-primary"
                           href="{{ route('events.show',$event->id) }}">{{__('messages.show_button')}}</a>

                        <a class="btn btn-primary"
                           href="{{ route('events.edit',$event->id) }}">{{__('messages.edit_button')}}</a>

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
