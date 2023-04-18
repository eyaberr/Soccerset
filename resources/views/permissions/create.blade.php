<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>{{__('messages.write_permission_title')}}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left mb-2">

                <h2>{{__('messages.write_permission_title')}}</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('permissions.index') }}"> {{__('messages.back_button')}}</a>

            </div>

        </div>

    </div>

    @if(session('status'))

        <div class="alert alert-success mb-1 mt-1">

            {{ session('status') }}

        </div>

    @endif

    <form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>{{__('messages.user_name')}}:</strong>

                    <input type="text" name="name" class="form-control" placeholder="Name">

                    @error('name')

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
