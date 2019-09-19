<?php
namespace App\DoctrineExtensions;

use Doctrine\ORM\Query\AST\Functions\FunctionNode,
    Doctrine\ORM\Query\Lexer;

/**
 * ArrayAgg ::= "ARRAY_AGG" "(" ArithmeticPrimary ")"
 */
class ArrayAgg extends FunctionNode
{
    public $firstDateExpression = null;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER); // (2)
        $parser->match(Lexer::T_OPEN_PARENTHESIS); // (3)
        $this->firstDateExpression = $parser->ArithmeticPrimary(); // (4)
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); // (3)
    }
//array_agg
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker){
        return 'array_agg('.
            $this->firstDateExpression->dispatch($sqlWalker) .
            ')';
    }
}