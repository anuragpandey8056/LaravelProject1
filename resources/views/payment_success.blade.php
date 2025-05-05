<!-- resources/views/emails/payment_success.blade.php -->

<!DOCTYPE html>
<html>
<body>









  <h2>Hi {{ $tenantData['name'] }},</h2>
  <p>Thank you for your payment of rupees {{ $tenantData['amount'] }}. Your plan has been activated successfully.</p>
  <p><strong>Your domain:</strong> <a href="http://{{ $tenantData['domain'] }}" target="_blank">{{ $tenantData['domain'] }}</a></p>
  <p>You can now access your website using this domain.</p>
  <br>
  <p>Regards,<br>Mehak</p>








</body>
</html>