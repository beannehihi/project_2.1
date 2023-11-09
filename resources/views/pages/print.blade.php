<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Apply 'DejaVu Sans' font to body and table, and any other elements as needed */
        body,
        h2,
        th,
        td,
        div {
            font-family: 'DejaVu Sans', sans-serif;
        }

        /* Additional styles for printing, if needed */
        @media print {

            /* Print-specific styles go here */
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="">
        <div class="align-content-center text-center ">
            <h2>PHIẾU THU</h2>
        </div>

        <div class="py-4 text-sm">
            <div>Họ và tên người nộp tiền: {{ $tuitionFee->student->name }}</div>
            <div>Địa chỉ: {{ $tuitionFee->student->location }}</div>
            <div>Chuyên ngành: {{ $tuitionFee->fees->major->name }}</div>
            <div>Ngày sinh: {{ $tuitionFee->student->date_of_birth }}</div>
        </div>

        <table class="table border-primary table-bordered text-sm">
            <thead>
                <tr>
                    <th>Học phí đợt</th>
                    <th>Ngày đóng</th>
                    <th>Tiền nộp</th>
                    <th>Tổng tiền cả khóa</th>
                </tr>
            </thead>
            <tr>
                <td>{{ $tuitionFee->fees->month }}</td>
                <td>{{ $tuitionFee->created_at->format('d/m/y') }}</td>
                <td>{{ number_format($tuitionFee->fee, 0, ',', '.') }}</td>
                <td>{{ number_format($tuitionFee->fees->total_fee, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="d-flex justify-content-between">
            <p>Người lập phiếu <br><span>(Ký, họ tên)</span></p>
            <p>Người nộp tiền <br><span>(Ký, họ tên)</span></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


</html>
