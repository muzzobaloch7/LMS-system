<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Staff Portal - University of Gwadar</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Optional custom styles -->
  <style>
    *{
        margin:0;
        padding: 0;
    }
    .header {
        background-color: #00BCD4;
        color: white;
        padding: 10px;
        text-align: center;
    }
    .form-section {
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #fff;
    }
    .header-section {
        text-align: center;
        margin-bottom: 20px;
    }
    .uni-logo {
        
        margin: 0 auto;
    }
    .title-div h1, .title-div h2 {
        margin: 0;
    }
    .main-field-div {
        margin-top: 20px;
    }
    .button-container a {
        border-radius: 20px;
        padding: 10px 20px;
        font-weight: bold;
        transition: background-color 0.3s;
        margin: 5px 0;
    }
    @media (max-width: 768px) {
        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            
        }
        .button-container a, .button-container button {
            margin: 20px 0;
            padding: 20px;
            font-size: 20px;
        }
    }
    @media (max-width: 768px) {
        .header {
            flex-direction: column;
            text-align: center;
        }
        .header .d-flex {
            justify-content:space-between;
            align-items: center;
        }
        
        .header img {
            margin-bottom: 10px;
        }
        .header h2 {
            font-size: 1rem;
        }
        .header a {
            margin-top: 10px;
        }
    }
  </style>
</head>
<body>
    <header class="header d-flex flex-column p-4 shadow" style="background-color: #0b2f72; color: white;">
            <div class="container d-flex justify-content-between align-items-center ">
            <div style = "border-radius: 50%; height: 80px; width: 80px; overflow: hidden; background-color:white;">
                <img class="" src="{{ asset('images/ug-logo.png') }}" alt="University Logo" style="object-fit:cover; height: 100%; width: 100%; margin-left:-3px;">
            </div>
            <h1 class="m-0" style=" font-weight: bold">University of Gwadar Staff Portal</h1>
            <a href="{{ route('logout') }}" class="btn btn-danger " style="border-radius: 5px; padding: 10px 15px; font-weight: bold; margin:0px;   "><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="w-100 text-center mt-3 container">
            <h2 class="m-0" style="font-size: 2.2rem; font-weight: bold;">Welcome <span style="color:#007BFF;">{{ Auth::user()->name }}</span></h2>
        </div>
    </header>


    <div class="container-fluid shadow">
        <div class="row shadow">
            <nav class="col-md-2 d-none d-md-block sidebar" style="background-color: #0b2f72; color: white; height: 100vh;">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item dropdown container-fluid">
                            <a class="nav-link dropdown-toggle shadow-lg rounded" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-user-cog"></i> IT Services
                            </a>
                            <ul class="dropdown-menu container-fluid" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item container-fluid" href="{{ route('faculty-it-services.create') }}">IT Services Form</a></li>
                                <li><a class="dropdown-item container-fluid" href="{{ route('faculty-it-credential') }}">View My Credential</a></li> 
                            </ul>
                        </li>
                        <li class="nav-item container-fluid">
                            <a class="nav-link active shadow-lg rounded" href="{{route('fac-inbox')}}" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-envelope"></i> Inbox
                            </a>
                        </li>
                        <li class="nav-item container-fluid">
                            <a class="nav-link shadow-lg rounded" href="{{ route('logout') }}" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

                <main role="main" class="container col-md-9 ml-sm-auto col-lg-10 px-4">
                <section class="form-section container mt-4">
                    <h1 class="text-center my-5" >Notifications</h1>  
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                              <tr>
                                <th>Sender</th>
                                <th>Receiver</th>
                                <th>Message</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($messages as $message)
                              @if($message->reciever_id==Auth::user()->id)
                              <tr>
                                <td>{{$message->sender_name}}</td>
                                <td>{{Auth::user()->name}}</td>
                                <td>{{$message->message}}</td>
                              </tr>
                            </tbody>
                            @endif
                            @endforeach
                          </table>
                        </div>
                    <div class="button-container d-flex justify-content-center mt-4">
                        <a href="{{ route('staff') }}" class="btn btn-warning" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                </section>
            </main>
        
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>


