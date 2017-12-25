<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Ui\DataProvider\Catalog\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions;

class TypographyCustomOptions extends AbstractModifier
{
    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {
        $this->meta = $meta;

        $this->createTypographyCustomOptions();

        return $this->meta;
    }

    /**
     * Create typography panel
     *
     * @return $this
     */
    protected function createTypographyCustomOptions()
    {
        $this->meta = array_replace_recursive(
            $this->meta,
            [
                CustomOptions::GROUP_CUSTOM_OPTIONS_NAME => [
                    'children' => [
                        CustomOptions::GRID_OPTIONS_NAME => $this->getOptionsGridConfig()
                    ]
                ]
            ]
        );

        return $this;
    }

    /**
     * Get config for the whole grid
     *
     * @return array
     */
    protected function getOptionsGridConfig()
    {
        return [
            'children' => [
                'record' => [
                    'children' => [
                        CustomOptions::CONTAINER_OPTION => [
                            'children' => [
                                CustomOptions::CONTAINER_COMMON_NAME => $this->getCommonContainerConfig()
                            ]
                        ],
                    ]
                ]
            ]
        ];
    }

    /**
     * Get config for container with common fields for any type
     *
     * @return array
     */
    protected function getCommonContainerConfig()
    {
        return [
            'children' => [
                CustomOptions::FIELD_TYPE_NAME => $this->getTypeFieldConfig(40)
            ]
        ];
    }

    /**
     * Get config for "Option Type" field
     *
     * @param int $sortOrder
     * @return array
     */
    protected function getTypeFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'groupsConfig' => [
                            'typography' => [
                                'values' => ['label'],
                                'indexes' => []
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }
}
