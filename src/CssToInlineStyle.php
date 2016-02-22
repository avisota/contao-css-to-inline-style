<?php

/**
 * Avisota newsletter and mailing system
 *
 * Copyright (C) Avisota
 *
 * @package   contao-css-to-inline-style
 * @file      CssToInlineStyle.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Oliver Willmes <info@oliverwillmes.de>
 * @license   LGPL-3.0+
 * @copyright Copyright 2016 Avisota
 */

namespace Avisota\Contao\Message\Renderer;

use Avisota\Contao\Core\Message\PreRenderedMessageTemplateInterface;
use Avisota\Contao\Message\Core\Event\RenderMessageEvent;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

/**
 * Class CssToInlineStyle
 *
 * @package Avisota\Contao\Message\Renderer
 */
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
        if (!$event->getLayout()->getCssToInline()) {
            return;
        }

        $content                 = $event->getPreRenderedMessageTemplate()->getContent();
        $libxmlUseInternalErrors = libxml_use_internal_errors(true);
        $document                = new \DOMDocument('1.0', 'UTF-8');
        $document->formatOutput  = true;
        $document->loadHTML($content);
        $xpath  = new \DOMXPath($document);
        $styles = $xpath->query('/html/head/style');
        for ($i = 0; $i < $styles->length; $i++) {
            if ($i <> 0) {
                $style       = $styles->item($i);
                $inlineStyle = $style;
                $style->parentNode->removeChild($style);
            }
        }
        $content     = $document->saveHTML();
        $htmlInStyle = new CssToInlineStyles($content, $inlineStyle->textContent);
        $content     = $htmlInStyle->convert();

        $content = str_replace(
            array('%5B', '%5D', '%7B', '%7D', '%20'),
            array('[', ']', '{', '}', ' '),
            $content
        );
        $content = preg_replace_callback(
            '~\{%.*%\}~U',
            function ($matches) {
                return html_entity_decode($matches[0], ENT_QUOTES, 'UTF-8');
            },
            $content
        );
        $content = preg_replace_callback(
            '~##.*##~U',
            function ($matches) {
                return html_entity_decode($matches[0], ENT_QUOTES, 'UTF-8');
            },
            $content
        );
        $event->getPreRenderedMessageTemplate()->setContent($content);
        libxml_use_internal_errors($libxmlUseInternalErrors);
        return;
    }
}
