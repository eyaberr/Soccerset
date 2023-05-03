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

            <div class="pull-left mb-2">

                <h2>{{__('messages.create_event')}}</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('events.index') }}"> {{__('messages.back_button')}}</a>

            </div>

        </div>

    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.event_title')}}:</strong>

                    <input type="text" name="title" class="form-control" placeholder="Event Title">

                    @error('title')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>


            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.event_description')}}:</strong>

                    <input type="text" name="description" class="form-control" placeholder="Description">

                    @error('description')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.event_type')}}:</strong>
                    <select name="type" class="form-control">
                        @foreach($types as $key => $value)
                            <option value="{{$value}}">{{ __("messages.$key") }}</option>
                        @endforeach
                    </select>

                    @error('type')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror
                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.event_trainer')}}:</strong>

                    <select name="trainer" class="form-control">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>

                    @error('trainer')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.event_start_date')}}:</strong>
                    <input type="datetime-local" name="start_date" class="form-control" placeholder="Start Date">

                    @error('start_date')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror
                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.event_end_date')}}:</strong>
                    <input type="datetime-local" name="end_date" class="form-control" placeholder="End Date">

                    @error('end_date')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror
                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">

                    <strong>{{__('messages.players_list')}}:</strong>
                    <select name="children[]" multiple class="form-control">
                        @foreach($children as $child)
                            <option value="{{$child->id}}">{{$child->firstname}} {{$child->lastname}}</option>
                        @endforeach
                    </select>
                    @error('children')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror
                </div>
            </div>

        </div>
        <br>
        <div class="col-xs-6 col-sm-6 col-md-6">

            <button type="submit" class="btn btn-primary ml-3">{{__('messages.submit_button')}}</button>

        </div>
    </form>


</div>
</body>

</html>
