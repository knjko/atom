<?php

/*
 * This file is part of the Access to Memory (AtoM) software.
 *
 * Access to Memory (AtoM) is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Access to Memory (AtoM) is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Access to Memory (AtoM).  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Action Handler for Browse Hierarchy JSON Data
 *
 * @package AccesstoMemory
 * @subpackage model
 * @author Mike Cantelon <mike@artefactual.com>
 */
class BrowseHierarchyDataAction extends DefaultFullTreeViewAction
{
  public function execute($request)
  {
    $this->resource = QubitInformationObject::getById(QubitInformationObject::ROOT_ID);

    // Get show identifier setting to prepare the reference code if necessary
    $this->showIdentifier = sfConfig::get('app_treeview_show_identifier', 'no');
    $baseReferenceCode = '';

    // Given the current resource is the root information object, if doesn't
    // have an identifier so just send boolean true to indicate we want
    // indentifiers to be displayed
    if ($this->showIdentifier === 'referenceCode')
    {
      $baseReferenceCode = true;
    }

    // Impose limit to what nodeLimit parameter can be set to
    if (!ctype_digit($request->nodeLimit) || $request->nodeLimit > 100)
    {
      $request->nodeLimit = 100;
    }

    $data = $this->getNodeOrChildrenNodes($this->resource->id, $baseReferenceCode, $children = true, $request->skip, $request->nodeLimit);

    $this->getResponse()->setContentType('application/json');

    return $this->renderText(json_encode($data));
  }
}