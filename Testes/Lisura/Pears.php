<?php
function pears(Array $pears){
  if(count($pears) > 0){
    echo array_pop($pears);
    pears($pears);
  }
}

$fruit = array ("PHP","Conference");
pears($fruit);
echo PHP_EOL;
