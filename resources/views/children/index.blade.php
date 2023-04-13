<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{__('messages.children_space_title')}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-2">

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>{{__('messages.children_space_title')}}</h2>

            </div>

            <div class="pull-right mb-2">

                <a class="btn btn-success" href="{{ route('children.create') }}"> {{__('messages.add_child_title')}}</a>

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

            <th>{{__('messages.child_first_name')}}</th>

            <th>{{__('messages.child_last_name')}}</th>

            <th>{{__('messages.child_parent')}}</th>

            <th>{{__('messages.child_age')}}</th>


        </tr>

        @foreach ($children as $child)


            <tr>

                <td>{{ $child->id }}</td>

                <td>{{ $child->firstname }} </td>

                <td>{{ $child->lastname }}</td>

                <td>{{ $child->user->name }}</td>

                <td>{{ $child->age }}</td>


                <td>


                    <form action="{{ route('children.destroy',$child->id) }}" method="Post">

                        <a class="btn btn-primary" href="{{ route('children.show',$child->id) }}">{{__('messages.show_button')}}</a>

                        <a class="btn btn-primary" href="{{ route('children.edit',$child->id) }}">{{__('messages.edit_button')}}</a>

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
