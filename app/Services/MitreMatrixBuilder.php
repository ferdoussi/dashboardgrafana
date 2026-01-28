<?php

namespace App\Services;

class MitreMatrixBuilder
{
public static function build(array $offenses)
{
    // تحميل الهيكل الكامل (14 عمود)
    $matrix = MitreData::getFullStructure(); 

    foreach ($offenses as $offense) {
        $mapped = MitreMapper::map($offense);
        if (!$mapped) continue;

        $tactic = $mapped['tactic'];
        $techId = $mapped['technique_id'];

        if (isset($matrix[$tactic][$techId])) {
            $matrix[$tactic][$techId]['count']++;
            $matrix[$tactic][$techId]['severity'] = max($matrix[$tactic][$techId]['severity'], $offense['severity']);
            $matrix[$tactic][$techId]['offenses'][] = $offense;
        }
    }
    return $matrix;
}
}