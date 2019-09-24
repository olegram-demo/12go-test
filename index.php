<?php

declare(strict_types=1);

if (version_compare(PHP_VERSION, '7.1') === -1) {
    echo "Required PHP >= 7.1.0\nCurrent version " . PHP_VERSION . "\nAborted!";
    exit(1);
}

require_once __DIR__ . '/TrackFactory.php';
require_once __DIR__ . '/TracksCollection.php';

$lines = file('php://stdin', FILE_IGNORE_NEW_LINES);

for ($i = 0, $l = count($lines); $i < $l; $i++) {
    $n = $lines[$i];
    if (! $n) {
        continue;
    }
    $tracksCollection = new TracksCollection();
    for ($j = 0; $j < $n; $j++) {
        $track = TrackFactory::createFromRawData($lines[$i + $j + 1]);
        $tracksCollection->addTrack($track);
    }
    echo implode(' ', array_merge(
        $tracksCollection->calculateAverageCoordinates(),
        [$tracksCollection->calculateWorstDistance()]
    )) . "\n";
    $i += $j;
}
