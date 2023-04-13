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
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="firstname">FirstName</label>
                <input type="text" class="form-control" name="firstname" value="{{ $child->firstname }}"/>
            </div>
            <div class="form-group">
                <label for="lastname">LastName</label>
                <input type="text" class="form-control" name="lastname" value="{{ $child->lastname }}"/>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

                <div class="form-group">

                    <strong>Parent:</strong>

                    <label>
                        <select name="parent" class="form-control">

                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </label>

                    @error('parent')

                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>

                    @enderror

                </div>

            </div>

            <button type="submit" class="btn btn-primary ml-3">Update User</button>
        </form>
    </div>
</div>

</body>

</html>
