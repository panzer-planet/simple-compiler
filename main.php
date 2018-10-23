<?php
require __DIR__ . '/vendor/autoload.php';

use PanzerPlanet\Language\Lexer;
use PanzerPlanet\Language\Parser;
use PanzerPlanet\Language\Evaluator;
use PanzerPlanet\Language\JavaScriptTranspiler;

$lexer = new Lexer;
$parser = new Parser;
$evaluator = new Evaluator;
$transpiler = new JavaScriptTranspiler;

$program = <<<PROGRAM
sum 5 5 5 5 sub 10 9
PROGRAM;

echo $evaluator->eval($parser->parse($lexer->lex($program)));

