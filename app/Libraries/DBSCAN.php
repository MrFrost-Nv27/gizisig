<?php

declare(strict_types=1);

namespace App\Libraries;

use Illuminate\Database\Eloquent\Collection;
use Phpml\Clustering\Clusterer;
use Phpml\Math\Distance;
use Phpml\Math\Distance\Euclidean;

class DBSCAN
{
    private const NOISE = -1;

    public function __construct(
        private float $epsilon = 0.5,
        private int $minSamples = 3,
        private ?Distance $distanceMetric = new Euclidean()
    ) {
    }

    public function cluster(Collection $samples): array
    {
        $labels = [];
        $n = 0;

        foreach ($samples as $index => $sample) {
            if (isset($labels[$index])) {
                continue;
            }

            $neighborIndices = $this->getIndicesInRegion(array_values($sample->getIndexParameter()), $samples);

            if (count($neighborIndices) < $this->minSamples) {
                $labels[$index] = self::NOISE;

                continue;
            }

            $labels[$index] = $n;

            $this->expandCluster($samples, $neighborIndices, $labels, $n);

            ++$n;
        }

        return $this->groupByCluster($samples, $labels, $n);
    }

    private function expandCluster(Collection $samples, array $seeds, array &$labels, int $n): void
    {
        while (($index = array_pop($seeds)) !== null) {
            if (isset($labels[$index])) {
                if ($labels[$index] === self::NOISE) {
                    $labels[$index] = $n;
                }

                continue;
            }

            $labels[$index] = $n;

            $sample = $samples[$index];
            $neighborIndices = $this->getIndicesInRegion(array_values($sample->getIndexParameter()), $samples);

            if (count($neighborIndices) >= $this->minSamples) {
                $seeds = array_unique(array_merge($seeds, $neighborIndices));
            }
        }
    }

    private function getIndicesInRegion(array $center, Collection $samples): array
    {
        $indices = [];

        foreach ($samples as $index => $sample) {
            if ($this->distanceMetric->distance($center, array_values($sample->getIndexParameter())) < $this->epsilon) {
                $indices[] = $index;
            }
        }

        return $indices;
    }

    private function groupByCluster(Collection $samples, array $labels, int $n): array
    {
        $clusters = array_fill(0, $n, []);

        foreach ($samples as $index => $sample) {
            if ($labels[$index] !== self::NOISE) {
                $clusters[$labels[$index]][$index] = $index;
            }
        }

        // Reindex (i.e. to 0, 1, 2, ...) integer indices for backword compatibility
        foreach ($clusters as $index => $cluster) {
            $clusters[$index] = array_merge($cluster, []);
        }

        return $clusters;
    }
}