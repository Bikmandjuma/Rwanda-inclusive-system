<!DOCTYPE html>
<html>
<head>
    <title>Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        .certificate {
            border: 10px solid #ddd;
            padding: 50px;
            position: relative;
        }
        .certificate h1 {
            font-size: 50px;
        }
        .certificate h2 {
            font-size: 40px;
        }
        .certificate p {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <h1>Certificate of Completion</h1>
        <h2>{{ $examTitle }}</h2>
        <p>This is to certify that</p>
        <h2>{{ $firstname }}</h2>
        <p>has successfully completed the exam with a score of</p>
        <h2>{{ $marks_got }}/{{ $total_marks }}</h2>
        <p>{{ $message }}</p>
    </div>
</body>
</html>
