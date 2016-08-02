# Fun��o

## Por Refer�ncia

Aqui podemos passar diretamente a vari�vel para ser alterada pela fun��o, dispensando a necessidade de um return por exemplo.

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