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

    <table class="table table-bordered">

        <tr>


            <th>{{__('messages.user_id')}}</th>

            <th>{{__('messages.event_title')}}</th>

            <th>{{__('messages.event_description')}}</th>

            <th>{{__('messages.event_type')}}</th>


        </tr>

        @foreach ($events as $event)


            <tr>

                <td>{{ $event->id }}</td>

                <td>{{ $event->title }} </td>

                <td>{{ $event->description }}</td>

                <td>{{$event->type}}</td>
                <td>


                    <form action="{{ route('groups.destroy',$event->id) }}" method="Post">

                        <a class="btn btn-primary"
                           href="{{ route('groups.show',$event->id) }}">{{__('messages.show_button')}}</a>

                        <a class="btn btn-primary"
                           href="{{ route('groups.edit',$event->id) }}">{{__('messages.edit_button')}}</a>

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
