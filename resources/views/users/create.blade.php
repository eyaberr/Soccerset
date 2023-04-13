<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>{{__('messages.add_user_title')}}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left mb-2">

                <h2>{{__('messages.create_user_title')}}</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('users.index') }}"> {{__('messages.back_button')}}</a>

            </div>

        </div>

    </div>

    @if(session('status'))

        <div class="alert alert-success mb-1 mt-1">

            {{ session('status') }}

        </div>

    @endif


    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.user_name')}}:</strong>

                    <input type="text" name="name" value="{{ old("name") }}" class="form-control" placeholder="Name">

                    @error('name')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>


            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.user_email')}}:</strong>

                    <input type="email" name="email" value="{{ old("email") }}" class="form-control"
                           placeholder="User Email">

                    @error('email')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.user_role')}}:</strong>

                    <select name="role_id" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>

                    @error('role_id')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.user_password')}}:</strong>

                    <input type="password" name="password" class="form-control" placeholder="User Password">

                    @error('password')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.user_confirm_password')}}:</strong>

                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password"
                           id="confirm_password" required>

                    @error('confirm_password')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">

                <button type="submit" class="btn btn-primary ml-3">{{__('messages.submit_button')}}</button>

            </div>

        </div>

    </form>
</div>

</body>

</html>
