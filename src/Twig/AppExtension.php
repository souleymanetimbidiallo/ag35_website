<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

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
}
