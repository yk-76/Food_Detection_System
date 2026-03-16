<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #f3f3f3; border-radius: 10px;">
        <h2 style="color: #fb923c;">Reset Your Password</h2>
        <p>Hello,</p>
        <p>You requested a password reset. Use the code below to complete the process. This code is valid for 15 minutes.</p>
        
        <div style="background-color: #fff7ed; padding: 20px; text-align: center; border-radius: 8px; margin: 20px 0;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #ea580c;">
                {{ $code }}
            </span>
        </div>
        
        <p>If you did not request this, please ignore this email.</p>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #777;">CodeCamp Team</p>
    </div>
</body>
</html>