#!/usr/bin/env php
<?php

declare(strict_types=1);

$requiredFiles = [
    'composer.json',
    'phpunit.xml.dist',
    'phpstan.neon.dist',
    'pint.json',
    'testbench.yaml',
    'src/SafeHavenClient.php',
];

$missing = array_values(array_filter(
    $requiredFiles,
    static fn (string $file): bool => ! is_file(__DIR__.'/'.$file),
));

if ($missing !== []) {
    fwrite(STDERR, "SafeHaven package configuration is incomplete:\n");
    fwrite(STDERR, implode("\n", array_map(static fn (string $file): string => "- {$file}", $missing))."\n");
    exit(1);
}

$composer = json_decode((string) file_get_contents(__DIR__.'/composer.json'), true, 512, JSON_THROW_ON_ERROR);

if (($composer['name'] ?? '') !== 'eminisolomon/safehaven') {
    fwrite(STDERR, "Unexpected package name in composer.json.\n");
    exit(1);
}

fwrite(STDOUT, "SafeHaven package configuration is valid.\n");
