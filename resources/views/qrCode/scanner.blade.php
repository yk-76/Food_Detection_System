@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 text-center">
    <h2 class="text-2xl font-bold mb-4">Scan QR to Login on PC</h2>
    <div id="reader" class="mx-auto" style="width: 300px;"></div>
    <p id="result" class="mt-4 text-orange-600"></p>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    function onScanSuccess(decodedText) {
        // The QR code contains a URL like: https://yourdomain.com/qr-login/TOKEN
        // We redirect the mobile browser to that URL to confirm the session.
        window.location.href = decodedText;
    }

    let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);
</script>
@endsection