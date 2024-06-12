# Formula 1 question source for Quizzerino
Provides dynamically generated questions about Formula 1.

The repo includes a SQLite file with data from https://www.kaggle.com/datasets/rohanrao/formula-1-world-championship-1950-2020.

(Last Update Aug 2023)

## What is Quizzerino?
Quiz software that allows someone to host a quiz game that can be played with others accross the internet from a web browser.

See: http://quizzerino.rbwebdesigns.co.uk/

To host a server, see: https://github.com/rbertram90/quizzerino-server

To host the client see: https://github.com/rbertram90/quizzerino-client

## Installation
Setup Quizzerino server, see link above.

Add the following to `repositories` in composer.json file:
```
{
    "type": "vcs",
    "url": "https://github.com/rbertram90/quizzerino-f1-questions-source.git"
}
```

Run `composer require rbwebdesigns/quizzerino-formula1-db-source`.
