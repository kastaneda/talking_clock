#!/usr/bin/env php
<?php
require 'src/UkrainianClock.php';
require 'src/WordFiles.php';

$clock = new UkrainianClock(new DateTime());
echo $clock . PHP_EOL;

$tts = new WordFiles('data', 'words.json');
$files = $tts->getFiles($clock->getClock());

$code = 'aplay -q ' . join(' ', $files);

echo $code . PHP_EOL;
exec($code);
