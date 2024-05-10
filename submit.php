<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$data = [
    'content' => "New contact form submission:\nName: $name\nEmail: $email\nMessage: $message"
];

$webhookUrl = 'https://discord.com/api/v10/webhooks/1238489636574334997/Cn2rcMQXH3meWPKCVGbaqnZfx6rBDjOx8Mgv7hCWfofQNmZc_aCxGCD0tqqNLCyz4wCW';

$options = [
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/json',
        'content' => json_encode($data)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($webhookUrl, false, $context);

if ($result === FALSE) {
    // Handle error
    echo "Error sending message to Discord webhook.";
} else {
    // Message sent successfully
    header("Location: index.html?success=true");
}
