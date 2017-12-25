<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\BackendImprove\Model\Catalog\Product;

class AdditionalOptions
{
    /**
     * Product typography options group.
     */
    const OPTION_GROUP_TYPOGRAPHY = 'typography';

    /**
     * Product label option type.
     */
    const OPTION_TYPE_LABEL = 'label';

    /**
     * @return array
     */
    public function getGroups()
    {
        return [
            self::OPTION_TYPE_LABEL => self::OPTION_GROUP_TYPOGRAPHY
        ];
    }
}
