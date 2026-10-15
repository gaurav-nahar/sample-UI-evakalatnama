<?php
if (!function_exists('e')) {
    function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
}

/** "Good morning" / "Good afternoon" / "Good evening" in Indian time. */
function greeting(): string {
    $h = (int)(new DateTime('now', new DateTimeZone('Asia/Kolkata')))->format('G');
    return $h < 12 ? 'Good morning' : ($h < 17 ? 'Good afternoon' : 'Good evening');
}

function first_name(string $name): string {
    $name = trim($name);
    return $name === '' ? 'Advocate' : explode(' ', $name)[0];
}

function initials(string $name): string {
    $parts = preg_split('/\s+/', trim($name)) ?: [];
    $out = '';
    foreach (array_slice($parts, 0, 2) as $p) { $out .= mb_strtoupper(mb_substr($p, 0, 1)); }
    return $out ?: '?';
}

/** Show only the last 4 digits of a mobile number. */
function mask_mobile(string $m): string {
    $d = preg_replace('/\D/', '', $m);
    return strlen($d) >= 4 ? '+91 ••••• •' . substr($d, -4) : $m;
}
