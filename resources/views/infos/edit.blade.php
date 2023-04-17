<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>{{__('messages.edit_info_title')}}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left mb-2">

                <h2>{{__('messages.edit_info_title')}}</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('infos.index') }}">{{__('messages.back_button')}}</a>

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
        <form method="post" action="{{ route('infos.update', $info->id) }}">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <strong>{{__('messages.info_content')}}:</strong>

                    <input type="text" class="form-control" name="content" value="{{ $info->content }}"/>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.info_group')}}:</strong>


                    <select name="group" class="form-control">

                        @foreach($groups as $group)
                            <option
                                value="{{$group->id}}" {{ $group->id == old('group_id', $info->group_id) ? 'selected' : '' }}>{{$group->name}}</option>
                        @endforeach
                    </select>

                    @error('group')

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
