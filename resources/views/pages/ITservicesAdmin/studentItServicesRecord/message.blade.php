@extends('layout.itadminlayout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @foreach ($students as $student)
            <form action="{{ route('inbox.stuitstore') }}" method="POST" class="p-4 border rounded bg-light shadow">
                @csrf
                <h4 class="mb-4 text-center">Send Message</h4>
                <div class="form-group mb-3">
                    <label for="sender_id" class="form-label">Sender id:</label>
                    <input type="text" class="form-control" id="sender_id" name="sender_id" value="{{auth()->user()->id}}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="reciever_id" class="form-label">Receiver ID:</label>
                    <input type="text" class="form-control" id="reciever_id" name="reciever_id" value="{{$student->user_id}}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="message" class="form-label">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">Send Message</button>
                    <a href="{{ route('admin-panel.it-services') }}" class="btn btn-info">Back</a>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection