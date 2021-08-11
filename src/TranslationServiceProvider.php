<?php

declare(strict_types=1);

namespace Pollen\Translation;

use Pollen\Container\BootableServiceProvider;

class TranslationServiceProvider extends BootableServiceProvider
{
    /**
     * @var string[]
     */
    protected $provides = [
        TranslatorInterface::class
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->getContainer()->share(TranslatorInterface::class, function () {
            return new Translator([], $this->getContainer());
        });
    }
}
