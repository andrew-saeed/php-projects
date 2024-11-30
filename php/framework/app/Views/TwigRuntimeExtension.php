<?php

namespace App\Views;

use App\Core\Config;
use Psr\Container\ContainerInterface;
use Twig\Extension\AbstractExtension;

class TwigRuntimeExtension extends AbstractExtension
{
    public function __construct(protected ContainerInterface $container) {}

    public function config()
    {
        return $this->container->get(Config::class);
    }
}