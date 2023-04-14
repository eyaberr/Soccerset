<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>{{__('messages.edit_group_title')}}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left mb-2">

                <h2>{{__('messages.edit_group_title')}}</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('groups.index') }}">{{__('messages.back_button')}}</a>

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
        <form method="post" action="{{ route('groups.update', $group->id) }}">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <strong>{{__('messages.group_name')}}:</strong>

                    <input type="text" class="form-control" name="name" value="{{ $group->name }}"/>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{__('messages.group_players')}}:</strong>
                    <input type="text" class="form-control" name="lastname" value="{{ $group->number_of_players }}"/>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.children_list')}}:</strong>


                    <select name="children[]" multiple class="form-control">

                        @foreach($children as $child)
                            <option value="{{$child->id}}" {{ $child->id == old('id', $child->id) ? 'selected' : '' }}>{{$child->firstname}} {{$child->lastname}}</option>
                        @endforeach
                    </select>

                    @error('children')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">

                    <strong>{{__('messages.child_age')}}:</strong>

                    <input type="number" class="form-control" name="age" value="{{ $child->age }}"/>
                </div>
            </div>

            <button type="submit" class="btn btn-primary ml-3">{{__('messages.update_button')}}</button>
        </form>
    </div>
</div>

</body>

</html>
