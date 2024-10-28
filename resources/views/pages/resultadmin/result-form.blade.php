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
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .navbar, .sidebar-heading, .list-group-item {
            transition: background-color 0.3s ease-in-out;
        }
        .navbar:hover, .sidebar-heading:hover, .list-group-item:hover {
            background-color: #004085;
        }
        .form-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .photo-preview {
            display: none;
            margin-top: 10px;
            max-width: 400px;
            max-height: 400px;
            border-radius: 10px; /* Apply border radius */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Apply box shadow for 3D effect */
            border: 2px solid #ccc; /* Add border for separation */
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            border-radius: 10px;
        }
        .popup img {
            max-width: 600px;
            max-height: 500px;
        }
        .popup .close-btn {
            display: block;
            margin-top: 10px;
            text-align: center;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
    <script>
        function previewPhoto(event) {
            const photoPreview = document.getElementById('photo-preview');
            photoPreview.src = URL.createObjectURL(event.target.files[0]);
            photoPreview.style.display = 'block';
        }

        function openPopup() {
            document.getElementById('popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
</head>
<body>
    <header class="header d-flex justify-content-between align-items-center p-4 shadow" style="background-color: #0b2f72; color: white;">
        <h1 class="m-0" style="font-size: 1.5rem; font-weight: bold;">{{ Auth::user()->name }}</h1>
        <div>
            <a href="{{ route('logout') }}" class="btn btn-danger" style="border-radius: 5px; padding: 10px 15px; font-weight: bold;">Logout</a>
        </div>
    </header>

    <div class="container-fluid shadow">
        <div class="row shadow">
            <nav class="col-md-2 d-none d-md-block sidebar" style="background-color: #0b2f72; color: white; height: 110vh;">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active shadow-lg rounded" href="{{ route('result-admin.index') }}" style="color: white; padding: 10px; transition: background-color 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin: 5px 0;" onmouseover="this.style.backgroundColor='#007BFF'" onmouseout="this.style.backgroundColor='';">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
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
            <!-- <div class="container shadow-sm my-4 p-3">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('result-admin.create') }}" class="btn btn-primary mx-2" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;">
                            <i class="fas fa-upload"></i> Upload Result
                        </a>
                        <a href="{{ route('result-admin.edit', ['result_admin' => Auth::user()->id]) }}" class="btn btn-secondary mx-2" style="border-radius: 20px; padding: 10px 20px; font-weight: bold; transition: background-color 0.3s;">
                                <i class="fas fa-cog"></i> Profile Setting
                        </a>
                       
                        
                    </div>
                </div>
                -->
<!-- Main Component: Upload Result Form -->
<div class="container mt-5 " >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card animate__animated animate__fadeInUp" style="background-color: #f8f9fa; color: black;">
                <div class="card-header" style="background-color: #007BFF; color: white;">
                    <h4 class="mb-0">Upload Result Form</h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('result-admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <select class="form-select" id="department" name="department" required>
                                <option value="" selected disabled>Select department</option>
                                <option value="1">Computer Science</option>
                                <option value="2">Commerce</option>
                                <option value="3">BBA</option>
                                <option value="4">Education</option>
                                <option value="5">English</option>
                                <option value="6">Chemistry</option>
                                <option value="7">Economic</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="program" class="form-label">Program</label>
                            <select class="form-select" id="program" name="program" required>
                                <option value="" selected disabled>Select Program</option>
                                <option value="1">BSIT</option>
                                <option value="2">BSDS</option>
                                <option value="3">B.ED</option>
                                <option value="4">B.COM</option>
                                <option value="5">BBA</option>
                                <option value="6">BS.Chemistry</option>
                                <option value="7">BS.English</option>
                                <option value="8">BS.Economic</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select" id="semester" name="semester" required>
                                <option value="" selected disabled>Select Semester</option>
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}">{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Semester</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="term" class="form-label">Term</label>
                            <select class="form-select" id="term" name="term" required>
                                <option value="" selected disabled>Select Term</option>
                                <option value="1">Mid Term</option>
                                <option value="2">Final Term</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Upload Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" required accept="image/*" onchange="previewPhoto(event)">
                        </div>
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-info" onclick="openPopup()">Open Photo Preview</button>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('result-admin.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="popup" class="popup">
        <img id="popup-photo-preview" src="" alt="Popup Photo Preview">
        <button class="btn btn-secondary close-btn" onclick="closePopup()">Close</button>
    </div>
    <div id="overlay" class="overlay" onclick="closePopup()"></div>

            </main>
        </div>
    </div>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script>
        document.getElementById('photo').addEventListener('change', function(event) {
            const popupPhotoPreview = document.getElementById('popup-photo-preview');
            const file = event.target.files[0];
            const url = URL.createObjectURL(file);
            popupPhotoPreview.src = url;
            photoPreview.style.display = 'block';
        });
    </script>
</body>
</html>