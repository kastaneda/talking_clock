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
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

$command = 'sox ' . join(' ', $files) . ' -t ' . $format . ' -';
passthru($command);
