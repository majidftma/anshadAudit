<?php
function encrypt_id($id) {
    $password = 34; // Offset for obfuscation
    $map = "XRYZOMARTB"; // Mapping for digits (0-9)
    
    $id += $password; // Step 1: Add password
    $id_str = strval($id); // Convert to string

    $encrypted = "";
    for ($i = 0; $i < strlen($id_str); $i++) {
        $encrypted .= $map[$id_str[$i]]; // Replace digit with corresponding letter
    }
    
    return $encrypted;
}

function decrypt_id($encrypted) {
    $password = 34;
    $map = "XRYZOMARTB"; // Same mapping

    $decrypted_str = "";
    for ($i = 0; $i < strlen($encrypted); $i++) {
        $decrypted_str .= strpos($map, $encrypted[$i]); // Get the digit back
    }
    
    return intval($decrypted_str) - $password; // Step 2: Subtract password
}

//// Testing
//$original_id = '13';
//$encrypted = encrypt_id($original_id);
//$decrypted = decrypt_id($encrypted);
//
//echo "Original ID: " . $original_id . "\n";
//echo "Encrypted: " . $encrypted . "\n";
//echo "Decrypted: " . $decrypted . "\n";
?>