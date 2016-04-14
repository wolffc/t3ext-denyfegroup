<?php

namespace B13\DenyFeGroup;

use TYPO3\CMS\Backend\View\PageLayoutViewDrawFooterHookInterface;

class PageLayoutViewDrawFooter implements PageLayoutViewDrawFooterHookInterface
{

    /**
     * Preprocesses the preview footer rendering of a content element.
     *
     * @param \TYPO3\CMS\Backend\View\PageLayoutView $parentObject Calling parent object
     * @param string $info Processed values
     * @param array $row Record row of tt_content
     * @return void
     */
    public function preProcess(\TYPO3\CMS\Backend\View\PageLayoutView &$parentObject, &$info, array &$row)
    {
        $parentObject->getProcessedValue('tt_content', 'fe_group_deny', $row, $info);
            // Remove empty array values
        $info = array_filter($info);
    }

}
