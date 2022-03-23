<?php

namespace Electro\App\Abstraction\Server\Misc;

interface FileInterface
{
    /**
     * @param string $filename
     * @param string $path
     * @param int $size
     * @param string $meme
     */
    public function __construct(string $filename, string $path, int $size, string $meme, string $extension);

    /**
     * @return int
     */
    public function getSize(): int;

    /**
     * @return string
     */
    public function getAddress(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getExtension(): string;

    /**
     * @param string $to
     * @param string|null $name
     * @return bool
     */
    public function copy(string $to, ?string $name = null): bool;


}