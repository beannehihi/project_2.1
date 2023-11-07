<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu Thu</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="header">
            <h2>PHIẾU THU</h2>
        </div>

        <div class="info">
            <div>Họ và tên người nộp tiền: {{ $tuitionFee->student->name }}</div>
            <div>Địa chỉ: {{ $tuitionFee->student->location }}</div>
            <div>Chuyên ngành: {{ $tuitionFee->fees->major->name }}</div>
            <div>Ngày sinh: {{ $tuitionFee->student->date_of_birth }}</div>
        </div>

        <table class="payment-details">
            <tr>
                <th>Học phí đợt</th>
                <th>Ngày đóng</th>
                <th>Tiền nộp</th>
                <th>Tổng tiền cả khóa</th>


            </tr>
            <tr>
                <td>{{ $tuitionFee->fees->month }}</td>
                <td>{{ $tuitionFee->created_at->format('d/m/y') }}</td>
                <td>{{ number_format($tuitionFee->fee, 0, ',', '.') }}</td>
                <td>{{ number_format($tuitionFee->fees->total_fee, 0, ',', '.') }}</td>
            </tr>
            <!-- Add more rows as needed -->
        </table>


        <div class="footer">
            Học phí đã đóng không hoàn trả trong bất cứ trường hợp nào!
            Viết bằng chữ: Ba mươi sáu triệu đồng.
            Mọi thông tin chi tiết xin vui lòng liên hệ số hotline: 1900 1000
        </div>

        <div class="signature">
            <div>Giam đốc (Ký, họ tên, đóng dấu)</div>
            <div>Kế toán trưởng (Ký, họ tên)</div>
            <div>Người nộp tiền (Ký, họ tên)</div>
            <div>Người lập phiếu (Ký, họ tên)</div>
            <div>Thủ quỹ (Ký, họ tên)</div>
        </div>
    </div>
</body>

</html>
