<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Invoice - EcoSecure Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 40px;
        }
        .invoice-box {
            max-width: 700px;
            margin: auto;
            padding: 30px;
            border: 1px solid #dee2e6;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-logo {
            max-width: 150px;
            height: auto;
        }
        .section-title {
            color: #0b1c35;
            border-bottom: 2px solid #0b1c35;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }
        .invoice-details p {
            margin-bottom: 10px;
        }
        .footer-text {
            text-align: center;
            color: #6c757d;
            margin-top: 20px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    Date : {{now()}}
    <div class="invoice-header d-flex justify-content-between">
        <img style="height: 100px;" height="100px" src="{{ asset('logo3.png') }}" alt="MyWebsite Logo" class="invoice-logo">
        <h3 class="mt-3" style="color: #0b1c35;">EcoSecure Home</h3>
    </div>
    <h4 class="text-center mt-4 mb-4">Subscription Invoice</h4>

    <div class="invoice-details">
        <h5 class="section-title">Customer Information</h5>
        <p><strong>Customer:</strong> {{ auth()->user()->accountName }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>

        <h5 class="section-title">Subscription Details</h5>
        <p><strong>Payment Method:</strong> {{ $sub->PaymentMethod }}</p>
        <p><strong>Amount:</strong> {{ $sub->paymentAmount }} SAR</p>
        <p><strong>Start Date:</strong> {{ $sub->startDate }}</p>
        <p><strong>End Date:</strong> {{ $sub->endDate }}</p>
        <p><strong>Status:</strong> <span class="badge {{ $sub->subscriptionStatus == 'active' ? 'text-bg-success' : 'text-bg-warning' }}">{{ ucfirst($sub->subscriptionStatus) }}</span></p>
    </div>

    <div class="footer-text">
        Thank you for choosing EcoSecure Home! For support, contact us at support@mywebsite.com
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.print();
</script>
</body>
</html>
