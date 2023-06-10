<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    private $appName;

    public function __construct(string $appName)
    {
        $this->appName = $appName;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('app_name', [$this, 'getAppName']),
        ];
    }

    public function getAppName(): string
    {
        return $this->appName;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('file_exists', [$this, 'fileExistsFilter']),
        ];
    }

    public function fileExistsFilter($path)
    {
        return file_exists($path);
    }
}
