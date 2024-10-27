@extends('layout.adminpanellayout')
@section('content')
<h1 class="text-center my-5"> Records Of Id CardAdmins</h1>

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
            @foreach($idAdmins as $idAdmin)
            <tr>
                <td>{{ $idAdmin->id }}</td>
                <td>{{ $idAdmin->name }}</td>
                <td>{{ $idAdmin->email }}</td>
                <td>
                    <a href="{{ route('admin-panel.idadmin.edit', $idAdmin->id) }}" class="btn btn-warning btn-sm">Update</a>
                    <form action="{{route('admin-panel.idadmin.delete',$idAdmin->id)}}" method="POST" style="display: inline;">
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