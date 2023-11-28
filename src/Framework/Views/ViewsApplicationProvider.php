<?php

declare(strict_types=1);

namespace Framework\Views;

use Framework\Engine\ApplicationProvider;
use Framework\Views\Renderers\MustacheViewRenderer;
use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

use function DI\factory;
use function DI\get;

class ViewsApplicationProvider extends ApplicationProvider
{
    public function load(): void
    {
        $this->container->set(
            ViewRenderer::class,
            factory(fn () => new MustacheViewRenderer(
                new Mustache_Engine([
                        'loader' => new Mustache_Loader_FilesystemLoader($this->getViewsPath()),
                    ]
                )
            )),
        );

        $this->container->set('view', get(ViewRenderer::class));
    }

    private function getViewsPath(): string
    {
        return implode(DIRECTORY_SEPARATOR, [
            $this->container->get('base_path'),
            'resources',
            'views',
        ]);
    }

    public function boot(): void
    {
        // ...
    }
}
