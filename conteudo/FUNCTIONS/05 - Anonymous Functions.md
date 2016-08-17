# Fun��o

## Fun��es An�nimas

Fun��es an�nimas, closures ou fun��es lambda, permitem a cria��o de fun��es que n�o tem o nome especificado. Elas s�o mais �teis como o valor de par�metros callback, mas podem tem v�rios outros usos como por exemplo valores de vari�veis. S�o implementadas utilizando a classe Closure.

```php
<?php
echo preg_replace_callback('~_([a-z])([a-z])~', function ($match) {
    return " - ".strtoupper($match[1].$match[2]);
}, '-Com o que se fabrica o colar de_pe_ro_las?<br><br>');

$resposta = function($name)
{
    printf("-Com as %s!!\r\n", $name);
};

$resposta('p�rolas');
```

Closures tamb�m podem herdar vari�veis do escopo pai. Essas vari�veis precisam ser referenciadas utilizando a instru��o *use*.

```php
$message = '[Chiquinha solta um grito de horror ao ver seu pai nas m�os da bruxa do 71]<br>-Quem est� a�?!<br>-Miau!<br>';

// Sem "use"
$example = function () {
    echo($message);
};
$example();

// Inherit $message
$example = function () use ($message) {
    echo($message);
};
$example();

// Herdando valor da vari�vel quando a fun��o � definida,
// n�o quando � chamada
$message = '-� voc� Satan�s? Fora daqui! hehehehe...<br><br>';
echo $message;
$example(); //repete o uso da mensagem anterior

// Reseta mensagem
$message = '<br>[Chaves, fazendo sinal da cruz, acaba derrubando os pratos]<br>-E agora, quem est� a�?!<br>';

// Herdando por refer�ncia
$example = function () use (&$message) {
    echo($message);
};
$example();

// O valor modificado no escopo pai
// reflete quando a fun��o � chamada
$message = '-...';
$example();

// Closures tamb�m aceitam argumentos normais
$message = '!!!';
$example = function ($arg) use ($message) {
    echo($arg . ' ' . $message);
};
$example("Outro gato");
```