<?php

class WordFiles
{
    protected array $dict;
    protected string $dirPrefix = '';

    public function __construct(array $dict, string $dir = '')
    {
        $this->dict = $dict;
        $this->dirPrefix = $dir ? ($dir . '/') : '';
    }

    public function getFile(string $word): string
    {
        return $this->dirPrefix . $this->dict[$word];
    }

    public function getFiles(array $words): array
    {
        return array_map(fn ($word) => $this->getFile($word), $words);
    }
}
