<!DOCTYPE html>
<html>

<head>
    <title>Daily Sales Report</title>
</head>

<body>
    <h1>Daily Sales Report ({{ $sales_data->date }})</h1>
    <p>Total Amount: {{ $sales_data->total_amount }}</p>
    <p>Total Quantity: {{ $sales_data->total_qty }}</p>
</body>

</html>