<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Observer\Catalog;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ProductCollectionLoadAfter implements ObserverInterface
{
    /**
     * @return void
     */
    public function execute(Observer $observer)
    {
        $collection = $observer->getCollection();
        if ($collection->getFlag('load_category_ids')) {
            $collection->addCategoryIds();
            $collection->setFlag('load_category_ids', false);
        }
    }
}
