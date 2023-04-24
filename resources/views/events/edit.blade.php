<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>{{__('messages.edit_event_title')}}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left mb-2">

                <h2>{{__('messages.edit_event_title')}}</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('events.index') }}">{{__('messages.back_button')}}</a>

            </div>

        </div>

    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br/>
        @endif
        <form method="post" action="{{ route('events.update', $event->id) }}">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <strong>{{__('messages.event_title')}}:</strong>

                    <input type="text" class="form-control" name="title" value="{{ $event->title }}"/>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{__('messages.event_description')}}:</strong>
                    <input type="text" class="form-control" name="description" value="{{ $event->description }}"/>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.event_type')}}:</strong>


                    <select name="type" class="form-control">
                        @foreach($types as $key => $value)
                            <option
                                value="{{$value}}" {{$value == old('value', $value) ? 'selected' : ''}}>{{ __("messages.$key") }}</option>
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
                            <option
                                value="{{$user->id}}" {{ $user->id == old('user_id', $event->user_id) ? 'selected' : '' }}>{{$user->name}}</option>
                        @endforeach
                    </select>

                    @error('parent')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.event_start_date')}}:</strong>


                    <input type="datetime-local" class="form-control" name="start_date"
                           value="{{ $event->start_date }}"/>


                    @error('start_date')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.event_end_date')}}:</strong>


                    <input type="datetime-local" class="form-control" name="end_date" value="{{ $event->end_date }}"/>


                    @error('end_date')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">

                    <strong>Players list:</strong>
                    <select name="children[]" multiple class="form-control">
                        @foreach($children as $child)
                            <option @if(in_array($child->id, $selectedChildrenIds)) selected @endif value="{{$child->id}}">{{$child->firstname}} {{$child->lastname}}</option>
                        @endforeach
                    </select>
                    @error('children')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary ml-3">{{__('messages.update_button')}}</button>
        </form>
    </div>
</div>

</body>

</html>
