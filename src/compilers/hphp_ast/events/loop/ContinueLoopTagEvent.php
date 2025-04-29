<?php

namespace Piewpiew\compilers\hphp_ast\events\loop;

use Piewpiew\compilers\hphp_ast\exceptions\HPHPAstViewException;
use Piewpiew\compilers\hphp_ast\HPHPAstCompiler;
use Piewpiew\view\compiler\ast\AbstractTermEvent;
use Piewpiew\view\compiler\ast\TextLexiq;

class ContinueLoopTagEvent extends AbstractTermEvent
{
  private function handle()
  {
    $lexiqs = array_slice($this->lexiqs, $this->index);

    // Check that it is in a loop
    $count = intval(trim($lexiqs[0]->matches[1] ?? "0"));

    /** @var HPHPAstCompiler $compiler */
    $compiler = $this->compiler;
    $loop_nests = array_sum($compiler->loop_nest);

    if ($count > $loop_nests)
      throw new HPHPAstViewException("Continue loop tag exceeds the number of loops in the view. " .
        "You have $loop_nests loops and you are trying to continue $count loop(s).");

    $lexiqs[0]->replace("<?php continue $count; ?>");
  }

  public function return_lexiqs(): array
  {
    $this->handle();
    return $this->lexiqs;
  }

  public function return_skips(): int
  {
    return 2;
  }
}
