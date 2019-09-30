<?php
namespace App\DoctrineExtensions;

use Doctrine\ORM\Query\AST\Functions\FunctionNode,
    Doctrine\ORM\Query\Lexer;

/**
 * Weekly ::= "WEEKLY" "(" ArithmeticPrimary ")"
 */
class Weekly extends FunctionNode
{
    // (1)
    public $firstDateExpression = null;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER); // (2)
        $parser->match(Lexer::T_OPEN_PARENTHESIS); // (3)
        $this->firstDateExpression = $parser->ArithmeticPrimary(); // (4)
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); // (3)
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker){
        return '(date_trunc(\'week\'::text, '.
            $this->firstDateExpression->dispatch($sqlWalker) .
            '+ \'00:00:00\'::interval)::date + interval \'4days\')::date'; // (7)
    }
}