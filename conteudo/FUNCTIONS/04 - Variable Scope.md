# Fun��o

## Escopo de Vari�veis

Vari�veis declaradas nas fun��es n�o s�o vis�veis fora das mesmas fun��es, enquanto que vari�veis declaradas fora de fun��es s�o vis�veis em qualquer lugar fora dessas fun��es.

```php
<?php
function jovemAinda() { 
	$velho = 'Dr. Chapatin';
	echo "<br>Se voc� � jovem ainda, jovem ainda, jovem ainda<br>";
	echo 'A bateria � do '.$baterista; //Notice
}

$baterista = 'Quico';
echo 'nome: '.$velho; //Notice
jovemAinda();
echo 'nome: '.$velho; //Notice
```

O resultado acima pode ser diferente com o uso da array $GLOBALS ou da palavra chave global.

```php
<?php
function jovemAinda() { 
	$GLOBALS['velho'] = 'Dr. Chapatin';
	global $baterista;
	echo "<br>Se voc� � jovem ainda, jovem ainda, jovem ainda<br>";
	echo 'A bateria � do '.$baterista;
}

$baterista = 'Quico';
echo 'nome: '.$velho; //Notice
jovemAinda();
echo '<br>nome: '.$velho
```

## Fun��es Vari�veis

Se uma vari�vel possui um conjunto de parenteses, PHP vai procurar por uma fun��o com o mesmo nome do valor da vari�vel e assim executar a fun��o encontrada. � um recurso muito usado na implementa��o de callbacks e tabelas de fun��es. Essa t�cnica n�o funciona com constructs do PHP como o echo, unset(), print, empty(), etc...

```php
<?php
function chegadaVila() { 
	echo "-Tinha que ser o Chaves!!!<br>";
	echo '-Foi sem querer querendo...<br><br>';
}

$func = 'chegadaVila';
$func();

$func = 'print';
//$func('o que ser� que ele quis dizer?'); //FATAL ERROR

function wrapPrint($fala){
  print($fala);
}
$func = 'wrapPrint';
$func('-As quatro opera��es matem�ticas s�o adi��o, subtra��o, multiplica��o e divis�o!<br>');
$func = 'print_r';
$func('-Ai que burro d� zero pra ele!<br>');
```

Podemos usar tamb�m a fun��o call_user_func para chamar a fun��o.
```php
<?php
function chegadaVila() { 
	echo "Dona Florinda: -A Dona Clotilde foi a �ltima a chegar na vila...<br>";
	echo 'Chaves: -Mas foi a primeira a chegar no mundo!<br><br>';
}

function chavesAlimento($pao,$ator){
  if ($pao=='amassado'){
    echo "-Mas ele n�o amassou com os olhos, ele amassou com...<br/>-Cale-se, ".$ator.'!<br/>';
  	return "-E agora o que que eu vou comer?!";
  }else{
    return "Isso, isso, isso!";
  }
}

call_user_func('chegadaVila');
echo call_user_func('chavesAlimento','amassado','Quico');
```

Al�m disso m�todos tamb�m podem ser vari�veis.
```php
<?php
class SeuMadrugaProfessor
{
    static $Perigo = '-O que significa essa caveira?<br>';
	function Fala()
    {
        $name = 'Autoridade';
        $this->$name(); // Isto chama o m�todo Bar()
    }

    function Autoridade()
    {
        echo "-Nada de Seu Madruga, � SENHOR PROFESSOR!!<br>";
    }

    static function Perigo()
    {
        echo "-Essa caveira significa prerigo! PRE! RI! GO!!<br>";
    }

    function Psicologia()
    {
        echo "-S� usei um pouco de pepsicologia!<br>";
    }
}

$professor = new SeuMadrugaProfessor();
$aula = "Fala";
$professor->$aula();

echo SeuMadrugaProfessor::$Perigo;
$func = array("SeuMadrugaProfessor", "Perigo");
$func();
$func = array(new SeuMadrugaProfessor, "Psicologia");
$func();
```