<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admission Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #222;
            color: #fff;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .divider {
            border-top: 2px solid #a77f00;
            margin: 20px 0;
        }
        .content {
            text-align: left;
            color: #ddd;
        }
        .content h1 {
            font-size: 22px;
            margin-bottom: 10px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
        }
        .highlight {
            color: #a77f00;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #ccc;
        }
        .social-icons img {
            width: 30px;
            height: 30px;
            margin: 0 10px;
        }
        .footer p {
            margin: 5px 0;
        }

        /* Responsive Styles */
        @media screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }
            .content p {
                font-size: 14px; /* Smaller font size for mobile devices */
            }
            .logo img {
                width: 80px; /* Smaller logo for mobile devices */
            }
            .social-icons img {
                width: 24px; /* Smaller social media icons for mobile devices */
                height: 24px;
            }
            .footer {
                font-size: 12px; /* Smaller footer text for mobile devices */
            }
        }
    </style>
</head>
<body>
    @if ($student['is_admission_confirm'] == 1)
    @php($status = 'confirmed')
    @elseif ($student['is_admission_confirm'] == 0)
    @php ($status = 'Not Confirmed') 
    @else 
    @php ($status = 'Rejected') 
    @endif
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <a href="#"><img src="{{ $message->embed(public_path('assets/image/logo.png')) }}" alt="Logo" width="100"></a>
        </div>

        <!-- Divider -->
        <div class="divider"></div>

        <!-- Content -->
        <div class="content">
            <p>Hi {{ $Addmission->first_name.' '.$Addmission->last_name }},</p>
            <p>#status: Your Admission Is {{ $status }}</p>
            <p>Following room has been allotted to you for the current year:</p>
            <p><span class="highlight">Hostel Name:</span> Matrushri Veliben Kanji Premji Kanya & Kumar Seva Sadan</p>
            <p><span class="highlight">Room No:</span> 403</p>
            <p><span class="highlight">Bed No:</span> 403-E</p>
        </div>

        <!-- Divider -->
        <div class="divider"></div>

        <!-- Footer -->
        <div class="footer">
            <div class="social-icons">
                <a href="#"><img src="facebook-icon-url.png" alt="Facebook"></a>
                <a href="#"><img src="instagram-icon-url.png" alt="Instagram"></a>
            </div>
            <p>Address: Saint Xavier's School Road, Opp. Karnnath Mahadev Temple, Naranpura, Ahmedabad - 380013</p>
            <p>Contact Info: M: +91 9099211718 | Email: student@sklpsahmedabad.com</p>
            <p>© 2024 Shree Kutchi Leva Patel Samaj - Ahmedabad. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
