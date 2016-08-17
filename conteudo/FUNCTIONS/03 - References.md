# Fun��o

## Por Refer�ncia

Aqui podemos passar diretamente a vari�vel para ser alterada pela fun��o, dispensando a necessidade de um return com o valor. Para isso basta adicionar um & na frente do argumento.

```php
<?php
function levaTapa($SeuMadruga) { 
	$SeuMadruga = false;
	echo "Vamos tesouro, e n�o se misture com essa gentalha!<br/>";
}

function levaTapaReal(&$SeuMadruga) { 
	$SeuMadruga = false;
	echo "<br/>Vamos tesouro, e n�o se misture com essa gentalha!<br/>";
}

$SeuMadruga = true;
levaTapa($SeuMadruga);
var_dump($SeuMadruga);
levaTapaReal($SeuMadruga);
var_dump($SeuMadruga);
```

� importante notar que somente vari�veis podem ser passadas por refer�ncia, qualquer outra coisa resultar� em FATAL ERROR.

```php
<?php
function adicionarElemento(array &$colecao, $elemento=null)
{
	if($elemento!==null)
	{
		$colecao[]=$elemento;
	}
}
$velhodosaco=[];
adicionarElemento($velhodosaco);
adicionarElemento($velhodosaco,'chap�us');
adicionarElemento($velhodosaco,'sapatos');
adicionarElemento($velhodosaco,'roupas usadas');
print_r($velhodosaco);

//adicionarElemento([],'quem tem?'); //ERRO
```

� poss�vel tamb�m retornar um valor de uma determinada fun��o por refer�ncia. Para isso, basta inserir um & antes do nome da fun��o, e outro & para quem est� chamando a fun��o. No exemplo abaixo, a vari�vel $palavraChave est� apontando para a propriedade $anoes->palavraChave. Assim, qualquer altera��o em $palavraChave ocorrer� tamb�m na propriedade apontada por refer�ncia, mesmo que seja uma propriedade privada.

```php
<?php
class Anoes {
	private $palavraChave = 'tchuim tchuim tchum clain';
	public function &retornoPorReferencia() {
		return $this->palavraChave;
	}
}

$anoes = new Anoes();
$palavraChave = &$anoes->retornoPorReferencia();

echo "Eis aqui a resposta-chave<br/>Quando algu�m perguntar 'Quem sabe?':<br/>$palavraChave";
echo "<br/>".$anoes->retornoPorReferencia();

$palavraChave = "S� n�o te dou outra porqu�...!";

echo "<br/>".$anoes->retornoPorReferencia();
```