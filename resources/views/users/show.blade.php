<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="push-top">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @endif
    <table class="table">
        <thead>
        <tr class="table-warning">
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Password</td>
            <td class="text-center">Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($student as $students)
            <tr>
                <td>{{$students->id}}</td>
                <td>{{$students->name}}</td>
                <td>{{$students->email}}</td>
                <td>{{$students->phone}}</td>
                <td>{{$students->password}}</td>
                <td class="text-center">
                    <a href="{{ route('students.edit', $students->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                    <form action="{{ route('students.destroy', $students->id)}}" method="post" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
</body>
</html>
