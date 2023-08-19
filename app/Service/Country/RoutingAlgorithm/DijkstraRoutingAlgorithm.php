<?php

declare(strict_types=1);

namespace App\Service\Country\RoutingAlgorithm;

class DijkstraRoutingAlgorithm implements RoutingAlgorithm
{
    /**
     * {@inheritdoc}
     */
    public function calculateRoute(array $graph, string $start, string $end, array $startLatLng, array $endLatLng): array
    {
        $countries = array_keys($graph);
        $geographicData = array_fill_keys($countries, ['latitude' => 0, 'longitude' => 0]);
        $distances = array_fill_keys($countries, INF);
        $previous = array_fill_keys($countries, null);
        $unvisited = array_fill_keys($countries, true);

        $distances[$start] = 0;
        $geographicData[$end] = $startLatLng;
        $geographicData[$start] = $endLatLng;

        while ($unvisited !== []) {
            $minDistance = INF;
            $current = null;

            foreach ($unvisited as $index => $unused) {
                if ($distances[$index] < $minDistance) {
                    $minDistance = $distances[$index];
                    $current = $index;
                }
            }

            if ($current === $end || $current === null) {
                break;
            }

            unset($unvisited[$current]);

            if (! isset($graph[$current])) {
                continue;
            }

            foreach ($graph[$current] as $neighbor => $data) {
                $latitudePenalty = abs($geographicData[$neighbor]['latitude'] - $geographicData[$current]['latitude']);
                $longitudePenalty = abs($geographicData[$neighbor]['longitude'] - $geographicData[$current]['longitude']);
                $penalty = $latitudePenalty + $longitudePenalty;

                $alt = $distances[$current] + $penalty;

                if ($alt < $distances[$neighbor]) {
                    $distances[$neighbor] = $alt;
                    $previous[$neighbor] = $current;
                    $geographicData[$neighbor]['latitude'] = $data['latitude'];
                    $geographicData[$neighbor]['longitude'] = $data['longitude'];
                }
            }
        }

        if ($previous[$end] === null) {
            return [];
        }

        $path = [];
        $current = $end;
        while ($current !== null) {
            array_unshift($path, $current);
            $current = $previous[$current];
        }

        return $path;
    }
}
