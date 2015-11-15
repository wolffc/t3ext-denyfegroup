<?php

namespace B13\DenyFeGroup;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011-2013 b:dreizehn GmbH <typo3@b13.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Frontend\Page\PageRepository;
use TYPO3\CMS\Frontend\Page\PageRepositoryGetPageHookInterface;

/**
 * Main function that hooks into TYPO3
 *
 * @author    b:dreizehn GmbH <typo3@b13.de>
 * @package
 */
class PageRepositoryGetPage extends AbstractGroupAccess implements PageRepositoryGetPageHookInterface
{

    /**
     * Modifies the DB params
     *
     * @param int $uid The page ID
     * @param bool $disableGroupAccessCheck If set, the check for group access is disabled. VERY rarely used
     * @param \TYPO3\CMS\Frontend\Page\PageRepository $parentObject Parent object
     * @return void
     */
    public function getPage_preProcess(&$uid, &$disableGroupAccessCheck, PageRepository $parentObject)
    {
        $usergroups = $this->getUsergroups();
        if (count($usergroups)) {
            $parentObject->where_groupAccess .= $this->getMultipleGroupsWhereClause($this->fieldName, 'pages');
        }
    }

}


?>