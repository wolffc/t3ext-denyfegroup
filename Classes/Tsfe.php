<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 b:dreizehn GmbH <typo3@b13.de>
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

/**
 * Main function that hooks into TYPO3
 *
 * @author	b:dreizehn GmbH <typo3@b13.de>
 * @package
 */
class ux_tslib_fe extends tslib_fe {

	/**
	 * Check group access against a page record
	 * but also check against "deny checking"
	 *
	 * @param	array		The page record to evaluate (needs field: fe_group)
	 * @param	mixed		List of group id's (comma list or array). Default is $this->gr_list
	 * @return	boolean		True, if group access is granted.
	 * @access private
	 */
	function checkPageGroupAccess($row, $groupList=NULL) {
		if(is_null($groupList)) {
			$groupList = $this->gr_list;
		}
		if(!is_array($groupList)) {
			$groupList = explode(',', $groupList);
		}

			// If the actual page has no fe_group (and no check against), check the rootline for
			// inherited fe_group due to extendToSubpage-property
		if (isset($row['uid']) && intval($row['fe_group']) === 0 && intval($row['fe_group_deny'] === 0)) {
			$rootLine = $this->sys_page->getRootLine($row['uid']);
			foreach ($rootLine as $pageConf) {
				if (($pageConf['fe_group_deny'] != '' || $pageConf['fe_group'] != '') && $pageConf['extendToSubpages'] == 1) {
					$row['fe_group'] = $pageConf['fe_group'];
					$row['fe_group_deny'] = $pageConf['fe_group_deny'];
					break;
				}
			}
		}

		$pageGroupList = explode(',', $row['fe_group'] ? $row['fe_group'] : 0);

		$pageAccessExplicitlyDenied = FALSE;
		if ($row['fe_group_deny']) {
			$pageGroupDenyList = explode(',', $row['fe_group_deny']);
			if (count(array_intersect($groupList, $pageGroupDenyList)) > 0) {
				$pageAccessExplicitlyDenied = TRUE;
			}
		}

		return count(array_intersect($groupList, $pageGroupList)) > 0 && !$pageAccessExplicitlyDenied;
	}

}