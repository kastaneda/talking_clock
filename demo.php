#!/usr/bin/env php
<?php

require 'src/UkrainianClock.php';
require 'src/WordFiles.php';

$clock = new UkrainianClock(new DateTime());
echo $clock . PHP_EOL;

$dict = json_decode(file_get_contents('data/words.json'), true);
$tts = new WordFiles($dict, 'data');
$files = $tts->getFiles($clock->getClock());

$code = 'aplay -q ' . join(' ', $files);

echo $code . PHP_EOL;
exec($code);
