<?php

namespace quizzerino\Formula1DB;

use rbwebdesigns\quizzerino\SourceInterface;

/**
 * Sources questions from a database of F1 results.
 * 
 * @see https://www.kaggle.com/datasets/rohanrao/formula-1-world-championship-1950-2020
 */
class F1QuestionSource implements SourceInterface {

    /**
     * F1QuestionSource constructor.
     */
    public function __construct($settings) {}

    /**
     * {@inheritdoc}
     */
    public function getQuestion() : array {
        $pdo = new \PDO("sqlite:".__DIR__."/formula1.db");

        $winner = $pdo->query("SELECT resultId, races.raceId, CONCAT(races.year, ' ', races.name) AS race_name, driverId
            FROM results AS res
            JOIN races ON res.raceId = races.raceId
            WHERE `POSITION` = 1 ORDER BY RANDOM() LIMIT 1")->fetch(\PDO::FETCH_ASSOC);
        
        // Should always return 4 results
        $top4 = $pdo->query("SELECT CONCAT(d.forename, ' ', d.surname) as `name`, res.position FROM results AS res
            JOIN drivers AS d ON res.driverId = d.driverId
            WHERE raceId = {$winner['raceId']}
            AND res.position < 5
            ORDER BY RANDOM()")->fetchAll(\PDO::FETCH_ASSOC);

        return [
            'text' => "Who won the {$winner['race_name']}?",
            'options' => array_column($top4, 'name'),
            'correct_option_index' => array_search(1, array_column($top4, 'position')),
        ];
    }
}
