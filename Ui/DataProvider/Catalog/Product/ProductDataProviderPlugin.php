<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Ui\DataProvider\Catalog\Product;

class ProductDataProviderPlugin
{
    /**
     * @param \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider $subject
     * @return array
     */
    public function beforeGetData(
        \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider $subject
    ) {
        $subject->getCollection()->setFlag('load_category_ids', true);
        return [];
    }
}
