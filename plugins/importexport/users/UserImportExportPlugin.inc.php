<?php

/**
 * @file plugins/importexport/users/UserImportExportPlugin.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class UserImportExportPlugin
 * @ingroup plugins_importexport_user
 *
 * @brief User XML import/export plugin
 */

import('lib.pkp.plugins.importexport.users.PKPUserImportExportPlugin');

class UserImportExportPlugin extends PKPUserImportExportPlugin
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @copydoc Plugin::register()
     *
     * @param null|mixed $mainContextId
     */
    public function register($category, $path, $mainContextId = null)
    {
        return parent::register($category, $path, $mainContextId);
    }

    /**
     * @copydoc ImportExportPlugin::executeCLI
     */
    public function executeCLI($scriptName, &$args)
    {
        throw new BadMethodCallException();
    }

    /**
     * @copydoc ImportExportPlugin::usage
     */
    public function usage($scriptName)
    {
        throw new BadMethodCallException();
    }
    /**
     * Define the appropriate import filter given the imported XML file path
     *
     * @param string $xmlFile
     *
     * @return array Containing the filter and the xmlString of the imported file
     */
    public function getImportFilter($xmlFile)
    {
        throw new BadMethodCallException();
    }

    /**
     * Define the appropriate export filter given the export operation
     *
     * @param string $exportType
     *
     * @return string
     */
    public function getExportFilter($exportType)
    {
        throw new BadMethodCallException();
    }

    /**
     * Get the application specific deployment object
     *
     * @param Context $context
     * @param User $user
     *
     * @return PKPImportExportDeployment
     */
    public function getAppSpecificDeployment($context, $user)
    {
        throw new BadMethodCallException();
    }
}
