# Fun��o

## Argumentos

Informa��es podem ser passadas para a fun��o atrav�s da lista de argumentos/par�metros. A lista de argumentos � separada por v�rgulas e os argumentos s�o avaliados da esquerda pra direita.

Argumentos podem ser passados de duas formas:

* Por valor (padr�o): Cria uma c�pia do argumento e qualquer altera��o permanece apenas no escopo da fun��o. S�o os exemplos que temos visto at� ent�o.
* Por refer�ncia: Passamos a refer�ncia para a vari�vel original, cujas altera��es efetuadas na fun��o ser�o mantidas ap�s o t�rmino da execu��o. Veremos com detalhe na pr�xima aula

```php
<?php
function QuicoCara ($x,$x='sua',$x='minha'){
	echo "Voc� n�o vai com a ". $x ." cara?";
}

QuicoCara('tua');
```

Temos algumas fun��es nativas PHP para lidar com argumentos.
* int func_num_args ( void ): Retorna o n�mero de argumentos passados para a fun��o
* mixed func_get_arg ( int $arg_num ): Retorna um item de uma lista de argumentos
* array func_get_args ( void ): Retorna um array contendo a lista de argumentos

```php
<?php
<?php
function alunos()
{
    $numargs = func_num_args();
	echo "Total de alunos na classe do Professor Girafalez: $numargs<br/>";
    if ($numargs >= 2) {
        echo "Segundo aluno a chegar: " . func_get_arg(1) . "<br/>";
    }
    $arg_list = func_get_args();
    for ($i = 0; $i < $numargs; $i++) {
        echo "Aluno $i: " . $arg_list[$i] . "<br/>";
    }
}

alunos("Nhonho", "Godinez", "P�pis", "Quico", "Chiquinha", "Chaves");
```

## Valores Padr�o

Argumetos podem ter valores padr�o, assim caso uma vari�vel n�o seja passada como par�metro, uma nova vari�vel � criada, recebendo o valor padr�o.

```php
<?php
function corrigeChaves($a,$textocerto,$textoerrado="Massacote") { 
	if($a<6){
		if($a%2 == 0) 
			echo "-E como eu disse?<br>-".$textoerrado."!<br>";
		else echo "-E como �?<br>-".$textocerto."!<br>";
		corrigeChaves($a+1,$textocerto,$textoerrado);
	} else{
		echo "-E como eu di...<br><h1>AI CALE-SE, CALE-SE, CALE-SE, VOC� ME DEIXA LOOUUU...CO!!!</h1>";
	}
}

corrigeChaves(1,"Planta","Pranta"); //OK
//corrigeChaves(1); //warning Missing Argument
corrigeChaves(3,"Mascote"); //OK
```

Quanto a vari�veis padr�o, temos que ter cuidado com a coloca��o dos argumentos que recebem valor padr�o.
```php
<?php
//Errado
function divida($meses=14, $inquilino){ 
	echo $inquilino . " deve " . $meses . " meses de aluguel!<br/>";
}
divida(16,"Seu Madruga");
divida("Seu Madruga"); //erro

//Correto
function dividaCerta($inquilino, $meses=14){ 
	echo $inquilino . " deve " . $meses . " meses de aluguel!<br/>";
}
dividaCerta("Seu Madruga", 16);
dividaCerta("Seu Madruga"); //correto
```
