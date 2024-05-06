<!-- your_view_name.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>QR Code</title>
</head>

<body>
    @php
        return QrCode::size(400)->generate($qrCodeUrl);
    @endphp
</body>

</html>
