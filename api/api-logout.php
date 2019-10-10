<?php
try {
    session_start();
    session_destroy();
    echo '{"status": 1}';
} catch (Exception $e) {
    echo '{"status": 0, "message":"'.$e.'"}';
};