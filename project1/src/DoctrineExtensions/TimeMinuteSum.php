<?php
namespace App\DoctrineExtensions;

use Doctrine\ORM\Query\AST\Functions\FunctionNode,
    Doctrine\ORM\Query\Lexer;

/**
 * TimeMinuteSum ::= "TIME_MINUTE_SUM" "(" ArithmeticPrimary ")"
 */
class TimeMinuteSum extends FunctionNode
{
    public $firstDateExpression = null;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER); // (2)
        $parser->match(Lexer::T_OPEN_PARENTHESIS); // (3)
        $this->firstDateExpression = $parser->ArithmeticPrimary(); // (4)
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); // (3)
    }
//round((sum(foo.duration) / 60::double precision)::numeric,
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker){
        return 'round(((sum('.
            $this->firstDateExpression->dispatch($sqlWalker) .
            ') / 60)::double precision)::numeric, 0)';
    }
}