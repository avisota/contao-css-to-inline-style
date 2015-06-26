<?php

/**
 * Avisota newsletter and mailing system
 *
 * Copyright (C) Avisota
 *
 * @package   contao-css-to-inline-style
 * @file      CssToInlineStyle.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @license   LGPL-3.0+
 * @copyright Copyright 2015 Avisota
 */


namespace Avisota\Message\Renderer;

use Avisota\Contao\Core\Message\PreRenderedMessageTemplateInterface;
use Avisota\Contao\Message\Core\Event\RenderMessageEvent;

class CssToInlineStyle
{

    /**
     * Render add the css rules as inline styles.
     *
     * @param RenderMessageEvent $event
     *
     * @return PreRenderedMessageTemplateInterface
     */
    public function renderMessage(RenderMessageEvent $event)
    {
        if ($GLOBALS['AVISOTA']['ENABLE_CSS_TO_INLINE_STYLE']) {
            //TODO add the methoic to set the css rules as inline styles
            $newEvent = $event->getPreRenderedMessageTemplate();
            $content = $newEvent->getContaoMessage();
            $event->setPreRenderedMessageTemplate($newEvent);
            return;
        }
    }
}