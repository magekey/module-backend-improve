<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Ui\Component\Listing\Column\Catalog\Product;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Catalog\Ui\Component\Product\Form\Categories\Options as CategoriesOptions;

use MageKey\BackendImprove\Helper\Data as DataHelper;

class Category extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var CategoriesOptions
     */
    protected $categoriesOptions;

    /**
     * @var DataHelper
     */
    protected $dataHelper;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CategoriesOptions $categoriesOptions
     * @param DataHelper $dataHelper
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CategoriesOptions $categoriesOptions,
        DataHelper $dataHelper,
        array $components = [],
        array $data = []
    ) {
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
        $this->categoriesOptions = $categoriesOptions;
        $this->dataHelper = $dataHelper;
    }

    /**
     * Prepare component configuration
     *
     * @return void
     */
    public function prepare()
    {
        parent::prepare();
        if (!$this->dataHelper->canChangeCategoryOnProductGrid()) {
            $config['componentDisabled'] = true;
            $this->setData('config', $config);
            return;
        }

        $this->setData(
            'config',
            array_replace_recursive(
                [
                    'options' => $this->categoriesOptions->toOptionArray(),
                ],
                (array)$this->getData('config')
            )
        );
    }
}
