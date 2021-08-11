<?php

declare(strict_types=1);

namespace Pollen\Translation;

use Pollen\Support\Concerns\ParamsBagDelegateTraitInterface;

interface LabelsBagInterface extends ParamsBagDelegateTraitInterface
{
    /**
     * Get identifier name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Check if has gender.
     *
     * @return bool
     */
    public function gender(): bool;

    /**
     * Get plural name.
     *
     * @param bool $ucFirst
     *
     * @return string
     */
    public function plural(bool $ucFirst = false): string;

    /**
     * Get plural name with definite article.
     *
     * @param bool $contraction
     *
     * @return string
     */
    public function pluralDefinite(bool $contraction = false): string;

    /**
     * Get plural name with indefinite article.
     *
     * @return string
     */
    public function pluralIndefinite(): string;

    /**
     * Get singular name.
     *
     * @param bool $ucFirst
     *
     * @return string
     */
    public function singular(bool $ucFirst = false): string;

    /**
     * Get singular name with definite article.
     *
     * @param bool $contraction
     *
     * @return string
     */
    public function singularDefinite(bool $contraction = false): string;

    /**
     * Get singular name within definite article.
     *
     * @return string
     */
    public function singularIndefinite(): string;

    /**
     * Enable gender.
     *
     * @param bool $gender
     *
     * @return static
     */
    public function setGender(bool $gender): LabelsBagInterface;

    /**
     * Set identifier name.
     *
     * @param string $name
     *
     * @return static
     */
    public function setName(string $name): LabelsBagInterface;

    /**
     * Set plural name.
     *
     * @param string $plural
     *
     * @return static
     */
    public function setPlural(string $plural): LabelsBagInterface;

    /**
     * Set singular name.
     *
     * @param string $singular
     *
     * @return static
     */
    public function setSingular(string $singular): LabelsBagInterface;

    /**
     * Check if first letter is a Vowel.
     *
     * @return bool
     */
    public function useVowel(): bool;
}