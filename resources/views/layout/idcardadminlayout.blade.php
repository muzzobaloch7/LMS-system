<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">


    <title>@yield('title')</title>
    <style>
        .bg-cyan {
            background-color: #00BCD4; /* Cyan color */
        }
        .bg-brownish-yellow {
            background-color: #CC9966; /* Brownish-yellow color */
        }
        .header {
            background-color: #0b2f72;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .sidebar {
            background-color: #0b2f72;
            color: white;
            width: 250px;
            
        }
        .sidebar a {
            color: white;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
    <header class="header d-flex justify-content-between align-items-center p-4 shadow">
        <h1 class="m-0" style="font-size: 1.5rem; font-weight: bold; text-wrap:nowrap;">{{Auth::user()->name}}</h1>
        <div>
            <a href="{{ route('logout') }}" class="btn btn-danger" style="border-radius: 5px; padding: 10px 15px; font-weight: bold;"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </div>
    </header>
    <div class="container-fluid shadow">
        <div class="row shadow">
            <nav class="col-md-2 d-none d-md-block sidebar" style="background-color: #0b2f72; color: white; height: 100vh;">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                    @if(auth()->user()->role === 'mainadmin')
                        <li class="nav-item">
                            <a class="nav-link active shadow-lg rounded" href="{{ route('admin-panel.index') }}" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link active shadow-lg rounded" href="{{ route('admin-panel.id-card-services') }}" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle shadow-lg rounded" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-user-graduate"></i> <span>Student ID Card Records</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #0b2f72; color: white;">
                                <li><a class="dropdown-item" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';" href="{{ route('studentrecords.pending') }}" style="color: white;">Student Pending records</a></li>
                                <li><a class="dropdown-item" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';" href="{{ route('studentrecords.accepted') }}" style="color: white;">Student Accepted records</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle shadow-lg rounded" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-chalkboard-teacher"></i> <span>Staff ID Card Records</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown1" style="background-color: #0b2f72; color: white;">
                                <li><a class="dropdown-item" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';" href="{{ route('facultyrecords.pending') }}" style="color: white;">Staff Pending Records</a></li>
                                <li><a class="dropdown-item" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';" href="{{ route('facultyrecords.accepted') }}" style="color: white;">Staff Accepted Records</a></li>
                            </ul>
                        </li>
                    
                        @if(auth()->user()->role === 'idcardadmin')
                        <li class="nav-item">
                            <a class="nav-link shadow-lg rounded" href="{{ route('idcard-admin-panel.editUser',['user' => Auth::user()->id]) }}" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-user-cog"></i> update Account Details
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>

            <main role="main" class=" col-md-9 ml-sm-auto col-10 px-4 mx-auto">
            @yield('quantity')
            @yield("updateuser")
            @yield("content")
            </main>
        </div>
    </div>

   
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/datatable.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</body>
</html>
