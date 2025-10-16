<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;

class HtmlSanitizer
{
    /**
     * Sanitize untrusted HTML content by removing dangerous tags/attributes and normalizing URLs.
     */
    public static function sanitize(?string $html): string
    {
        if ($html === null || $html === '') {
            return '';
        }

        $allowedTags = [
            'a','p','b','strong','i','em','u','ul','ol','li','br','hr',
            'h1','h2','h3','h4','h5','h6','blockquote','code','pre',
            'img','span','div','table','thead','tbody','tr','td','th'
        ];

        $doc = new DOMDocument();
        // Suppress warnings for malformed HTML; ensure UTF-8 handling
        $internalErrors = libxml_use_internal_errors(true);
        $doc->loadHTML('<!DOCTYPE html><html><meta charset="UTF-8"><body><div id="__wrapper__">' . $html . '</div></body></html>');
        libxml_clear_errors();
        libxml_use_internal_errors($internalErrors);

        $wrapper = $doc->getElementById('__wrapper__');
        if (!$wrapper) {
            return '';
        }

        self::sanitizeNode($wrapper, $allowedTags);

        // Extract inner HTML of wrapper
        $output = '';
        foreach (iterator_to_array($wrapper->childNodes) as $child) {
            $output .= $doc->saveHTML($child);
        }
        return $output ?? '';
    }

    private static function sanitizeNode(DOMNode $node, array $allowedTags): void
    {
        if ($node instanceof DOMElement) {
            $tag = strtolower($node->tagName);

            // Remove disallowed elements entirely
            if (!in_array($tag, $allowedTags, true)) {
                $node->parentNode?->removeChild($node);
                return;
            }

            // Strip event handlers and dangerous attributes
            if ($node->hasAttributes()) {
                $attrsToRemove = [];
                foreach (iterator_to_array($node->attributes) as $attr) {
                    $name = strtolower($attr->name);
                    $value = trim($attr->value);

                    // Remove any on* handlers (onclick, onerror, ...)
                    if (str_starts_with($name, 'on')) {
                        $attrsToRemove[] = $name;
                        continue;
                    }

                    // Disallow style to avoid CSS-based attacks
                    if ($name === 'style') {
                        $attrsToRemove[] = $name;
                        continue;
                    }

                    // Sanitize URLs in href/src
                    if (in_array($name, ['href','src'], true)) {
                        // Allow only http, https, mailto, tel for href; only http/https for img src
                        $lower = strtolower($value);
                        $isAllowed = false;
                        if ($name === 'href') {
                            $isAllowed = self::urlAllowed($lower, ['http:','https:','mailto:','tel:','/','#']);
                        } else {
                            $isAllowed = self::urlAllowed($lower, ['http:','https:','/']);
                        }
                        if (!$isAllowed) {
                            $attrsToRemove[] = $name;
                            continue;
                        }
                    }

                    // For anchor tags, ensure rel safety
                    if ($tag === 'a' && $name === 'rel') {
                        // will normalize below
                    }
                }

                foreach ($attrsToRemove as $n) {
                    $node->removeAttribute($n);
                }

                // Normalize anchors security attributes
                if ($tag === 'a') {
                    $existingRel = strtolower($node->getAttribute('rel'));
                    $rels = array_filter(array_unique(array_merge(
                        preg_split('/\s+/', $existingRel) ?: [],
                        ['nofollow','noreferrer','noopener']
                    )));
                    $node->setAttribute('rel', implode(' ', $rels));
                    if ($node->hasAttribute('target')) {
                        $node->setAttribute('target', '_blank');
                    }
                }

                // For images, allow only safe subset of attributes
                if ($tag === 'img') {
                    $allowedImgAttrs = ['src','alt','title'];
                    foreach (iterator_to_array($node->attributes) as $attr) {
                        if (!in_array(strtolower($attr->name), $allowedImgAttrs, true)) {
                            $node->removeAttribute($attr->name);
                        }
                    }
                }
            }
        }

        // Recurse for children; clone list to avoid live mutation issues
        foreach (iterator_to_array($node->childNodes) as $child) {
            self::sanitizeNode($child, $allowedTags);
        }
    }

    private static function urlAllowed(string $value, array $allowedStarts): bool
    {
        foreach ($allowedStarts as $prefix) {
            if ($prefix === '#' && str_starts_with($value, '#')) return true;
            if ($prefix === '/' && str_starts_with($value, '/')) return true;
            if (str_starts_with($value, $prefix)) return true;
        }
        // Block javascript:, data:, vbscript: etc.
        if (preg_match('/^(javascript|data|vbscript):/i', $value)) {
            return false;
        }
        return false;
    }
}


