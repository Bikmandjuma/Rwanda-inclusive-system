<!DOCTYPE html>
<html>
<head>
    <title>Result Slip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .float-left {
            float: left;
            width: 50%;
            box-sizing: border-box; /* Ensures padding and border are included in width */
        }
        .float-right {
            float: right;
            width: 50%;
            text-align: right;
            box-sizing: border-box; /* Ensures padding and border are included in width */
        }
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
    <div class="clearfix">
        <div class="float-left">
            <p>REPUBLIC OF RWANDA</p>
            <p>MINISTRY OF EDUCATION</p>
            <p>RWANDA INCLUSIVE SYSTEM</p>
        </div>
        <div class="float-right">
            <p>YEAR: {{ $current_year }}</p>
            <p>CLASS: ONLINE EXAM</p>
            <p>Name: {{ Auth::guard('user')->user()->firstname }} {{ Auth::guard('user')->user()->lastname }}</p>
        </div>
    </div>

    <br>

    <table>
        <thead>
            <tr>
                <th colspan="2">Course</th>
                <th colspan="2">Marks</th>
            </tr>
            <tr>
                <th>Course code</th>
                <th>Course name</th>
                <th>MAX</th>
                <th>F.A (%)</th>
            </tr>
            <tr>
                <td colspan="4">Complementary modules</td>
            </tr>
        </thead>
        <tbody>
            @foreach($modules_marks as $data)
                <tr>
                    <td>{{ substr($data->course_name, 0, 4) }}</td>
                    <td>{{ $data->exam_name }}</td>
                    <td>{{ $data->total_marks }}</td>
                    <td>
                        @if($data->total_marks / 2 > $data->total_score)
                            <span style="color: red;">{{ $data->total_score }}</span>
                        @else
                            {{ $data->total_score }}
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr>
                <th colspan="2">TOTAL</th>
                <th>{{ $sum_total_marks }}</th>
                <th>{{ $sum_total_scores }}</th>
            </tr>
            <tr>
                <th colspan="2">AVERAGE MARKS</th>
                <th></th>
                <th>{{ round($marks_got, 2) }}%</th>
            </tr>
        </tbody>
    </table>
</body>
</html>
