<?php

class Formatter
{
    // visualizacion de texto si sobrepasa maximo de caracteres
    public static function truncateWithTooltip($text, $maxLength = 70)
    {
        $safeText = htmlspecialchars($text);
        $truncated = strlen($text) > $maxLength
            ? htmlspecialchars(substr($text, 0, $maxLength - 3)) . '...'
            : $safeText;

        return "<span title=\"$safeText\">$truncated</span>";
    }
}
