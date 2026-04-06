<?php
// paymentsuccess.php
$total  = isset($_POST['total'])  ? floatval($_POST['total'])  : (isset($_GET['total']) ? floatval($_GET['total']) : 0);
$method = isset($_POST['method']) ? $_POST['method'] : (isset($_GET['method']) ? $_GET['method'] : 'Not Selected');
$txnId  = 'YATRA-' . strtoupper(substr(md5(uniqid('', true)), 0, 8));
$date   = date('d M Y, h:i A');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Payment Success | Yatra.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    :root{--brand:#cc0000;}
    *{box-sizing:border-box}
    body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial;background:#f7f7f9;color:#222}
    header{background:var(--brand);color:#fff;text-align:center;padding:14px 18px;font-weight:700;letter-spacing:.3px}
    .wrap{max-width:560px;margin:24px auto;padding:24px;background:#fff;border-radius:12px;
          box-shadow:0 8px 24px rgba(0,0,0,.08)}
    h2{margin:0 0 6px;color:#2e7d32}
    p.note{margin:6px 0 18px;color:#555}
    .summary{width:100%;border-collapse:collapse;margin-top:8px}
    .summary td{padding:10px 8px;border-bottom:1px solid #eee;vertical-align:top}
    .summary td:first-child{color:#666;width:45%}
    .actions{margin-top:16px}
    .btn{display:inline-block;background:var(--brand);color:#fff;border:none;border-radius:8px;
         text-decoration:none;padding:10px 16px;margin:6px 6px 0;cursor:pointer}
    .btn.outline{background:#fff;color:var(--brand);border:1px solid var(--brand)}
    @media (max-width:480px){.wrap{margin:12px;padding:16px}.btn{width:100%;text-align:center}}
    .warn{background:#fff3cd;border:1px solid #ffe69c;color:#7a5b00;padding:10px;border-radius:8px;margin:10px 0}
  </style>
</head>
<body>
  <header>Yatra.com</header>

  <div class="wrap">
    <?php if ($total <= 0): ?>
      <div class="warn">Amount नहीं मिला। कृपया वापस जाएँ और payment फिर से करें।</div>
      <div class="actions">
        <a href="payment.php" class="btn">⬅️ Back to Payment</a>
        <a href="index.php" class="btn outline">🏠 Home</a>
      </div>
    <?php else: ?>
      <h2>✅ Payment Successful</h2>
      <p class="note">आपकी पेमेंट सफल रही। नीचे रसीद देखें।</p>

      <table class="summary">
        <tr><td>Transaction ID</td><td><?php echo htmlspecialchars($txnId); ?></td></tr>
        <tr><td>Amount Paid</td><td>₹<?php echo number_format($total, 2); ?></td></tr>
        <tr><td>Payment Method</td><td><?php echo htmlspecialchars($method); ?></td></tr>
        <tr><td>Date & Time</td><td><?php echo $date; ?></td></tr>
      </table>

      <div class="actions">
        <button class="btn outline" onclick="window.print()">🖨️ Print Receipt</button>
        <a href="search.php" class="btn">🚌 Book Another</a>
        <a href="index.php" class="btn outline">🏠 Home</a>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>