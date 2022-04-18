<?php

define('APP_ROOT', dirname(__DIR__));
require APP_ROOT . '/src/UkrainianClock.php';
require APP_ROOT . '/src/WordFiles.php';

$clock = new UkrainianClock(new DateTime());

$dict = json_decode(file_get_contents(APP_ROOT . '/data/words.json'), true);
$tts = new WordFiles($dict, APP_ROOT . '/data');
$files = $tts->getFiles($clock->getClock());

if (($_GET['type'] ?? '') == 'ogg') {
    $format = 'ogg';
    $mime = 'audio/ogg';
} else {
    $format = 'wav';
    $mime = 'audio/wav';
}

header('Content-type: ' . $mime);
header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Expires: 01 Jan 1970 00:00:00 GMT');

$command = 'sox ' . join(' ', $files) . ' -t ' . $format . ' -';
passthru($command);
