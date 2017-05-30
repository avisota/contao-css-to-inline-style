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

return array(
    Avisota\Contao\Message\Core\Event\AvisotaMessageEvents::RENDER_MESSAGE => array(
        array(new Avisota\Contao\Message\Renderer\CssToInlineStyle(), 'renderMessage', 9999)
    ),
);
