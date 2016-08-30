# DATA FORMATS AND TYPES - XML Parser

## Introdu��o

### Defini��o

XML (eXtensible Markup Language) � um formato de dados para interc�mbio de documentos na Web. Ele � um padr�o definido pela The World Wide Web consortium (W3C). Os dados s�o organizados de forma hier�rquica, independente de plataforma de hardware ou software.

### Hist�ria

Em meados da d�cada de 1990, o World Wide Web Consortium (W3C) come�ou a trabalhar em uma linguagem de marca��o que combinasse a flexibilidade da SGML com a simplicidade da HTML. O princ�pio do projeto era criar uma linguagem que pudesse ser lida por software, e integrar-se com as demais linguagens. Sua filosofia seria incorporada por v�rios princ�pios importantes:
* Separa��o do conte�do da formata��o
* Simplicidade e legibilidade, tanto para humanos quanto para computadores
* Possibilidade de cria��o de tags sem limita��o
* Cria��o de arquivos para valida��o de estrutura (chamados DTDs)
* Interliga��o de bancos de dados distintos
* Concentra��o na estrutura da informa��o, e n�o na sua apar�ncia

### Exemplo

```xml
<?xml version="1.0" encoding="ISO-8859-1"?>
<videogame nome="SNES" ano_lancamento="1990" fabricante="Nintendo">
  <titulo>Super Nintendo Entertainment System</titulo>
  <jogos>
    <jogo desenvolvedora="Nintendo" ano="1990" genero="plataforma">Super Mario World</jogo>
    <jogo desenvolvedora="Kemco" ano="1991" genero="corrida">Top Gear</jogo>
    <jogo desenvolvedora="Square" ano="1992" genero="rpg">Final Fantasy V</jogo>
    <jogo desenvolvedora="Capcom" ano="1993" genero="luta">Mega Man X</jogo>
  </jogos>
  <curiosidades>
    <item>Sucessor do Nintendo Entertainment System (NES).</item>
    <item>Teve forte concorr�ncia com o Mega Drive nos EUA.</item>
    <item>Foi lan�ado no Brasil em 1993 pela Playtronic.</item>
  </curiosidades>
</videogame >
```

## XML Parser

A extens�o para XML do PHP foi baseada no **Expat** de autoria de James Clark ([http://www.libexpat.org/](http://www.libexpat.org/)). Lan�ado em 1998 e programado em C, foi o primeiro parser de XML open source, sendo assim utilizado em diversos projetos open source. Essa extens�o requer que a extens�o **libxml** esteja habilitada, embora essa extens�o j� venha habilitada por padr�o. As fun��es da biblioteca expat tamb�m est�o habilitadas por padr�o.

Tr�s encodings s�o suportados na vers�o do PHP: US-ASCII, ISO-8859-1 e UTF-8.

## Codifica��o

H� dois tipos de codifica��o de caracteres, **source encoding** e **target encoding**. A representa��o interna do documento no PHP � sempre codificada em UTF-8. 

**Source Encoding** ocorre quando um documento XML � analisado (xml_parse()). Ao criar um analisador (xml_parser_create()) � poss�vel definir uma codifica��o de caracteres. Essa codifica��o n�o pode ser alterada durante a vida do analisador.

Das codifica��es dispon�veis (ISO-8859-1, US-ASCII e UTF-8) os dois primeiros s�o codifica��es single-byte, onde cada caractere � representado por um byte simples. UTF-8 pode codificar caracteres compostos por um n�mero de bits vari�vel (acima de 21) em um de seus 4 bytes. A codifica��o padr�o para source encoding no PHP � a ISO-8859-1.

Caso haja caracteres fora da codifica��o do source encoding, o Analisador XML retorna erro.

**Target Encoding** ocorre quando o PHP passa dados para as fun��es manipuladoras de XML. Nesse caso a codifica��o � a mesma definida no analisador XML para o source encoding, mas pode ser alterada a qualquer momento.

Caso haja caracteres fora da codifica��o do target encoding, o PHP ir� substituir (demote) os caracteres problem�ticos por interroga��es (?).

## Manipuladores de eventos

Podemos definir para o analisador XML quais fun��es devem ser executadas ao encontrar determinados elementos no arquivo XML. Seguem abaixo os manipuladores suportados:

**xml_set_element_handler()**
Estes eventos s�o executados toda vez que o analisador XML encontra tags de abertura ou fechamento. H� manipuladores distintos para cada uma.

**xml_set_character_data_handler()**
Dados de caractere s�o todo o conte�do non-markup, incluindo espa�os entre as tags. O analisador n�o remove os espa�os, deixando a crit�rio da aplica��o se os espa�os s�o significativos ou n�o.

**xml_set_processing_instruction_handler()**
Programadores de PHP j� estariam familiarizados com instru��es de processo (PIs). <?php ?> � uma instru��o de processo, onde php � o "PI target". Todos os PI targets iniciados com "XML" est�o reservados.

**xml_set_default_handler()**
Caso aconte�a algum evento desta lista e este n�o tenha nenhum manipulador declarado, este manipulador ser� executado.

**xml_set_unparsed_entity_decl_handler()**
Este manipulador ser� chamado por uma declara��o de entidade externa n�o analisada (NDATA).

**xml_set_notation_decl_handler()**
Este manipulador � chamado pela declara��o de uma notation.

**xml_set_external_entity_ref_handler()**
Este manipulador � chamado quando o analisador XML encontra uma refer�ncia para uma entidade geral analizada externamente. Isto pode ser uma refer�ncia para um arquivo ou URL. 


## Fun��es do XML Parser

### Fun��es b�sicas para an�lise

**xml_parser_create**

```php 
resource xml_parser_create ([ string $encoding ] )
```
 
Cria um novo analisador XML. O parametro encoding determina a codifica��o do output. A codifica��o do input � detectada automaticamente no PHP 5, enquanto que no PHP 4 as codifica��es de input e output s�o definidas pelo mesmo parametro. 

A codifica��o padr�o de output no PHP 5.0.0 e 5.0.1 � o ISO-8859-1. A partir do PHP 5.0.2 passou a ser o UTF-8.

```php
<?php
$xmlparser = xml_parser_create(); //parser em UTF-8 no PHP 5.5

xml_parser_free($xmlparser);

$xmlparser = xml_parser_create("ISO-8859-1"); //parser agora em ISO-8859-1

xml_parser_free($xmlparser);
```

**xml_parse**

```php 
int xml_parse ( resource $parser , string $data [, bool $is_final = false ] )
```
 
Inicia a an�lise (parse) de um documento XML. Indicamos nesta fun��o o analisador (parser), o dado de XML a ser analisado e o parametro opcional indicando que esta � a �ltima parte dos dados a serem analisados pelo parser. Erros de entidade s�o reportados somente no final dos dados analisados, ou seja ser�o reportados apenas quando $is_final for igual a TRUE.

```php
<?php
$parser=xml_parser_create();

$fp=fopen("test.xml","r");

while ($data=fread($fp,4096))
{
  xml_parse($parser,$data,feof($fp));
}

xml_parser_free($parser);
```

**xml_parser_create_ns**

```php 
resource xml_parser_create_ns ([ string $encoding [, string $separator = ":" ]] )
```
 
Cria um novo analisador XML. A diferen�a � que neste caso o analisador possui suporte � namespace (xmlns).

```php
<?php
$xmlparser = xml_parser_create_ns(); //parser em UTF-8 no PHP 5.5, delimitando por ":"

xml_parser_free($xmlparser);

$xmlparser = xml_parser_create("ISO-8859-1","@"); //parser agora em ISO-8859-1, delimitando por "@"

xml_parser_free($xmlparser);
?>
```

**xml_parser_free**

```php 
bool xml_parser_free ( resource $parser )
```
 
Libera um analisador XML. Retorna TRUE em caso de sucesso ou FALSE caso a refer�ncia ao analisador n�o for v�lida.

```php
<?php
$xmlparser = xml_parser_create_ns(); //parser em UTF-8 no PHP 5.5, delimitando por ":"

xml_parser_free($xmlparser);
?>
```

**xml_set_element_handler**

```php 
bool xml_set_element_handler ( resource $parser , callable $start_element_handler , callable $end_element_handler )
```

Define as fun��es que ser�o executadas ao encontrar as tags de abertura e fechamento pelo analisador XML. Retorna TRUE em sucesso, FALSE em falha.
A fun��o para a tag de abertura deve conter a seguinte estrutura:

```php
start_element_handler ( resource $parser , string $name , array $attribs )
```
Onde $name � o nome do elemento, e $attribs � uma array contendo todos os atributos daquele elemento.

A fun��o para a tag de fechamento deve conter a seguinte estrutura:

```php
end_element_handler ( resource $parser , string $name )
```
Onde $name � o nome do elemento.

> Nota: Os nomes dos elementos e as chaves dos atributos est�o em mai�sculo por causa do **case_folded** que est� ativado por padr�o no analisador XML. Com isso, os nomes estar�o sempre em mai�sculo. Isso pode ser desativado atrav�s da fun��o xml_parser_set_option() que veremos mais adiante.


**xml_set_character_data_handler**

```php 
bool xml_set_character_data_handler ( resource $parser , callable $handler )
```
 
Define a fun��o que ser� executada ao encontrar um caractere no XML. Retorna TRUE em sucesso, FALSE em falha.
A fun��o deve conter a seguinte estrutura:

```php
handler ( resource $parser , string $data )
```

**xml_parser_set_option**

```php 
bool xml_parser_set_option ( resource $parser , int $option , mixed $value )
```
 
Define uma op��o de um analisador XML. Retorna TRUE em sucesso, FALSE em falha.

|Op��o                     |Tipo                    |Descri��o                                                                             |
|--------------------------|------------------------|--------------------------------------------------------------------------------------|
|XML_OPTION_CASE_FOLDING   |Integer                 |Controla se case-folding est� habilitado para este analisador XML. Ativado por padr�o. (1=TRUE, 0=FALSE)|
|XML_OPTION_SKIP_TAGSTART  |Integer                 |Especifica quantos caracteres devem ser ignorados no in�cio do nome de uma tag.       |
|XML_OPTION_SKIP_WHITE     |Integer                 |Se ir� pular valores constitu�dos por espa�os em branco. (1=TRUE, 0=FALSE)            |
|XML_OPTION_TARGET_ENCODING|String                  |Define qual codifica��o ser� usada neste analisador XML. Por pradr�o, � definido com a mesma codifica��o usada pelo xml_parser_create(). Codifica��es suportadas s�o ISO-8859-1, US-ASCII e UTF-8.|

**xml_parser_get_option**

```php 
mixed xml_parser_get_option ( resource $parser , int $option )
```
 
Recupera o valor de uma op��o de um analisador XML. Retorna o valor da op��o em sucesso, FALSE em falha.


EXERC�CIOS: [LINK1](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/xml_parse.php), [LINK2](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/xml_parse_ns.php) e [LINK3](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/xml_parse_opt.php)

### Tratamento de erros e localiza��o do analisador

**xml_get_current_byte_index**

```php 
int xml_get_current_byte_index ( resource $parser )
```

Retorna o �ndice atual de byte do analisador XML, ou FALSE em caso de erro/falha.

> Nota: Esta fun��o retorna o ind�ce de acordo com o texto em codifica��o UTF-8, independente da codifica��o do texto de input.

**xml_get_current_column_number**

```php 
int xml_get_current_column_number ( resource $parser )
```

Retorna o n�mero da coluna onde o analisador XML se encontra, ou FALSE em caso de erro/falha.

**xml_get_current_line_number**

```php 
int xml_get_current_line_number ( resource $parser )
```

Retorna o n�mero da linha onde o analisador XML se encontra, ou FALSE em caso de erro/falha.

**xml_get_error_code**

```php 
int xml_get_error_code ( resource $parser )
```

Retorna o c�digo do erro encontrada pelo analisador XML, ou FALSE em caso de erro/falha.

**xml_error_string**

```php
string xml_error_string ( int $code )
```

Retorna a descri��o do erro encontrada pelo analisador XML, ou FALSE em caso de erro/falha.

```php
<?php
//invalid xml file
$xmlfile = 'test.xml';

$xmlparser = xml_parser_create();

// open a file and read data
$fp = fopen($xmlfile, 'r');
while ($xmldata = fread($fp, 4096))
  {
  // parse the data chunk
  if (!xml_parse($xmlparser,$xmldata,feof($fp)))
    {
    die( print "ERROR: "
    . xml_error_string(xml_get_error_code($xmlparser))
    . "<br />"
    . "Line: "
    . xml_get_current_line_number($xmlparser)
    . "<br />"
    . "Column: "
    . xml_get_current_column_number($xmlparser)
    . "<br />");
    }
  }

xml_parser_free($xmlparser);
```

EXERC�CIO: [LINK](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/xml_parse_error.php)

### Arrays e Objetos

**xml_parse_into_struct**

```php
int xml_parse_into_struct ( resource $parser , string $data , array &$values [, array &$index ] )
```

Esta fun��o analisa os dados, armazenando-os em duas arrays paralelas, uma com os valores e outra opcional contendo os indicadores para os valores da primeira array.

> Nota: O retorno � 0 para falha e 1 para sucesso, mas n�o pode ser considerado como FALSE ou TRUE ao fazer compara��es id�nticas (=== ou !==)

**xml_set_object**

```php
bool xml_set_object ( resource $parser , object &$object )
```

Permite usar o analisador XML em um objeto. Retorna TRUE como sucesso, ou FALSE como falha.

EXERC�CIOS: [LINK1](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/xml_parse_opt2.php) e [LINK2](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/xml_parse_obj.php)

### Manipuladores de Eventos

> Para todas as fun��es de manipuladores de evento, caso uma fun��o seja passada como uma string vazia, o manipulador � desabilitado para aquele evento.

**xml_set_default_handler**

```php
bool xml_set_default_handler ( resource $parser , callable $handler )
```

Define o manipulador padr�o para o analisador XML. Retorna TRUE em sucesso e FALSE em falha.
A fun��o manipuladora deve conter a seguinte estrutura:

```php
handler ( resource $parser , string $data )
```
Onde $data cont�m os dados de caractere, que pode ser a declara��o XML, a declara��o do tipo de documento, entidades ou qualquer dado que n�o possua um manipulador definido.

**xml_set_start_namespace_decl_handler / xml_set_end_namespace_decl_handler**

```php
bool xml_set_start_namespace_decl_handler ( resource $parser , callable $handler )
bool xml_set_end_namespace_decl_handler ( resource $parser , callable $handler )
```

Define o manipulador a ser executado quando abre/fecha uma tag contendo uma declara��o namespace.
A fun��o manipuladora deve conter a seguinte estrutura:

```php
handler ( resource $parser , string $prefix , string $uri ) //start
handler ( resource $parser , string $prefix ) //end
```
Onde $prefix � o prefixo do namespace, e $uri o significado.

> Nota: essas fun��es n�o funcionam pelo Libxml [(https://bugs.php.net/bug.php?id=30834)](https://bugs.php.net/bug.php?id=30834)

**xml_set_external_entity_ref_handler**

```php
bool xml_set_external_entity_ref_handler ( resource $parser , callable $handler )
```

Define o manipulador a ser executado quando o analisador encontra refer�ncia para entidade externa. Retorna TRUE em sucesso e FALSE em falha.
<!ENTITY name SYSTEM "URI"><!ENTITY name PUBLIC "public_ID" "URI">
A fun��o manipuladora deve conter a seguinte estrutura:

```php
handler ( resource $parser , string $open_entity_names , string $base , string $system_id , string $public_id )
```
Onde $open_entity_names cont�m os nomes das entidades separadas por espa�o. $base especifica a base para resolu��o do ID do sistema (system_id) da entidade externa, mas atualmente, � sempre NULL. $system_id � a refer�ncia do ID do sistema (SYSTEM), e $public_id � o ID p�blico (PUBLIC)

**xml_set_notation_decl_handler**

```php
bool xml_set_notation_decl_handler ( resource $parser , callable $handler )
```

Define o manipulador a ser executado quando o analisador uma anota��o (notation). Retorna TRUE em sucesso e FALSE em falha.
<!NOTATION name SYSTEM "URI"><!NOTATION name PUBLIC "public_ID"><!NOTATION name PUBLIC "public_ID" "URI">
A fun��o manipuladora deve conter a seguinte estrutura:

```php
handler ( resource $parser , string $notation_name , string $base , string $system_id , string $public_id )
```
Onde $notation_name cont�m o nome da notation. $base especifica a base para resolu��o do ID do sistema (system_id) da entidade externa, mas atualmente, � sempre NULL. $system_id � a refer�ncia do ID do sistema (SYSTEM), e $public_id � o ID p�blico (PUBLIC)

**xml_set_processing_instruction_handler**

```php
bool xml_set_processing_instruction_handler ( resource $parser , callable $handler )
```

Define o manipulador para Instru��es de Processamento (PI). Retorna TRUE em sucesso e FALSE em falha.
Uma instru��o de processamento possui a seguinte estrutura, podendo incluir tamb�m c�digo PHP:
<?
target data
?>
No c�digo abaixo, a PI indica que o arquivo especificado deve ser associado ao documento XML:
<?xml-stylesheet href="default.xls" type="text/xml"?>
A fun��o manipuladora deve conter a seguinte estrutura:

```php
handler ( resource $parser , string $target , string $data )
```
Onde $target cont�m o alvo (target) da PI, e $data cont�m os dados da PI.

**xml_set_unparsed_entity_decl_handler**

```php
bool xml_set_unparsed_entity_decl_handler ( resource $parser , callable $handler )
```

Define o manipulador a ser executado quando o analisador encontra declara��o de entidade n�o analisada (unparsed). Retorna TRUE em sucesso e FALSE em falha.
Uma entidade n�o analisada geralmente se refere a dados n�o-XML. Possui a seguinte estrutura:
<!ENTITY <parameter>name</parameter> {<parameter>publicId</parameter> | <parameter>systemId</parameter>} NDATA <parameter>notationName</parameter>
A fun��o manipuladora deve conter a seguinte estrutura:

```php
handler ( resource $parser , string $entity_name , string $base , string $system_id , string $public_id , string $notation_name )
```
Onde $entity_name cont�m o nome da entidade. $base especifica a base para resolu��o do ID do sistema (system_id) da entidade externa, mas atualmente, � sempre NULL. $system_id � a refer�ncia do ID do sistema (SYSTEM), e $public_id � o ID p�blico (PUBLIC). Por fim, $notation_name se refere � nota��o da entidade

EXERC�CIO: [LINK](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/xml_events.php)

### Codifica��o

**utf8_decode / utf8_encode**

```php 
string utf8_decode ( string $data )
string utf8_encode ( string $data )
```

Decodifica de UTF8 para ISO-8859-1 / codifica de ISO-8859-1 para UTF8. Retorna a string convertida ou FALSE em caso de erro/falha.

```php
<?php
$str = 'ab���';

echo utf8_decode($str);
echo utf8_encode($str);
```

> Nota: Al�m dessas fun��es, temos xml_parser_set_option(XML_OPTION_TARGET_ENCODING) para lidar com codifica��o do target encoding

## Constantes Pre-definidas

```php
XML_ERROR_NONE (integer)
XML_ERROR_NO_MEMORY (integer)
XML_ERROR_SYNTAX (integer)
XML_ERROR_NO_ELEMENTS (integer)
XML_ERROR_INVALID_TOKEN (integer)
XML_ERROR_UNCLOSED_TOKEN (integer)
XML_ERROR_PARTIAL_CHAR (integer)
XML_ERROR_TAG_MISMATCH (integer)
XML_ERROR_DUPLICATE_ATTRIBUTE (integer)
XML_ERROR_JUNK_AFTER_DOC_ELEMENT (integer)
XML_ERROR_PARAM_ENTITY_REF (integer)
XML_ERROR_UNDEFINED_ENTITY (integer)
XML_ERROR_RECURSIVE_ENTITY_REF (integer)
XML_ERROR_ASYNC_ENTITY (integer)
XML_ERROR_BAD_CHAR_REF (integer)
XML_ERROR_BINARY_ENTITY_REF (integer)
XML_ERROR_ATTRIBUTE_EXTERNAL_ENTITY_REF (integer)
XML_ERROR_MISPLACED_XML_PI (integer)
XML_ERROR_UNKNOWN_ENCODING (integer)
XML_ERROR_INCORRECT_ENCODING (integer)
XML_ERROR_UNCLOSED_CDATA_SECTION (integer)
XML_ERROR_EXTERNAL_ENTITY_HANDLING (integer)

XML_OPTION_CASE_FOLDING (integer)
XML_OPTION_TARGET_ENCODING (integer)
XML_OPTION_SKIP_TAGSTART (integer)
XML_OPTION_SKIP_WHITE (integer)
```