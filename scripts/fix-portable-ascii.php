<?php
/**
 * Fix deprecated nullable parameter in voku/portable-ascii
 * This addresses: "Implicitly marking parameter $replace_single_chars_only as nullable is deprecated"
 * 
 * Run with: php scripts/fix-portable-ascii.php
 */

$file = __DIR__ . '/../vendor/voku/portable-ascii/src/voku/helper/ASCII.php';

if (!file_exists($file)) {
    echo "Error: File not found at $file\n";
    exit(1);
}

$content = file_get_contents($file);
$original = $content;

// Replace the line with the nullable type declaration
$content = preg_replace(
    '/(\s+)bool \$replace_single_chars_only = false\n(\s+)\): string \{/',
    '${1}?bool $replace_single_chars_only = false' . "\n" . '${2}): string {',
    $content
);

if ($content === $original) {
    echo "Warning: Pattern not found or already patched\n";
    exit(0);
}

if (file_put_contents($file, $content) === false) {
    echo "Error: Failed to write to $file\n";
    exit(1);
}

echo "✓ Successfully fixed deprecated parameter in voku/portable-ascii\n";
exit(0);
