<?php
header('Content-Type: application/json; charset=utf-8');

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method Not Allowed. Only POST submissions are processed.'
    ]);
    exit;
}

// Extract and sanitize inputs
$name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$phone = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
$subject = isset($_POST['subject']) ? trim(strip_tags($_POST['subject'])) : '';
$message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';

// Basic validation check
if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Please fill in all the required fields.'
    ]);
    exit;
}

// Validate email formatting
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Please provide a valid email address.'
    ]);
    exit;
}

// Destination settings
$to = "satamkundu67@gmail.com";
$from = "no-reply@hpwushu.com";

// Build HTML email template
$emailContent = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Inquiry</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: \'Outfit\', Helvetica, Arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
        <tr>
            <td align="center" style="padding: 40px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color: #991b1b; padding: 35px 20px;">
                            <h1 style="color: #ffffff; font-size: 24px; font-weight: 800; margin: 0; letter-spacing: 0.5px; text-transform: uppercase;">
                                Himachal Pradesh Wushu Association
                            </h1>
                            <p style="color: #fecaca; font-size: 13px; font-weight: 500; margin: 8px 0 0 0; text-transform: uppercase; letter-spacing: 1px;">
                                New Contact Form Inquiry
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 40px 30px; background-color: #ffffff;">
                            <p style="font-size: 15px; line-height: 24px; color: #475569; margin: 0 0 30px 0;">
                                Hello Administrator,<br><br>
                                A new inquiry has been submitted via the contact page form on the HP Wushu Association website. Below are the details of the submission:
                            </p>
                            
                            <!-- Detail Info Table -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 10px 12px; background-color: #f8fafc; border-bottom: 1px solid #f1f5f9; font-size: 13px; font-weight: 700; color: #64748b; width: 140px; text-transform: uppercase;">Full Name</td>
                                    <td style="padding: 10px 12px; background-color: #f8fafc; border-bottom: 1px solid #f1f5f9; font-size: 14px; font-weight: 600; color: #1e293b;">' . htmlspecialchars($name) . '</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #f1f5f9; font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase;">Email Address</td>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; font-weight: 600; color: #991b1b;"><a href="mailto:' . urlencode($email) . '" style="color: #991b1b; text-decoration: none;">' . htmlspecialchars($email) . '</a></td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 12px; background-color: #f8fafc; border-bottom: 1px solid #f1f5f9; font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase;">Phone Number</td>
                                    <td style="padding: 10px 12px; background-color: #f8fafc; border-bottom: 1px solid #f1f5f9; font-size: 14px; font-weight: 600; color: #1e293b;"><a href="tel:' . preg_replace('/[^0-9+]/', '', $phone) . '" style="color: #1e293b; text-decoration: none;">' . htmlspecialchars($phone) . '</a></td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #f1f5f9; font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase;">Subject</td>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; font-weight: 600; color: #1e293b;">' . htmlspecialchars($subject) . '</td>
                                </tr>
                            </table>
                            
                            <!-- Message Content Block -->
                            <h3 style="font-size: 14px; font-weight: 700; color: #475569; margin: 0 0 10px 0; text-transform: uppercase; letter-spacing: 0.5px;">Message Details:</h3>
                            <div style="background-color: #f8fafc; border-left: 4px solid #991b1b; padding: 20px; border-radius: 0 8px 8px 0;">
                                <p style="font-size: 14px; line-height: 22px; color: #334155; margin: 0; font-style: italic; white-space: pre-line;">' . htmlspecialchars($message) . '</p>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color: #0f172a; padding: 24px 20px; text-align: center;">
                            <p style="color: #94a3b8; font-size: 11px; margin: 0 0 8px 0; line-height: 16px;">
                                This is an automated email generated from the HP Wushu Association website contact form.
                            </p>
                            <p style="color: #ffffff; font-size: 12px; font-weight: 600; margin: 0;">
                                To reply, click reply to this email or write directly to <a href="mailto:' . urlencode($email) . '" style="color: #fecaca; text-decoration: none;">' . htmlspecialchars($email) . '</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
';

// Setup email headers for sending
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: "HP Wushu Association" <' . $from . '>' . "\r\n";
$headers .= 'Reply-To: "' . $name . '" <' . $email . '>' . "\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion();

// Send using standard PHP mail()
if (mail($to, "HP Wushu Website Query: " . $subject, $emailContent, $headers)) {
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your message has been sent successfully.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'We are sorry, but our mail server failed to deliver the message. Please try again later.'
    ]);
}
?>
