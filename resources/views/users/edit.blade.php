<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>{{__('messages.edit_user_title')}}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left mb-2">

                <h2>{{ __('messages.edit_user_title') }}</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('users.index') }}"> {{ __('messages.back_button') }}</a>

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
            @if(session('errors'))

                <div class="alert alert-success mb-1 mt-1">

                    {{ session('errors') }}

                </div>

            @endif
        <form method="post" action="{{ route('users.update', $user->id) }}">
            <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                @csrf
                @method('PATCH')
                <strong>{{__('messages.user_name')}}:</strong>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}"/>
            </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{__('messages.user_email')}}:</strong>

                <input type="email" class="form-control" name="email" value="{{ $user->email }}"/>
            </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.user_role')}}:</strong>
                    <select name="role_id" class="form-control">

                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id == old('role_id', $user->role_id) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('role_id')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.user_new_password')}}:</strong>

                    <input type="password" name="password" placeholder="New Password" class="form-control" value="">

                    @error('password')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.user_confirm_new_password')}}:</strong>

                    <input type="password" name="password_confirmation" placeholder="New Password Confirmation" class="form-control" value="">

                    @error('password_confirmation')

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
