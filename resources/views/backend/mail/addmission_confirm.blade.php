<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if ($student['is_admission_confirm'] == 1)
    @php($status = 'confirmed')
    @elseif ($student['is_admission_confirm'] == 0)
    @php ($status = 'Not Confirmed') 
    @else 
    @php ($status = 'Rejected') 
    @endif
    #Name: {{ $Addmission->first_name.' '.$Addmission->last_name  }};
    #status: Your Admission Is {{ $status }}
</body>
</html>