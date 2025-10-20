<?php

define('APP_ROOT', dirname(__DIR__));
require APP_ROOT . '/src/UkrainianClock.php';
require APP_ROOT . '/src/WordFiles.php';

$tz = new DateTimeZone('Europe/Kyiv');
try {
    if (isset($_GET['tzoffset'])) {
        $tzOffset = (int) $_GET['tzoffset'];
        $tz = new DateTimeZone(sprintf('%s%02d%02d',
            $tzOffset < 0 ? '+' : '-', 
            (int) -$tzOffset / 60, -$tzOffset % 60));
    }
} catch (Exception $e) {}

$clock = new UkrainianClock(new DateTime('now', $tz));

$dict = json_decode(file_get_contents(APP_ROOT . '/data/words.json'), true);
$tts = new WordFiles($dict, APP_ROOT . '/data');
$files = $tts->getFiles($clock->getClock());

header('Content-type: audio/wav');
header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Expires: 01 Jan 1970 00:00:00 GMT');

// Lazy way
// $command = 'sox ' . join(' ', $files) . ' -t wav -';
// passthru($command);

// Another way, simple WAV join with zero extra dependencies
// Requires same bitrate and standard 44-byte header for all WAV files

$header = $data = '';
foreach ($files as $file) {
    $wav = file_get_contents($file);
    $header = substr($wav, 0, 44);
    $data .= substr($wav, 44);
}

$subchunk2Size = strlen($data);
$header = substr_replace($header, pack('V', $subchunk2Size), 40, 4);
$chunkSize = $subchunk2Size + 36;
$header = substr_replace($header, pack('V', $chunkSize), 4, 4);

echo $header;
echo $data;
