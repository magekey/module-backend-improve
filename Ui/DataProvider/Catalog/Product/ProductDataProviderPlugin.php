<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Ui\DataProvider\Catalog\Product;

use MageKey\BackendImprove\Helper\Data as DataHelper;

class ProductDataProviderPlugin
{
    /**
     * @var DataHelper
     */
    protected $dataHelper;

    /**
     * @param DataHelper $dataHelper
     */
    public function __construct(
        DataHelper $dataHelper
    ) {
        $this->dataHelper = $dataHelper;
    }

    /**
     * @param \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider $subject
     * @return array
     */
    public function beforeGetData(
        \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider $subject
    ) {
        if ($this->dataHelper->canChangeCategoryOnProductGrid()) {
            $subject->getCollection()->setFlag('load_category_ids', true);
        }
        return [];
    }
}
