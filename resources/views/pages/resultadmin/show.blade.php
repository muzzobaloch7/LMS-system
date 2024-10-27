@php
    use App\Models\StudentItService;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <title>Show Result</title>
</head>
<body>
<!-- Start Generation Here -->
<div class="container mt-5">
    <h2 class="text-center">Results</h2>
    <div class="mb-3">
        <a href="{{ route('student') }}" class="btn btn-secondary">Back to Student Portal</a>
    </div>
    @if($result->isEmpty())
    
        <div class="alert alert-warning" role="alert">
            No results found.
        </div>
    @else
        @php
            $user = Auth::user();
            $studentService = StudentItService::where('user_id', Auth::id())->first();
            $userDepartment = $studentService ? $studentService->department : null;
            $userSemester = $studentService ? $studentService->current_semester : null;
            $userProgram = $studentService ? $studentService->degree_program : null;
            $semesters = [1, 2, 3, 4, 5, 6, 7, 8]; // Example semesters
            $terms = [1 => 'Mid Term', 2 => 'Final Term']; // Example terms
        @endphp
        
            <div class="mb-3">
                <label for="semesterSelect" class="form-label">Select Semester:</label>
                <select id="semesterSelect" class="form-select" onchange="window.location.href='?semester=' + this.value + '&term=' + document.getElementById('termSelect').value">
                    <option value="">Select Semester</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester }}" {{ $semester == request('semester', $userSemester) ? 'selected' : '' }}>
                            {{ $semester }} Semester
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="termSelect" class="form-label">Select Term:</label>
                <select id="termSelect" class="form-select" onchange="window.location.href='?semester=' + document.getElementById('semesterSelect').value + '&term=' + this.value">
                    <option value="">Select Term</option>
                    @foreach($terms as $termValue => $termName)
                        <option value="{{ $termValue }}" {{ $termValue == request('term', $userSemester) ? 'selected' : '' }}>
                            {{ $termName }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            @php
                $selectedSemester = request('semester', $userSemester);
                $selectedTerm = request('term', $userSemester);
            @endphp
            @if($result->where('semester', $selectedSemester)->where('term', $selectedTerm)->isEmpty())
                <div class="alert alert-danger" role="alert">
                    ResultNot Found. 
                    <a href="{{ route('student') }}" class="btn btn-primary">Go Back</a>
                </div>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Semester</th>
                            <th>Program</th>
                            <th>Term</th>
                            <th>Result Photo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result as $res)
                            @if($res->semester == $selectedSemester && $res->program ==$studentService->degree_program && $res->term == $selectedTerm )
                                <tr>
                                    <td>{{ $res->semester }} Semester</td>
                                    <td>
                                        @switch($res->program)
                                            @case(1) BSIT @break
                                            @case(2) BSDS @break
                                            @case(3) B.ED @break
                                            @case(4) B.COM @break
                                            @case(5) BBA @break
                                            @case(6) BS.Chemistry @break
                                            @case(7) BS.English @break
                                            @case(8) BS.Economic @break
                                            @default Unknown Program
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($res->term)
                                            @case(1) Mid Term @break
                                            @case(2) Final Term @break
                                            @default Unknown Term
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($res->photo)
                                            <img src="{{ asset('storage/' . $res->photo) }}" alt="Result Photo" class="img-thumbnail rounded mx-auto d-block" style="width: 600px; height: 400px;">
                                        @else
                                            No Photo Available
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endif
</div>
<!-- End Generation Here -->
    
</body>
</html>