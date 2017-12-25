<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Model\Catalog\Product\Option\Type;

class Typography extends \Magento\Catalog\Model\Product\Option\Type\DefaultType
{
    /**
     * Validate user input for option
     *
     * @param array $values All product option values, i.e. array (option_id => mixed, option_id => mixed...)
     * @return $this
     */
    public function validateUserValue($values)
    {
        $this->setIsValid(true);
        return $this;
    }

    /**
     * Check skip required option validation
     *
     * @return bool
     */
    public function getSkipCheckRequiredOption()
    {
        return true;
    }

    /**
     * Flag to indicate that custom option has own customized output (blocks, native html etc.)
     *
     * @return boolean
     */
    public function isCustomizedView()
    {
        return true;
    }

    /**
     * Prepare option value for cart
     *
     * @return null Prepared option value
     */
    public function prepareForCart()
    {
        return null;
    }
}
