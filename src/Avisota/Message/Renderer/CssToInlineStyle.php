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
            $content = $event->getPreRenderedMessageTemplate()->getContent();
            $arrXchange = array(
                '<h1>' => '<h1 style="margin-top:.4em;margin-bottom:.4em;text-align:left;font:17px Arial,Verdana,sans-serif;font-weight:bold;text-transform:uppercase">',
                'class="mce_text">' => 'class="mce_text" style="border-bottom:9px solid #000;padding-bottom:11px;">',
            );
            foreach ($arrXchange as $find => $replace) {
                $content = str_replace($find, $replace, $content);
            }

            $event->getPreRenderedMessageTemplate()->setContent($content);
            return;
        }
    }
}