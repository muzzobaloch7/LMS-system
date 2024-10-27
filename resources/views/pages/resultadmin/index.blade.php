<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>@yield('title')</title>
    <style>
        .bg-cyan {
            background-color: #00BCD4; /* Cyan color */
        }
        .bg-brownish-yellow {
            background-color: #CC9966; /* Brownish-yellow color */
        }
        .header {
            background-color: #00BCD4;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .sidebar {
            background-color: #343a40;
            color: white;
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
    <header class="header d-flex justify-content-between align-items-center p-4 shadow" style="background-color: #0b2f72; color: white;">
        <h1 class="m-0" style="font-size: 1.5rem; font-weight: bold;">{{ Auth::user()->name }}</h1>
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
                            <a class="nav-link active shadow-lg rounded" href="{{ route('result-admin.index') }}" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        @endif
                        
                        <li class="nav-item">
                            <a class="nav-link shadow-lg rounded" href="{{ route('result-admin.create') }}" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-upload"></i> Upload Result
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link shadow-lg rounded" href="{{ route('result-admin.sendMessage') }}" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-envelope"></i> Message
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link shadow-lg rounded" href="{{ route('result-admin.edit', ['result_admin' => Auth::user()->id]) }}" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-user-cog"></i> Profile Settings
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="container shadow-sm my-4 p-3">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('result-admin.create') }}" class="btn btn-primary mx-2" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;">
                            <i class="fas fa-upload"></i> Upload Result
                        </a>
                        <a href="{{ route('result-admin.edit', ['result_admin' => Auth::user()->id]) }}" class="btn btn-secondary mx-2" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;">
                                <i class="fas fa-cog"></i> Profile Setting
                        </a>
                       
                        
                    </div>
                </div>
                @yield('updateUser')
                </div>
            </main>
        </div>
    </div>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>