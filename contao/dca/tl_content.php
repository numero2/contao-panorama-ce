<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2020 Leo Feyer
 *
 * @package   Panorama Content Element
 * @author    Benny Born <benny.born@numero2.de>
 * @license   LGPL
 * @copyright 2020 numero2 - Agentur für digitales Marketing
 */

use Contao\Config;

/**
 * Add palettes to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['panorama'] = '{type_legend},type,headline;{panorama_legend},multiSRCPanorama,panorama_autorotate,panorama_compass;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';


/**
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['multiSRCPanorama'] = $GLOBALS['TL_DCA']['tl_content']['fields']['multiSRC'];
$GLOBALS['TL_DCA']['tl_content']['fields']['multiSRCPanorama']['eval']['isGallery'] = true;
$GLOBALS['TL_DCA']['tl_content']['fields']['multiSRCPanorama']['eval']['extensions'] = Config::get('validImageTypes');

$GLOBALS['TL_DCA']['tl_content']['fields']['panorama_autorotate'] = [
    'exclude'       => true,
    'inputType'     => 'checkbox',
    'eval'          => array('tl_class'=>'w50'),
    'sql'           => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['panorama_compass'] = [
    'label'         => &$GLOBALS['TL_LANG']['tl_content']['panorama_compass'],
    'exclude'       => true,
    'inputType'     => 'checkbox',
    'eval'          => array('tl_class'=>'w50'),
    'sql'           => "char(1) NOT NULL default ''"
];