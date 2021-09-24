<?php

declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PhpCsFixer;

use PhpCsFixer\Tokenizer\Analyzer\FunctionsAnalyzer;
use PhpCsFixer\Tokenizer\Tokens;

/**
 * @internal
 *
 * @author Vladimir Reznichenko <kalessil@gmail.com>
 */
abstract class AbstractFunctionReferenceFixer extends AbstractFixer
{
    /**
     * {@inheritdoc}
     */
    public function isRisky(): bool
    {
        return true;
    }

    /**
     * Looks up Tokens sequence for suitable candidates and delivers boundaries information,
     * which can be supplied by other methods in this abstract class.
     *
     * @return null|int[] returns $functionName, $openParenthesis, $closeParenthesis packed into array
     */
    protected function find(string $functionNameToSearch, Tokens $tokens, int $start = 0, ?int $end = null): ?array
    {
        // make interface consistent with findSequence
        $end = null === $end ? $tokens->count() : $end;

        // find raw sequence which we can analyse for context
        $candidateSequence = [[T_STRING, $functionNameToSearch], '('];
        $matches = $tokens->findSequence($candidateSequence, $start, $end, false);
        if (null === $matches) {
            // not found, simply return without further attempts
            return null;
        }

        // translate results for humans
        [$functionName, $openParenthesis] = array_keys($matches);

        $functionsAnalyzer = new FunctionsAnalyzer();

        if (!$functionsAnalyzer->isGlobalFunctionCall($tokens, $functionName)) {
            return $this->find($functionNameToSearch, $tokens, $openParenthesis, $end);
        }

        return [$functionName, $openParenthesis, $tokens->findBlockEnd(Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $openParenthesis)];
    }
}
