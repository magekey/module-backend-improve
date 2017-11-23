<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Ui\Component\Listing\Column\Catalog\Product;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Catalog\Ui\Component\Product\Form\Categories\Options as CategoriesOptions;
use Magento\Catalog\Model\ProductFactory;

class Category extends \Magento\Ui\Component\Listing\Columns\Column
{
	/**
     * @var CategoriesOptions
     */
    protected $categoriesOptions;

	/**
     * @var ProductFactory
     */
	protected $productFactory;

	/**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CategoriesOptions $categoriesOptions
     * @param ProductFactory $productFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
		CategoriesOptions $categoriesOptions,
		ProductFactory $productFactory,
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
        $this->productFactory = $productFactory;
    }

	/**
     * Prepare component configuration
     *
     * @return void
     */
    public function prepare()
    {
        parent::prepare();
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

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
		$fieldName = $this->getData('name');
        if (isset($dataSource['data']['items'])) {
			foreach ($dataSource['data']['items'] as & $item) {
				$product = $this->productFactory
					->create()
					->load($item['entity_id']);
        		$item[$fieldName] = $product->getCategoryIds();
			}
		}
        return $dataSource;
    }
}
