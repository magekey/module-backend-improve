<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Model\Catalog\Product;

use MageKey\BackendImprove\Model\Catalog\Product\AdditionalOptions;

class OptionPlugin
{
    /**
     * @var AdditionalOptions
     */
    private $additionalOptions;

    /**
     * @param AdditionalOptions $additionalOptions
     */
    public function __construct(
        AdditionalOptions $additionalOptions
    ) {
        $this->additionalOptions = $additionalOptions;
    }

    /**
     * @param \Magento\Catalog\Model\Product\Option $subject
     * @param callable $proceed
     * @return string
     */
    public function aroundGetGroupByType(
        \Magento\Catalog\Model\Product\Option $subject,
        callable $proceed,
        $type = null
    ) {
        $return = $proceed($type);
        if (!$return) {
            $optionGroupsToTypes = $this->additionalOptions->getGroups();
            $return = isset($optionGroupsToTypes[$type]) ? $optionGroupsToTypes[$type] : '';
        }
        return $return;
    }

    /**
     * @param \Magento\Catalog\Model\Product\Option $subject
     * @return $this
     */
    public function afterBeforeSave(
        \Magento\Catalog\Model\Product\Option $subject,
        $result
    ) {
        $optionGroupsToTypes = $this->additionalOptions->getGroups();
        if (array_key_exists($subject->getType(), $optionGroupsToTypes)) {
            $subject->setIsRequire(false);
        }
        return $result;
    }
}
