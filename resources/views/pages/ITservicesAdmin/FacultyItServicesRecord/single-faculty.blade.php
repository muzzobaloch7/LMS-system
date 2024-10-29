<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" >
  <title>Single Faculty Data</title>
  <style>
    .form-section {
      border-radius: 15px; /* Apply border radius */
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Apply box shadow for 3D effect */
      padding: 20px; /* Add some padding */
      background-color: #fff; /* Ensure background color is white */
    }
    .header-section {
      text-align: center;
      margin-bottom: 20px;
    }
    .uni-logo {
      display: block;
      margin: 0 auto;
    }
    .title-div h1, .title-div h2 {
      margin: 0;
    }
    .main-fiel-div {
      margin-top: 20px;
    }
    .field-div p {
      margin: 5px 0;
    }
    .button-container {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <section class="header-section text-center mb-4">
    <div>
    <img class="uni-logo" style =" width:400px; left:3px;" src="{{asset('images/ug-logo.png')}}" alt="University Logo" class="img-fluid">
    </div>
    <div class="title-div">
      <h1>UNIVERSITY OF GWADAR</h1>
      <h2>STAFF IT SERVICES</h2>
    </div>
  </section>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
  @endif

  @if(session('reject'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('reject') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
  @endif

  <section class="form-section container">
    <main class="main-fiel-div">
      <div class="field-div container">
        <div class="row">
          <div class="col-md-6">
            <p><strong>Faculty ID:</strong>  {{ $facultys->id }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Faculty Name:</strong>  {{ $facultys->faculty_name }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Faculty Designation:</strong>  {{ $facultys->faculty_designation }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Department:</strong>  {{ $facultys->department }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Faculty Status:</strong>  {{ $facultys->faculty_status }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Faculty ID No:</strong>  {{ $facultys->faculty_id_no }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Faculty Gender:</strong>  {{ $facultys->gender }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Faculty Email:</strong>  {{ $facultys->faculty_email }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Faculty Contact No:</strong>  {{ $facultys->faculty_contact_no }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Hostel Name:</strong>  {{ $facultys->hostel_name }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Floor No:</strong>  {{ $facultys->floor_no }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Room no:</strong>  {{ $facultys->room_no }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Services:</strong>  {{ $facultys->it_services }}</p>
          </div>
        </div>
      </div>
      @if($facultys->accepted === 0)
      <div class="button-container d-flex justify-content-center">
        <a href="{{ route('admin-panel.it-services') }}" class="btn btn-secondary mx-2" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;">Back</a>
        <button class="btn btn-success mx-2" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;" data-bs-toggle="modal" data-bs-target="#acceptModal">Accept</button> 
        <button class="btn btn-danger mx-2" type="button" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button>
      </div>
      </div>
      @else
      <div class="button-container d-flex justify-content-center">
        <a href="{{ route('admin-panel.it-services') }}" class="btn btn-secondary mx-2" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;">Back</a>
      </div>
      @endif
    </main>
  </section>

  <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rejectModalLabel">Enter Rejection Reason</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('faculty-rejection.message') }}" method="POST" class="p-4 border rounded bg-light shadow">
          @csrf
          <h4 class="mb-4 text-center">Send Message</h4>
          <div class="form-group mb-3">
              <label for="sender_name" class="form-label">Sender name:</label>
              <input type="text" class="form-control" id="sender_name" name="sender_name" value="{{auth()->user()->name}}" required>
          </div>
          <div class="form-group mb-3">
              <label for="reciever_name" class="form-label">Receiver name:</label>
              <input type="text" class="form-control" id="reciever_name" name="reciever_name" value="{{$facultys->first()->faculty_name}}" required>
          </div>
          <div class="form-group mb-3">
              <label for="message" class="form-label">Message:</label>
              <textarea class="form-control" id="message" name="message" rows="3" required>Your IT services request has not been approved. Please review the requirements or contact IT support for assistance.</textarea>
          </div>
          <input type="hidden" name="id" value="{{$facultys->first()->id}}">
          <input type="hidden" name="sender_id" value="{{auth()->user()->id}}">
          <input type="hidden" name="reciever_id" value="{{$facultys->first()->user_id}}">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <button type="submit" class="btn btn-primary">Send Message</button>
              <a href="{{ route('faculty-it-services.show', $facultys->first()->id) }}" class="btn btn-info">Back</a>
          </div>
      </form>
      </div>
    </div>
  </div> 


  <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="acceptModalLabel">Enter Internet Credentials</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="acceptForm" action="{{ route('faculty-it-services.store-credentials', $facultys->first()->id) }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="username" class="form-label">Faculty Internet Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Faculty Internet Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-info" type="button" id="togglePassword">
                      Show
                  </button>
                </div>
              </div>
            </div>
          
            <div class="mb-3">
              <label for="username" class="form-label">Faculty Microsoft Username</label>
              <input type="text" class="form-control" id="micro_username" name="micro_username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Faculty Microsoft Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="micro_password" name="micro_password" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-info" type="button" id="togglePassword">
                      Show
                  </button>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Faculty Turnitin Username</label>
              <input type="text" class="form-control" id="turnitin_username" name="turnit_username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Faculty Turnitin Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="turnitin_password" name="turnit_password" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-info" type="button" id="togglePassword">
                      Show
                  </button>
                </div>
              </div>
            </div>
            <div class="mb-3">
                
                    <input type="hidden" class="form-control" id="user-id" name="user_id" value="{{ $facultys->first()->user_id }}" required>
                
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div> 

  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const toggleButton = this;

            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the button text
            toggleButton.textContent = type === 'password' ? 'Show' : 'Hide';
        });
    </script>
</body>
</html>
