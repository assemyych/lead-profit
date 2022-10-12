<?php
declare(strict_types=1);

/**
 * Class File
 */
class File
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $fileRegex = '/^[a-z0-9]+\.ixt$/i';

    /**
     * DataFile constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->setPath($path);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return void
     * @throws Exception
     */
    public function setPath(string $path)
    {
        if (!is_dir($path))
            throw new Exception($path . ' not found');

        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getFileRegex(): string
    {
        return $this->fileRegex;
    }

    /**
     * @param string $fileRegex
     * @return void
     */
    public function setFileRegex(string $fileRegex)
    {
        $this->fileRegex = $fileRegex;
    }

    /**
     * @return array
     */
    public function getFiles() : array
    {
        $result = [];

        $path = scandir($this->getPath());
        foreach ($path as $value) {
            if (!preg_match($this->getFileRegex(), $value))
                continue;

            $result[] = $value;
        }

        return $result;
    }
}