<?php
    Kirby::plugin('chrfickinger/kirby-statusbar', [

    'snippets' => [
        'statusbar' => __DIR__ . '/snippets/statusbar.php'
    ],
    'options' => [
        'active' => true,
        'environment' => 'dev',
        'color' => '#e8b860',
    ],
    'hooks' => [
        'page.render:after' => function ($contentType, $data, $html) {
            if ($contentType === 'html') {
                $html = str_replace('</body>', snippet('statusbar', [], true), $html) . '</body>';
            }
            return $html;
        },
    ],
]);
