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
 * @copyright Copyright 2017 Avisota
 */

namespace Avisota\Contao\Message\Renderer;

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
     * @return void
     */
    public function renderMessage(RenderMessageEvent $event)
    {
        if (!$event->getLayout()->getCssToInline()) {
            return;
        }

        $content = $event->getPreRenderedMessageTemplate()->getContent();

        $cssInStyle = new CssToInlineStyles();

        $content = $cssInStyle->convert($content);
        $content = $this->decodeContent($content);

        $event->getPreRenderedMessageTemplate()->setContent($content);
    }

    /**
     * The content to decode.
     *
     * @param string $content The content.
     *
     * @return string
     */
    private function decodeContent($content)
    {
        $content = $this->decodeTwigShortcuts($content);
        $content = $this->decodeAllSimpleTokens($content);
        $content = $this->decodeUrl($content);

        return $content;
    }

    /**
     * Decode html entity in twig shortcuts.
     *
     * @param string $content The content.
     *
     * @return string
     */
    private function decodeTwigShortcuts($content = '')
    {
        $content = preg_replace_callback(
            '~\{%.*%\}~U',
            function ($matches) {
                return html_entity_decode($matches[0], ENT_QUOTES, 'UTF-8');
            },
            $content
        );

        return $content;
    }

    /**
     * Decode html entity in twig shortcuts.
     *
     * @param string $content The content.
     *
     * @return string
     */
    private function decodeAllSimpleTokens($content = '')
    {
        $content = preg_replace_callback(
            '~##.*##~U',
            function ($matches) {
                return html_entity_decode($matches[0], ENT_QUOTES, 'UTF-8');
            },
            $content
        );

        return $content;
    }

    /**
     * Decode url characters.
     *
     * @param string $content The content.
     *
     * @return string
     */
    private function decodeUrl($content = '')
    {
        return urldecode($content);
    }
}
