<?php

namespace LazyTranslations\Lib;

use Aura\Intl\TranslatorInterface;
use Cake\I18n\I18n;
use JsonSerializable;

/**
 * LazyTranslation class for storing translations and lazily evaluating them.
 *
 * @package LazyTranslations\Lib
 */
class LazyTranslation implements JsonSerializable
{
    protected $_key = '';
    protected $_args = [];
    protected $_evaluation = null;

    /**
     * Translation constructor.
     * We do not evaluate the translation here.
     * This is done in the evaluate() function.
     *
     * @param string $key
     * @param array  $args
     */
    public function __construct(string $key, array $args = [])
    {
        $this->setKey($key)
            ->setArgs($args);
    }

    /**
     * Returns the translation key.
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->_key;
    }

    /**
     * Overwrites the key.
     *
     * @param string $key Translation key
     * @return LazyTranslation
     */
    public function setKey(string $key): LazyTranslation
    {
        $this->_key = $key;

        return $this;
    }

    /**
     * Gets the args.
     *
     * @return array
     */
    public function getArgs(): array
    {
        return $this->_args;
    }

    /**
     * Overwrites the args.
     *
     * @param array $args
     * @return LazyTranslation
     */
    public function setArgs(array $args): LazyTranslation
    {
        $this->_args = $args;

        return $this;
    }

    /**
     * Returns the translator.
     *
     * @return \Aura\Intl\TranslatorInterface
     */
    public function getTranslator(): TranslatorInterface
    {
        return I18n::translator();
    }

    /**
     * Evaluates this translation.
     *
     * @return string
     */
    public function evaluate(): string
    {
        if (is_null($this->_evaluation)) {
            $args = $this->_args;
            if (isset($this->_args[0]) && is_array($this->_args[0])) {
                $args = $this->_args[0];
            }

            $this->_evaluation = $this->getTranslator()->translate($this->_key, $args);
        }

        return $this->_evaluation;
    }

    /**
     * Evaluates the translation when casting to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->evaluate();
    }

    /**
     * Evaluates the translation when casting to json.
     *
     * @return string
     */
    function jsonSerialize(): string
    {
        return $this->evaluate();
    }
}
