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

Herdar vari�veis do escopo pai n�o � o mesmo que usar vari�veis globais. Vari�veis globais existem no escopo global, o qual � o mesmo n�o importa a fun��o sendo executada. O escopo pai de um closure � a fun��o no qual o closure foi declarado (n�o necess�riamente a fun��o apartir do qual ele foi chamado).

```php
<?php
class RestauranteDonaFlorinda
{
    const PRECO_XICARA_DE_CAFE = 1000.00;
    const PRECO_BISCOITO_DE_ABACAXI = 2000.00;
    const PRECO_SANDUICHE_DE_PRESUNTO = 5900.55;

    protected $products = array();

    public function add($product, $quantity)
    {
        $this->products[$product] = $quantity;
    }

    public function getTotal($tax)
    {
        $total = 0.00;

        $callback =
            function ($quantity, $product) use ($tax, &$total)
            {
                $pricePerItem = constant(__CLASS__ . "::PRECO_" .
                    strtoupper($product));
                $total += ($pricePerItem * $quantity) * ($tax + 1.0);
				if($product=='biscoito_de_abacaxi') echo "-N�O TEM BISCOITO!!!<br>";
            };

        array_walk($this->products, $callback);
        return round($total, 2);
    }
}

$my_cart = new RestauranteDonaFlorinda;

// Add some items to the cart
$my_cart->add('sanduiche_de_presunto', 2);
$my_cart->add('xicara_de_cafe', 3);
$my_cart->add('biscoito_de_abacaxi', 7);

// Print the total with a 5% sales tax.
echo "Total: Cr$ " . $my_cart->getTotal(0.05) . "<br>";
```

Vincula��o autom�tica de $this. Do PHP 5.4 ou acima, ao ser declarada no contexto de uma classe, a classe corrente � automaticamente vinculada a ela, tornando $this dispon�vel dentro do escopo da fun��o.

```php
<?php
class SuperSam
{
    public $frase = 'Time is money! Oh yeah...!';
	public function gritoDeGuerra()
    {
        return function() {
            var_dump($this->frase);
        };
    }
}

$heroi = new SuperSam;
$function = $heroi->gritoDeGuerra();
$function();
```