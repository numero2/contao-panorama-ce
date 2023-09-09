<?php

declare(strict_types=1);

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

namespace numero2\PanoramaCE\ContentElement;

use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\Config;
use Contao\ContentModel;
use Contao\FilesModel;
use Contao\StringUtil;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement('panorama', category: 'media', template:'ce_panorama')]
class ContentPanorama extends AbstractContentElementController {

    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        $model->multiSRCPanorama = StringUtil::deserialize($model->multiSRCPanorama);

        if( !is_array($model->multiSRCPanorama) || empty($model->multiSRCPanorama) ) {
            return '';
        }

        // get the file entries from the database
        $objFiles = FilesModel::findMultipleByUuids($model->multiSRCPanorama);

        if( null === $objFiles ) {
            return '';
        }

        $arrImages = array();

        while( $objFiles->next() ) {

            $arrImages[] = array(
                'path' => $objFiles->path
            );
        }

        $template->images = $arrImages;
        $template->autoRotate = $model->panorama_autorotate;
        $template->showCompass = $model->panorama_compass;

        // add javascripts and stylesheet to head
        if( !is_array($GLOBALS['TL_JAVASCRIPT']) || array_search('/bundles/numero2panoramace/pannellum.js',$GLOBALS['TL_JAVASCRIPT']) === FALSE ) {
            $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/numero2panoramace/pannellum.js';
        }

        if( !Config::get('panoramaDisableCSS') ) {

            if( !$GLOBALS['TL_CSS'] || array_search('/bundles/numero2panoramace/pannellum.css',$GLOBALS['TL_CSS']) === FALSE ) {
                $GLOBALS['TL_CSS'][] = '/bundles/numero2panoramace/pannellum.css';
            }

            if( !$GLOBALS['TL_CSS'] || array_search('/bundles/numero2panoramace/style.css',$GLOBALS['TL_CSS']) === FALSE ) {
                $GLOBALS['TL_CSS'][] = '/bundles/numero2panoramace/style.css';
            }
        }

        return $template->getResponse();
    }
}
