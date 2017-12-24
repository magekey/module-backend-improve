<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Ui\Plugin\Catalog;

class ProductDataProvider
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
