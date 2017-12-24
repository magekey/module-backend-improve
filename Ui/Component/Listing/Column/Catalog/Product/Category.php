<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Ui\Component\Listing\Column\Catalog\Product;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Catalog\Ui\Component\Product\Form\Categories\Options as CategoriesOptions;

class Category extends \Magento\Ui\Component\Listing\Columns\Column
{
	/**
     * @var CategoriesOptions
     */
    protected $categoriesOptions;

	/**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CategoriesOptions $categoriesOptions
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
		CategoriesOptions $categoriesOptions,
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
}
