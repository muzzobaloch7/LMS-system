@extends('layout.idcardadminlayout')

@section('content')
<h1 class="text-center my-5" >Sent Message</h1>  
<div class="table-responsive">
  <table class="table table-striped table-bordered">
    <thead class="thead-dark">
      <tr>
        <th>Sender</th>
        <th>Receiver</th>
        <th>Message</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($messages as $message)
      @if($message->sender_id==Auth::user()->id )
      <tr>
        <td>{{$message->sender_name}}</td>
        <td>{{$message->reciever_name}}</td>
        <td>{{$message->message}}</td>
        <td>
          <form action="{{route('inbox.delete', $message->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    </tbody>
    @endif
    @endforeach
  </table>
</div>
<div class="button-container d-flex justify-content-center mt-4">
<a href="{{ route('admin-panel.id-card-services') }}" class="btn btn-warning" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;"><i class="fas fa-arrow-left"></i> Back</a>
</div>
@endsection
