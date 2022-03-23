<?php

namespace Electro\Server\Misc;

class FileHandler implements \Electro\App\Abstraction\Server\Misc\FileInterface
{

    /**
     * @inheritDoc
     */
    public function __construct(
        public string $filename,
        public string $path,
        public int    $size,
        public string $meme,
        public string $extension)
    {
    }

    /**
     * @inheritDoc
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @inheritDoc
     */
    public function getAddress(): string
    {
        return $this->path;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->filename;
    }

    /**
     * @inheritDoc
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @inheritDoc
     */
    public function copy(string $to, ?string $name = null): bool
    {
        $target = $to;
        if (is_null($name)) {
            $target = $target . $this->filename;
        } else {
            $target = $target . $name;
        }
        return copy($this->path,$target);
    }
}