# DATA FORMATS AND TYPES - JSON & AJAX

## JSON

Javascript Object Notation, � uma estrutura de dados bastante popular por ser mais leve e n�o ter marca��o verbosa como o XML. 
A decodifica��o no PHP � feita por um parser baseado no JSON_checker de Douglas Crockford. � uma extens�o PECL que passou a ser compilada por padr�o a partir da vers�o 5.2.0

> Nota: O PHP implementa uma extens�o do JSON al�m do especificado no RFC 4627 - podendo tamb�m codificar e decodificar tipos escalares e NULL. A RFC 4627 apenas suporta esses valores quando eles est�o inseridos dentro de um objeto ou array. Ou seja, embora esteja de acordo com a nova RFC 7159 (que pretende susceder a RFC 4627), a implementa��o no PHP pode causar problemas de compatibilidade com parsers de JSON que sejam restritos a RFC 4627.

## Fun��es

Temos o json_encode para converter vari�veis PHP em JSON.

```php
string json_encode ( mixed $value [, int $options = 0 [, int $depth = 512 ]] )
```
Onde $value � o dado a ser convertido. $options pode ser uma das constantes de bitmask. $depth determina a profundidade m�xima de n�veis para convers�o.

```PHP
<?php
$arr = array('a' => 'foo', 'b' => 'bar', 'c' => 1, 'd' => 2, 'e' => 3);
echo json_encode($arr); //{"a":"foo","b":"bar","c":1,"d":2,"e":3}
```
EXERCICIO: [LINK](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/json/json_ex1.php)

J� json_decode converte uma string JSON em uma vari�vel PHP

```PHP
mixed json_decode ( string $json [, bool $assoc ] )
```
Onde $json � a string JSON a ser convertida. $assoc indica que o retorno ser� um array associativo caso seja TRUE, do contr�rio devolve um objeto.

```PHP
$json = '{"foo-bar": 12345}';

$obj = json_decode($json);
print $obj->{'foo-bar'}; // 12345
```
EXERCICIO: [LINK](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/json/json_ex2.php)

Por fim temos as seguintes fun��es para tratamento de erros:
```php
int json_last_error ( void )
string json_last_error_msg ( void )
```
Retornando o c�digo e a descri��o do erro.

## Constantes

As seguintes constantes indicam o tipo de erro retornado pela fun��o json_last_error().

**JSON_ERROR_NONE (integer)**
* Sem erros.

**JSON_ERROR_DEPTH (integer)**
* O limite de pilha de chamadas foi ultrapassado

**JSON_ERROR_STATE_MISMATCH (integer)**
* Ocorre em underflows ou com incongru�ncia de modos.

**JSON_ERROR_CTRL_CHAR (integer)**
* Erro em caracter de controle, possivelmente erro de enconding.

**JSON_ERROR_SYNTAX (integer)**
* Erro de sintaxe.

**JSON_ERROR_UTF8 (integer)**
* Caracteres UTF-8 mal formados, possivelmente erro de enconding.

**JSON_ERROR_RECURSION (integer)**
* O objeto ou array passado para json_encode() inclui refer�ncias recursivas, e n�o pode ser formatada. Se a op��o JSON_PARTIAL_OUTPUT_ON_ERROR foi informada, NULL ser� substituido no lugar da refer�ncia recursiva.

**JSON_ERROR_INF_OR_NAN (integer)**
* Um valor passado para json_encode() inclui NAN ou INF. Se a op��o JSON_PARTIAL_OUTPUT_ON_ERROR foi informada, 0 ser� substitu�do no lugar do n�mero especial.

**JSON_ERROR_UNSUPPORTED_TYPE (integer)**
* Um valor de um tipo n�o suportado foi informado para json_encode(), por exemplo um resource. Se a op��o JSON_PARTIAL_OUTPUT_ON_ERROR foi informada, NULL ser� substitui ao inv�s do valor n�o suportado.

---
As seguintes constantes podem ser combinadas para formar op��es para a fun��o json_encode().

**JSON_HEX_TAG (integer)**
* Todos os caracteres < e > ser�o convertidos para \u003C and \u003E.

**JSON_HEX_AMP (integer)**
* Todos os caracteres & ser�o convertidos para \u0026.

**JSON_HEX_APOS (integer)**
* Todos os caracteres ' ser�o convertidos para \u0027.

**JSON_HEX_QUOT (integer)**
* Todos os caracteres " ser�o convertidos para \u0022.

**JSON_FORCE_OBJECT (integer)**
* Imprime um objeto em vez de um array quando um array n�o recursivo � usado. Muito �til quando o chamador espera um objeto mas o array est� vazio.

**JSON_NUMERIC_CHECK (integer)**
* Codifica strings num�ricas como n�meros.

**JSON_BIGINT_AS_STRING (integer)**
* Codifica n�meros grandes como seu valor string original.

**JSON_PRETTY_PRINT (integer)**
* Formata os dados retornados com espa�os em branco.

**JSON_UNESCAPED_SLASHES (integer)**
* N�o escapa o caracter /.

**JSON_UNESCAPED_UNICODE (integer)**
* Codifica caracteres Unicode multibyte literalmente (default � formatar como \uXXXX).

**JSON_PARTIAL_OUTPUT_ON_ERROR (integer)**
* Substitui valores n�o identificados ao inv�s de falhar.