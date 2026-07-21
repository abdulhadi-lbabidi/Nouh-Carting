<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password - Nouh Carting</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #121212; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; direction: ltr;">

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" style="padding: 40px 15px;">

                <table role="presentation" width="100%"
                    style="max-width: 600px; background-color: #1a1a1a; border-radius: 24px; overflow: hidden; box-shadow: 0 12px 35px rgba(0, 0, 0, 0.4); border: 1px solid #2c2c2c;">

                    <!-- Header with Dark Theme & Centered Burger Icon -->
                    <tr>
                        <td align="center"
                            style="background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%); padding: 45px 20px;">
                            <!-- Centered Burger Icon Container -->

                            <h2
                                style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 600; letter-spacing: 0.5px; text-align: center;">
                                Nouh Carting</h2>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 45px 35px; text-align: left;">
                            <h1 style="color: #ffffff; font-size: 22px; margin: 0 0 20px 0; font-weight: 700;">Forgot
                                Your Password?</h1>

                            <p style="color: #aaaaaa; font-size: 15px; line-height: 1.7; margin-bottom: 20px;">
                                Hello, <br>
                                We received a request to reset the password for your account. Let's get you back to your
                                delicious meals and fresh orders!
                            </p>

                            <p style="color: #aaaaaa; font-size: 15px; line-height: 1.7; margin-bottom: 30px;">
                                Click the secure button below to choose a new password:
                            </p>

                            <!-- Call to Action Button -->
                            <div style="text-align: center; margin-bottom: 35px;">
                                <a href="http://127.0.0.1:5173/reset-password?token={{ $token }}&email={{ $email }}"
                                    style="background-color: #ffffff; color: #000000; padding: 16px 38px; text-decoration: none; border-radius: 50px; font-weight: 600; font-size: 15px; display: inline-block; box-shadow: 0 6px 20px rgba(255, 255, 255, 0.15);">
                                    Reset My Password
                                </a>
                            </div>

                            <!-- Fallback Link Box -->
                            <div
                                style="background-color: #222222; padding: 18px; border-radius: 12px; margin-bottom: 25px; border-left: 4px solid #ffffff;">
                                <p style="margin: 0 0 8px 0; font-size: 12px; color: #888888; font-weight: 600;">Button
                                    not working? Copy and paste this link:</p>
                                <p style="margin: 0; font-size: 12px; word-break: break-all; color: #cccccc;">
                                    http://127.0.0.1:5173/reset-password?token={{ $token }}&email={{ $email }}
                                </p>
                            </div>

                            <p
                                style="color: #777777; font-size: 13px; border-top: 1px solid #2c2c2c; padding-top: 20px; line-height: 1.5;">
                                <strong>Note:</strong> This security link is valid for <strong>60 minutes</strong> only.
                                <br>
                                If you didn't request a password reset, you can safely ignore this email.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="padding: 25px; background-color: #161616; border-top: 1px solid #2c2c2c;">
                            <p style="margin: 0; font-size: 12px; color: #777777; font-weight: 500;">©
                                {{ date('Y') }} Nouh Carting. All rights reserved.</p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>

</html>
