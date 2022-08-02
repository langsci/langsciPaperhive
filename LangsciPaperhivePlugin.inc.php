<?php

/**
 * @file plugins/generic/langsciPaperhive/langsciPaperhivePlugin.inc.php
 *
 * Copyright (c) 2022 Language Science Press
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class LangsciPaperhivePlugin
 */

import('lib.pkp.classes.plugins.GenericPlugin');

class LangsciPaperhivePlugin extends GenericPlugin
{
    /**
     * Register the plugin.
     * @param $category string
     * @param $path string
     * @param $mainContextId strinf
     */
    /**
     * @copydoc Plugin::register()
     */
    public function register($category, $path, $mainContextId = null)
    {
        if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) return true;
        if (parent::register($category, $path, $mainContextId)) {
            if ($this->getEnabled($mainContextId)) {
                HookRegistry::register('Templates::Catalog::Book::Details::Paperhive', array($this, 'addPaperhiveWidget'));
            }
            return true;
        }
        return false;
    }

    /**
	 * Add Paperhive to the book page
	 * @param $hookName string
	 * @param $args array
	 */
	function addPaperhiveWidget($hookName, $args){
		$output =& $args[2];
		$request = $this->getRequest();
		$templateMgr = TemplateManager::getManager($request);
		$output .=  $templateMgr->fetch($this->getTemplateResource('paperHiveWidget.tpl'));
		   
		return false;		
	}	

	/**
	 * @copydoc PKPPlugin::getDisplayName()
	 */
	function getDisplayName() {
		return __('plugins.generic.langsciPaperhive.displayName');
	}

	/**
	 * @copydoc PKPPlugin::getDescription()
	 */
	function getDescription() {
		return __('plugins.generic.langsciPaperhive.description');
	}	
}
?>
