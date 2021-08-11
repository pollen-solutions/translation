<?php

declare(strict_types=1);

namespace Pollen\Translation;

use Pollen\Support\Concerns\ParamsBagDelegateTrait;
use Pollen\Support\Str;

class LabelsBag implements LabelsBagInterface
{
    use ParamsBagDelegateTrait;

    /**
     * Has gender indicator.
     * @var bool
     */
    protected bool $gender = false;

    /**
     * Identifier name.
     * @var string
     */
    protected string $name = '';

    /**
     * Plural name.
     * @var string
     */
    protected string $plural = '';

    /**
     * Singular name.
     * @var string
     */
    protected string $singular = '';

    /**
     * Create a new instance.
     *
     * @param array<string, string> $labels
     * @param string|null $name
     *
     * @return LabelsBagInterface
     */
    public static function create(array $labels, ?string $name = null): LabelsBagInterface
    {
        $self = new static();

        if ($name !== null) {
            $self->setName($name);
        }

        $self->set($labels);

        if ($self->has('gender')) {
            $self->setGender((bool)$self->pull('gender'));
        }

        if ($self->has('plural')) {
            $self->setPlural(lcfirst($self->pull('plural')));
        }

        if ($self->has('singular')) {
            $self->setSingular(lcfirst($self->pull('singular')));
        }

        $self->parse();

        return $self;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function gender(): bool
    {
        return $this->gender;
    }

    /**
     * @inheritDoc
     */
    public function plural(bool $ucFirst = false): string
    {
        $str = $this->plural ?: 'éléments';

        return $ucFirst ? Str::ucfirst($str) : $str;
    }

    /**
     * @inheritDoc
     */
    public function pluralDefinite(bool $contraction = false): string
    {
        if ($contraction) {
            return 'des ' . $this->plural();
        }

        return 'les '. $this->plural();
    }

    /**
     * @inheritDoc
     */
    public function pluralIndefinite(): string
    {
        $prefix = $this->useVowel() ? 'd\'' : 'des ';

        return $prefix . $this->plural();
    }

    /**
     * @inheritDoc
     */
    public function singular(bool $ucFirst = false): string
    {
        $str = $this->singular ?: 'élément';

        return $ucFirst ? Str::ucfirst($str) : $str;
    }

    /**
     * @inheritDoc
     */
    public function singularDefinite(bool $contraction = false): string
    {
        if ($contraction) {
            if ($this->useVowel()) {
                $prefix = 'de l\'';
            } else {
                $prefix = $this->gender() ? 'de la ' : 'du ';
            }

            return $prefix . $this->singular();
        }
            if ($this->useVowel()) {
                $prefix = 'l\'';
            } else {
                $prefix = $this->gender() ? 'la ' : 'le ';
            }

            return $prefix . $this->singular();
    }

    /**
     * @inheritDoc
     */
    public function singularIndefinite(): string
    {
        $prefix = $this->gender() ? 'une' : 'un';

        return $prefix . ' ' . $this->singular();
    }

    /**
     * @inheritDoc
     */
    public function setGender(bool $gender): LabelsBagInterface
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): LabelsBagInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPlural(string $plural): LabelsBagInterface
    {
        $this->plural = $plural;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setSingular(string $singular): LabelsBagInterface
    {
        $this->singular = $singular;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function useVowel(): bool
    {
        $first = strtolower(mb_substr(remove_accents($this->singular()), 0, 1));

        return in_array($first, ['a', 'e', 'i', 'o', 'u', 'y']);
    }
}