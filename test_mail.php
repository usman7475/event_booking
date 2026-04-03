<?php
// Test Gmail SMTP Configuration
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/bootstrap/app.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Testing Gmail SMTP Configuration ===\n\n";

echo "1. Configuration Values:\n";
echo "   MAIL_MAILER: " . config('mail.default') . "\n";
echo "   MAIL_HOST: " . config('mail.mailers.smtp.host') . "\n";
echo "   MAIL_PORT: " . config('mail.mailers.smtp.port') . "\n";
echo "   MAIL_FROM: " . config('mail.from.address') . "\n";
echo "   MAIL_USERNAME: " . config('mail.mailers.smtp.username') . "\n";
echo "   MAIL_ENCRYPTION: " . config('mail.mailers.smtp.encryption') . "\n\n";

echo "2. Attempting to send test email...\n";

try {
    \Illuminate\Support\Facades\Mail::raw('This is a test email from Event Booking System', function ($message) {
        $message->to('usmanyounis7475@gmail.com')
                ->subject('Test Email - Event Booking');
    });
    
    echo "   ✅ Email sent successfully!\n";
} catch (\Exception $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . " (Line: " . $e->getLine() . ")\n";
}

echo "\nTest completed!\n";
