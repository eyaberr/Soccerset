<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>modify child</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left mb-2">

                <h2>Edit & Update Child</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('children.index') }}"> Back</a>

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
        <form method="post" action="{{ route('children.update', $child->id) }}">
            <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                @csrf
                @method('PATCH')
                <strong>FirstName</strong>

                <input type="text" class="form-control" name="firstname" value="{{ $child->firstname }}"/>
            </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>LastName</strong>
                <input type="text" class="form-control" name="lastname" value="{{ $child->lastname }}"/>
            </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>Parent:</strong>


                        <select name="parent" class="form-control">

                            @foreach($users as $user)
                                <option value="{{$user->id}}" {{ $user->id == old('user_id', $child->user_id) ? 'selected' : '' }}>{{$user->name}}</option>
                            @endforeach
                        </select>

                    @error('parent')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">

                    <strong>Age</strong>

                    <input type="number" class="form-control" name="age" value="{{ $child->age }}"/>
                </div>
            </div>

            <button type="submit" class="btn btn-primary ml-3">Update User</button>
        </form>
    </div>
</div>

</body>

</html>
