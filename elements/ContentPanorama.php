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

namespace numero2\PanoramaCE;


class ContentPanorama extends \ContentElement {


    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_panorama';


    /**
     * Generate the content element
     */
    protected function compile() {

        $this->multiSRCPanorama = deserialize($this->multiSRCPanorama);

        if( !is_array($this->multiSRCPanorama) || empty($this->multiSRCPanorama) ) {
            return '';
        }

        // get the file entries from the database
        $objFiles = NULL;
        $objFiles = \FilesModel::findMultipleByUuids($this->multiSRCPanorama);

        if( $objFiles === null ) {
            return '';
        }

        $arrImages = array();

        while( $objFiles->next() ) {

            $arrImages[] = array(
                'path' => $objFiles->path
            );
        }

        $this->Template->images = $arrImages;
        $this->Template->autoRotate = $this->panorama_autorotate;
        $this->Template->showCompass = $this->panorama_compass;

        // add javascripts and stylesheet to head
        if( !is_array($GLOBALS['TL_JAVASCRIPT']) || array_search('system/modules/ce_panorama/assets/libpannellum.js',$GLOBALS['TL_JAVASCRIPT']) === FALSE ) {
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/ce_panorama/assets/libpannellum.js';
        }

        if( !is_array($GLOBALS['TL_JAVASCRIPT']) || array_search('system/modules/ce_panorama/assets/pannellum.js',$GLOBALS['TL_JAVASCRIPT']) === FALSE ) {
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/ce_panorama/assets/pannellum.js';
        }

        if( !\Config::get('panoramaDisableCSS') ) {

            if( !$GLOBALS['TL_CSS'] || array_search('system/modules/ce_panorama/assets/pannellum.css',$GLOBALS['TL_CSS']) === FALSE ) {
                $GLOBALS['TL_CSS'][] = 'system/modules/ce_panorama/assets/pannellum.css';
            }

            if( !$GLOBALS['TL_CSS'] || array_search('system/modules/ce_panorama/assets/style.css',$GLOBALS['TL_CSS']) === FALSE ) {
                $GLOBALS['TL_CSS'][] = 'system/modules/ce_panorama/assets/style.css';
            }
        }
    }
}