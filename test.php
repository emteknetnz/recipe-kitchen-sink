<?php

if (file_exists('phpunit.xml') || file_exists('phpunit.xml.dist')) {
    $fn = file_exists('phpunit.xml') ? 'phpunit.xml' : 'phpunit.xml.dist';
    $d = new DOMDocument();
    $d->preserveWhiteSpace = false;
    $d->load($fn);
    $x = new DOMXPath($d);
    $tss = $x->query('//testsuite');
    foreach ($tss as $ts) {
        if (!$ts->hasAttribute('name') || $ts->getAttribute('name') == 'Default') {
            continue;
        }
        $matrix['include'][] = ['php' => '7.4', 'phpunit' => true, 'phpunit_suite' => $ts->getAttribute('name')];
    }
    if (count($matrix) == 0) {
        $matrix['include'][] = ['php' => '7.4', 'phpunit' => true, 'phpunit_suite' => ''];
    }
    print_r($matrix);

    # $matrix['include'][] = ['php' => '7.4', 'phpunit' => true];
}

