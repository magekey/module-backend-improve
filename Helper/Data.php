<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Helper;

use Magento\Store\Model\ScopeInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * General
     */
    const XML_PATH_STATUS_PRODUCT_GRID_CHANGE_CATEGORY = 'mgk_backendimprove/product/gridchangecategory';

    /**
     * Check if status active
     *
     * @param mixed $scopeCode
     * @return bool
     */
    public function canChangeCategoryOnProductGrid($scopeCode = null)
    {
        return $this->scopeConfig->isSetFlag(
            static::XML_PATH_STATUS_PRODUCT_GRID_CHANGE_CATEGORY,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }
}
