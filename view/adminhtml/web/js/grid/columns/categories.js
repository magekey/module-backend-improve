/**
 * Copyright © MageKey. All rights reserved.
 */
define([
    'jquery',
    'ko',
    'Magento_Ui/js/grid/columns/column',
    'Magento_Catalog/js/components/new-category',
    'Magento_Ui/js/modal/alert'
], function ($, ko, Column, newCategory, alert) {
    'use strict';

    var uiCategory = newCategory.extend({
        initialize: function () {
            this._super();
            var self = this;

            self.originalValue = [];
            this.listVisible.subscribe(function (flag) {
                var value = self.value().sort();
                if (flag) {
                    self.originalValue = value.slice(0);
                } else {
                    if (self.originalValue.join(',') != value.join(',')) {
                        self.saveCategories();
                    }
                }
            });

            return this;
        },
        removeSelected: function (value, data, event) {
            this._super();
            this.saveCategories();
        },
        saveCategories: function () {
            var self = this;
            $.ajax({
                url: self.updateUrl,
                type: 'POST',
                showLoader: true,
                data: {product_id: self.rowId, category_ids: self.value()},
            }).done(function (response) {
                if (response.message) {
                    alert({content: response.message});
                }
            }).fail(function (jqXHR, textStatus) {
                alert({content: 'Could not proceed. Please try again later'});
            });
        }
    });

    return Column.extend({
        defaults: {
            bodyTmpl: 'MageKey_BackendImprove/ui/grid/cells/categories',
            sortable: false,
            elems: []
        },

        getElements: function (row) {
            var rowId = row.entity_id;
            if (!this.elems[rowId]) {
                 this.elems[rowId] = [
                    uiCategory({
                        componentType: 'field',
                        template: 'ui/grid/filters/elements/ui-select',
                        options: this.options,
                        dataScope: 'data.category_ids',
                        value: row.category_ids,
                        rowId: rowId,
                        updateUrl: this.update_url
                    })
                ];
            }
            return this.elems[rowId];
        },

        /**
         * Returns field action handler if it was specified.
         *
         * @param {Object} record - Record object with which action is associated.
         * @returns {Function|Undefined}
         */
        getFieldHandler: function (record) {
            return false;
        }
    });
});
