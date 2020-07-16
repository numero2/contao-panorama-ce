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


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'numero2\PanoramaCE',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Elements
    'numero2\PanoramaCE\ContentPanorama'    => 'system/modules/ce_panorama/elements/ContentPanorama.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'ce_panorama'   => 'system/modules/ce_panorama/templates/elements',
));