<?php
// Encryption key
$key = 'your_secret_key';

// Generate a random 16-byte IV
$iv = openssl_random_pseudo_bytes(16);

// Data to be encrypted
$data = 'Hello, this is a secret message!';

// Encryption algorithm and mode
$algorithm = 'AES-256-CBC';

// Encrypt the data
$encryptedData = openssl_encrypt($data, $algorithm, $key, 0, $iv);

echo 'Encrypted Data: ' . $encryptedData . PHP_EOL;

// Decrypt the data
$decryptedData = openssl_decrypt($encryptedData, $algorithm, $key, 0, $iv);

echo 'Decrypted Data: ' . $decryptedData . PHP_EOL;
?>
