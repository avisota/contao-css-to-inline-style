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
 * @copyright Copyright 2016 Avisota
 */

\Bit3\Contao\MetaPalettes\MetaPalettes::appendFields(
    'orm_avisota_layout',
    'mailChimp',
    'template',
    array('cssToInline')
);

$fields = array(
    'cssToInline' => array
    (
        'label'     => &$GLOBALS['TL_LANG']['orm_avisota_layout']['cssToInline'],
        'exclude'   => true,
        'inputType' => 'checkbox',
    ),
);

$GLOBALS['TL_DCA']['orm_avisota_layout']['fields'] = array_merge($GLOBALS['TL_DCA']['orm_avisota_layout']['fields'], $fields);

unset($fields);
