<?php

/**
 * Avisota newsletter and mailing system
 *
 * Copyright (C) Avisota
 *
 * @package   contao-css-to-inline-style
 * @file      config.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @license   LGPL-3.0+
 * @copyright Copyright 2015 Avisota
 */


//TODO enable this in avisota
$GLOBALS['AVISOTA']['ENABLE_CSS_TO_INLINE_STYLE'] = true;


$GLOBALS['TL_EVENTS'][\Avisota\Contao\Message\Core\Event\AvisotaMessageEvents::RENDER_MESSAGE][] = array(
    'Avisota\Message\Render\CssToInlineStyle',
    'generate'
);
