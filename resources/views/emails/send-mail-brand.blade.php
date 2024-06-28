<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <p>Chào nhà cung cấp,</p>
    <p>Tôi hy vọng bạn đang có một ngày tốt lành. Tôi viết email này để thông báo về một đơn đặt hàng mới từ một khách hàng của chúng tôi.</p>
    <p>Thông tin đơn hàng:</p>

    <table>
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá tiền</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($order as $item)
                @php
                    $price = $item['product']['price'] ?? 0;
                    $quantity = $item['quantity'] ?? 0;
                    $subtotal = $price * $quantity;
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $item['product']['name'] ?? "" }}</td>
                    <td>{{ $quantity }}</td>
                    <td>{{ number_format($price, 0, ',', '.') }} VND</td>
                    <td>{{ number_format($subtotal, 0, ',', '.') }} VND</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Tổng cộng:</th>
                <th>{{ number_format($total, 0, ',', '.') }} VND</th>
            </tr>
        </tfoot>
    </table>

    <p>Trân trọng,</p>
    <p>[Tên của bạn]</p>
</body>
</html>
