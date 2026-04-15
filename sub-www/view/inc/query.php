<?php
// global query
$template=getData("web_template", "status_template=true");
$template_data = json_decode($template['konten_template'], true);
$templateHeaderFooter = [];
$templateOther = [];

foreach ($template_data as $item) {
    if ($item['widget'] === 'header' || $item['widget'] === 'footer') {
        $templateHeaderFooter[] = $item;
    } else {
        $templateOther[] = $item;
    }
}

$templateHeaderData = current(array_filter($templateHeaderFooter, fn($item) => $item['widget'] === 'header'))['data'] ?? [];
$templateFooterData = current(array_filter($templateHeaderFooter, fn($item) => $item['widget'] === 'footer'))['data'] ?? [];