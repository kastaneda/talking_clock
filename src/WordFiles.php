<?php

class WordFiles
{
    protected $dict;

    public function __construct(
        protected string $dir,
        protected string $dictFile,
    ) {
        $json = file_get_contents($dir . '/' . $dictFile);
        $this->dict = json_decode($json, true);
    }

    public function getFile(string $word): string
    {
        return $this->dir . '/' . $this->dict[$word];
    }

    public function getFiles(array $words): array
    {
        return array_map(fn ($word) => $this->getFile($word), $words);
    }
}
