@extends('layout.adminpanellayout')
@section('content')
<h1 class="text-center my-5"> Records Of IT Service Admins</h1>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($itAdmins as $itAdmin)
            <tr>
                <td>{{ $itAdmin->id }}</td>
                <td>{{ $itAdmin->name }}</td>
                <td>{{ $itAdmin->email }}</td>
                <td>
                    <a href="{{route('admin-panel.itadmin.edit',$itAdmin->id)}}" class="btn btn-warning btn-sm">Update</a>
                    <form action="{{route('admin-panel.itadmin.delete',$itAdmin->id)}}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection