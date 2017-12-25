<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Controller\Adminhtml\Catalog\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\CategoryLinkManagementInterface;

use MageKey\BackendImprove\Helper\Data as DataHelper;

class Savecategory extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var CategoryLinkManagementInterface
     */
    protected $categoryLinkManagement;

    /**
     * @var DataHelper
     */
    protected $dataHelper;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param ProductInterfaceFactory $productFactory
     * @param CategoryLinkManagementInterface $categoryLinkManagement
     * @param DataHelper $dataHelper
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        ProductRepositoryInterface $productRepository,
        CategoryLinkManagementInterface $categoryLinkManagement,
        DataHelper $dataHelper
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->productRepository = $productRepository;
        $this->categoryLinkManagement = $categoryLinkManagement;
        $this->dataHelper = $dataHelper;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        if (!$this->dataHelper->canChangeCategoryOnProductGrid()) {
            return $resultJson->setData([
                'error' => 'true',
                'message' => __('Could not save category')
            ]);
        }
        $productId = (int)$this->getRequest()->getPost('product_id');
        $categoryIds = (array)$this->getRequest()->getPost('category_ids');

        try {
            $product = $this->productRepository->getById($productId);
            $this->categoryLinkManagement->assignProductToCategories(
                $product->getSku(),
                $categoryIds
            );
            $response = ['success' => 'true'];
        } catch (\Exception $e) {
            $response = ['error' => 'true', 'message' => $e->getMessage()];
        }
        return $resultJson->setData($response);
    }
}
