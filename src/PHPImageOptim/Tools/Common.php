<?php

namespace PHPImageOptim\Tools;
use PHPImageOptim\PHPImageOptimConfig;
use Exception;

abstract class Common implements ToolsInterface
{
    protected $config;

    protected $binaryPath = '';
    protected $imagePath = '';
    protected $outputPath = '';
    protected $originalFileSize = '';
    protected $finalFileSize = '';
    protected $optimisationLevel = 1;

    /**
     * Establishes configuration for child class and sets default binary path
     */
    public function __construct()
    {
        $config = PHPImageOptimConfig::$config;

        $classArr = explode('\\', get_class($this));
        $class = end($classArr);
        $this->config = !empty($config['libs'][$class]) ? $config['libs'][$class] : [];

        if(!empty($binary = $this->config['binary']))
        {
            $this->setBinaryPath($binary);
        }
    }

    /**
     * Sets the path of the executable
     *
     * @param string $binaryPath
     * @return $this
     * @throws Exception
     */
    public function setBinaryPath($binaryPath = '')
    {
        if (!file_exists($binaryPath))
        {
            throw new Exception('Unable to locate binary file');
        }

        $this->binaryPath = $binaryPath;
        return $this;
    }

    /**
     * Sets the path of the image
     *
     * @param $imagePath
     * @return $this
     * @throws Exception
     */
    public function setImagePath($imagePath)
    {
        if (!file_exists($imagePath))
        {
            throw new Exception('Invald image path');
        }

        if (!is_readable($imagePath))
        {
            throw new Exception('The file cannot be read');
        }

        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * Sets the desired level of optimisation.
     *
     * @param int $level
     * @return $this
     * @throws \Exception
     */
    public function setOptimisationLevel($level = 2)
    {
        if (!is_int($level))
        {
            throw new Exception('Invalid Optimisation Level');
        }

        if ($level !== ToolsInterface::OPTIMISATION_LEVEL_BASIC &&
            $level !== ToolsInterface::OPTIMISATION_LEVEL_STANDARD &&
            $level !== ToolsInterface::OPTIMISATION_LEVEL_EXTREME
        )
        {
            throw new Exception('Invalid Optimisation level');
        }

        $this->optimisationLevel = $level;
        return $this;
    }

    /**
     * Calculates and stores the pre-optimised fileSize
     *
     * @return $this
     */
    public function determinePreOptimisedFileSize()
    {
        $this->originalFileSize = filesize($this->imagePath);
        return $this;
    }

    /**
     * Calculates and stores the post-optimised fileSize
     *
     * @return $this
     */
    public function determinePostOptimisedFileSize()
    {
        $this->finalFileSize = filesize($this->imagePath);
        return $this;
    }

    /**
     * gets version based on configuration
     */
    public function checkVersion()
    {
        if(!empty($version = ' ' . $this->config['version'] . ' '))
        {
            exec($this->binaryPath . $version, $aOutput, $iResult);
        }
    }

    /**
     * gets option string for command line optimization execution
     * @return string command line options
     */
    public function getOptions()
    {
        if(!empty($options = $this->config['options']))
        {
            return ' ' . implode(' ', $options) . ' ';
        }
    }
}