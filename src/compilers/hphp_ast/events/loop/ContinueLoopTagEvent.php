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
