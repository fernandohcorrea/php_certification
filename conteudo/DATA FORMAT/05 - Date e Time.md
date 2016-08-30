# DATA FORMATS AND TYPES - Date & Time

## Defini��o

As fun��es de Data e Hora do PHP permitem recuperar a data e a hora do servidor onde o PHP est� sendo executado. Pode-se usar estas fun��es para formatar a sa�da de data e hora de muitas maneiras diferentes.

As informa��es de data e hora s�o armazenadas internamente como n�meros em 64-bit, sendo assim, todas as datas conceb�veis (inclusive anos negativos) s�o suportadas. O intervalo vai de 292 bilh�es de anos no passado at� a mesma quantidade no futuro. 

Os valores retornados refletem a configura��o local do servidor, bem como datas especiais como hor�rio de ver�o, ano bissexto, etc.

Esta extens�o n�o possui depend�ncias de bibliotecas, e seu funcionamento depende das configura��es definidas no php.ini

|Nome|Padr�o|
|----|------|
|date.default_latitude|"31.7667"|
|date.default_longitude|"35.2333"|
|date.sunrise_zenith|"90.583333"|
|date.sunset_zenith|"90.583333"|
|date.timezone|""|

## date

Temos v�rias fun��es para lidar com manipula��o de datas, sendo a fun��o date a mais usada:

```php
string date ( string $format [, int $timestamp ] )
```

Onde $timestamp � um integer Unix timestamp cujo padr�o � a hora local se o timestamp n�o for informado (retorno da fun��o time()).
$format pode ser uma string que contenha os caracteres das tabelas abaixo:

**Dia**

|Caractere|Descri��o|Exemplo de valores retornados|
|---------|---------|-----------------------------|
|d| 	Dia do m�s, 2 d�gitos com zero � esquerda| 	01 at� 31|
|D| 	Uma representa��o textual de um dia, tr�s letras| 	Mon at� Sun|
|j| 	Dia do m�s sem zero � esquerda| 	1 at� 31|
|l| ('L' min�sculo) 	A representa��o textual completa do dia da semana| 	Sunday at� Saturday|
|N| 	Representa��o num�rica ISO-8601 do dia da semana (adicionado no PHP 5.1.0)| 	1 (para Segunda) at� 7 (para Domingo)|
|S| 	Sufixo ordinal ingl�s para o dia do m�s, 2 caracteres| 	st, nd, rd ou th. Funciona bem com j|
|w| 	Representa��o num�rica do dia da semana| 	0 (para domingo) at� 6 (para s�bado)|
|z| 	O dia do ano (iniciando em 0)| 	0 at� 365|

**Semana**

|Caractere|Descri��o|Exemplo de valores retornados|
|---------|---------|-----------------------------|
|W| 	N�mero do ano da semana ISO-8601, come�a na Segunda (adicionado no PHP 4.1.0)| 	Exemplo: 42 (a 42� semana do ano)|

**M�s**

|Caractere|Descri��o|Exemplo de valores retornados|
|---------|---------|-----------------------------|
|F| 	Um representa��o completa de um m�s, como January ou March| 	January at� December|
|m| 	Representa��o num�rica de um m�s, com zero � esquerda| 	01 a 12|
|M| 	Uma representa��o textual curta de um m�s, tr�s letras| 	Jan a Dec|
|n| 	Representa��o num�rica de um m�s, sem zero � esquerda| 	1 a 12|
|t| 	N�mero de dias de um dado m�s| 	28 at� 31|

**Ano**

|Caractere|Descri��o|Exemplo de valores retornados|
|---------|---------|-----------------------------|
|L| 	Se est� em um ano bissexto| 	1 se est� em ano bissexto, 0, caso contr�rio.
|o| 	N�mero do ano ISO-8601. Este tem o mesmo valor como Y, exceto que se o n�mero da semana ISO (W) pertence ao anterior ou pr�ximo ano, o ano � usado ao inv�s. (adicionado no PHP 5.1.0)| 	Exemplos: 1999 ou 2003|
|Y| 	Uma representa��o de ano completa, 4 d�gitos| 	Exemplos: 1999 ou 2003|
|y| 	Uma representa��o do ano com dois d�gitos| 	Exemplos: 99 ou 03|

**Tempo**

|Caractere|Descri��o|Exemplo de valores retornados|
|---------|---------|-----------------------------|
|a| 	Antes/Depois de meio-dia em min�sculo| 	am or pm|
|A| 	Antes/Depois de meio-dia em mai�sculo| 	AM or PM|
|B| 	Swatch Internet time| 	000 at� 999|
|g| 	Formato 12-horas de uma hora sem zero � esquerda| 	1 at� 12|
|G| 	Formato 24-horas de uma hora sem zero � esquerda| 	0 at� 23|
|h| 	Formato 12-horas de uma hora com zero � esquerda| 	01 at� 12|
|H| 	Formato 24-horas de uma hora com zero � esquerda| 	00 at� 23|
|i| 	Minutos com zero � esquerda| 	00 at� 59|
|s| 	Segundos, com zero � esquerda| 	00 at� 59|
|u| 	Microssegundos (adicionado no PHP 5.2.2). Note que a fun��o date() sempre gerar� 000000, j� que aceita um par�metro integer, enquanto que DateTime::format() possui suporte a microssegundos se DateTime foi criado com microssegundos.| 	Example: 654321|

**Fuso hor�rio**

|Caractere|Descri��o|Exemplo de valores retornados|
|---------|---------|-----------------------------|
|e| 	Identificador do fuso hor�rio (adicionado no PHP 5.1.0)| 	Exemplos: UTC, GMT, Atlantic/Azores|
|I| (i mai�sculo) 	Se a data est� ou n�o no hor�rio de ver�o| 	1 se hor�rio de ver�o, 0, caso contr�rio.|
|O| 	Deslocamento ao Hor�rio de Greenwish (GMT) em horas| 	Exemplo: +0200|
|P| 	Deslocamento ao Hor�rio de Greenwish (GMT) com dois pontos entre horas e minutos (adicionado no PHP 5.1.3)| 	Exemplo: +02:00|
|T| 	Abrevia��o do fuso hor�rio| 	Exemplos: EST, MDT ...|
|Z| 	Deslocamento, em segundos, do fuso hor�rio. O deslocamento para fusos hor�rios a oeste de UTC sempre ser� negativa, e para aqueles � leste de UTC sempre ser� positiva.| 	-43200 at� 50400|

**Data/Hora completa**

|Caractere|Descri��o|Exemplo de valores retornados|
|---------|---------|-----------------------------|
|c| 	Data ISO 8601 (adicionado no PHP 5)| 	2004-02-12T15:19:21+00:00|
|r| 	RFC 2822 formatted date| 	Exemplo: Thu, 21 Dec 2000 16:01:07 +0200|
|U| 	Segundos desde Unix Epoch (January 1 1970 00:00:00 GMT)| 	Veja tamb�m time()|

Exemplo:
```php
<?php
echo date('d/m/Y');

// Escapa os caracteres "t","h" e "e", exibindo <dia da semana> the <dia do m�s sem zero � esquerda>th
echo date("l \\t\h\e jS");
```

EXERCICIO: [LINK](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/datetime/datetime_ex1.php)

## Classe DateTime

Esta classe � uma forma de representar e manipular datas de forma orientada a objetos.

```php
 DateTime implements DateTimeInterface {
    /* Constantes */
      const string ATOM = "Y-m-d\TH:i:sP" ;
      const string COOKIE = "l, d-M-Y H:i:s T" ;
      const string ISO8601 = "Y-m-d\TH:i:sO" ;
      const string RFC822 = "D, d M y H:i:s O" ;
      const string RFC850 = "l, d-M-y H:i:s T" ;
      const string RFC1036 = "D, d M y H:i:s O" ;
      const string RFC1123 = "D, d M Y H:i:s O" ;
      const string RFC2822 = "D, d M Y H:i:s O" ;
      const string RFC3339 = "Y-m-d\TH:i:sP" ;
      const string RSS = "D, d M Y H:i:s O" ;
      const string W3C = "Y-m-d\TH:i:sP" ;
    /* M�todos */
      public __construct ([ string $time = "now" [, DateTimeZone $timezone = NULL ]] )
      public DateTime add ( DateInterval $interval )
      public static DateTime createFromFormat ( string $format , string $time [, DateTimeZone $timezone = date_default_timezone_get() ] )
      public static array getLastErrors ( void )
      public DateTime modify ( string $modify )
      public static DateTime __set_state ( array $array )
      public DateTime setDate ( int $year , int $month , int $day )
      public DateTime setISODate ( int $year , int $week [, int $day = 1 ] )
      public DateTime setTime ( int $hour , int $minute [, int $second = 0 ] )
      public DateTime setTimestamp ( int $unixtimestamp )
      public DateTime setTimezone ( DateTimeZone $timezone )
      public DateTime sub ( DateInterval $interval )
      public DateInterval diff ( DateTimeInterface $datetime2 [, bool $absolute = false ] )
      public string format ( string $format )
      public int getOffset ( void )
      public int getTimestamp ( void )
      public DateTimeZone getTimezone ( void )
      public __wakeup ( void )
}
```

A classe nos fornece alguns tipos de datas padr�o para serem usados como constantes.

DateTime::ATOM
DATE_ATOM
->Atom (exemplo: 2005-08-15T15:52:01+00:00) 

DateTime::COOKIE
DATE_COOKIE
->Cookies HTTP (exemplo: Monday, 15-Aug-2005 15:52:01 UTC) 

DateTime::ISO8601
DATE_ISO8601
->ISO-8601 (exemplo: 2005-08-15T15:52:01+0000)
> Nota: Este formato n�o � compat�vel com a ISO-8601, mas foi deixado desta forma por raz�es relacionadas a retrocompatibilidade. Ao inv�s, use as constantes DateTime::ATOM ou DATE_ATOM para compatibilidade com a ISO-8601. 

DateTime::RFC822
DATE_RFC822
->RFC 822 (exemplo: Mon, 15 Aug 05 15:52:01 +0000) 

DateTime::RFC850
DATE_RFC850
->RFC 850 (exemplo: Monday, 15-Aug-05 15:52:01 UTC) 

DateTime::RFC1036
DATE_RFC1036
->RFC 1036 (exemplo: Mon, 15 Aug 05 15:52:01 +0000) 

DateTime::RFC1123
DATE_RFC1123
->RFC 1123 (exemplo: Mon, 15 Aug 2005 15:52:01 +0000) 

DateTime::RFC2822
DATE_RFC2822
->RFC 2822 (exemplo: Mon, 15 Aug 2005 15:52:01 +0000) 

DateTime::RFC3339
DATE_RFC3339
->Same as DATE_ATOM (since PHP 5.1.3) 

DateTime::RSS
DATE_RSS
->RSS (exemplo: Mon, 15 Aug 2005 15:52:01 +0000) 

DateTime::W3C
DATE_W3C
->World Wide Web Consortium (exemplo: 2005-08-15T15:52:01+00:00) 

> Nota: Os autores do livro "Descomplicando a Certifica��o PHP" recomendam que se tenha em mente essas constantes do DateTime para a prova de certifica��o

Uma inst�ncia de DateTime pode ser iniciada das duas formas:
```php
public DateTime::__construct ([ string $time = "now" [, DateTimeZone $timezone = NULL ]] ) //Orientado a Objeto
DateTime date_create ([ string $time = "now" [, DateTimeZone $timezone = NULL ]] ) //Procedural
```
Onde $time � a string de data/hora e $timezone � um objeto DateTimeZone indicando o fuso hor�rio do par�metro $time (se ocultado usa o fuso hor�rio atual. Este �ltimo par�metro � ignorado caso $time seja uma timestamp UNIX ou contenha informa��o de fuso hor�rio

```php
<?php
//Orientado a Objeto
try {
    $date = new DateTime('2016-01-11');
} catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
}
echo $date->format('Y-m-d');

//Procedural
$date = date_create('2016-01-11');
if (!$date) {
    $e = date_get_last_errors();
    foreach ($e['errors'] as $error) {
        echo "$error\n";
    }
    exit(1);
}
echo date_format($date, 'Y-m-d');
```

Caso eu queira alterar a data com acr�scimo ou subtra��o, devo usar o seguinte m�todo
```php
public DateTime DateTime::add ( DateInterval $interval )
DateTime date_add ( DateTime $object , DateInterval $interval )
```
Onde $interval � um objeto DateInterval, especificado logo abaixo:

```php
DateInterval {
  /* Propriedades */
  public inteiro $y ; //Ano
  public inteiro $m ; //m�s
  public inteiro $d ; //dia
  public inteiro $h ; //hora
  public inteiro $i ; //minutos
  public inteiro $s ; //segundos
  public inteiro $invert ; //Se for intervalo negativo, o valor ser� 1. Caso contr�rio, ser� 0
  public mixto $days ; //Se este objeto for criado por DateTime::diff, retorna o n�mero de dias entre a data inicial e final, sen�o retorna FALSE
  /* M�todos */
  public __construct ( string $interval_spec )
  public static DateInterval createFromDateString ( string $time )
  public string format ( string $format )
}
```

No nosso caso temos que nos atentar � forma como devemos instanciar esse objeto para usarmos em DateTime::add. O construtor aceita uma string cujo formato inicia com "P" seguida de n�meros inteiros e caracteres designadores de per�odos. Caso haja elementos de tempo, essa por��o deve ser precedida por "T".
Exemplo: P2D = 2 dias, PT7S = 7 segundos, P4YT16H = 4 anos e 16 horas

|Designador de Per�odo| 	Descri��o|
|---------------------|------------|
|Y 	|anos|
|M 	|meses|
|D 	|dias|
|W 	|semanas. Essa � convertida em dias, portanto n�o pode ser combinada com D.|
|H 	|horas|
|M 	|minutos|
|S 	|segundos|

Assim segue exemplo de DateTime:add
```php
<?
$hoje = new DateTime();
$amanha = $hoje->add(new DateInterval('P1D'));
```

� importante notar que a vari�vel $hoje no exemplo acima, caso seja impressa, vai exibir o valor da vari�vel $amanha, pois ela foi alterada com o m�todo add. Para evitar isso, podemos instanciar pela classe DateTimeImmutable, que possui os mesmos m�todos mas com outro comportamento, n�o alterando a data original.

> Nota: � importante se atentar a DateTimeImmutable, pois essa classe foi introduzida no PHP 5.5.0, sendo provavelmente um assunto essencial para a prova

EXERCICIO: [LINK](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/datetime/datetime_ex2.php)

Podemos definir data e tempo num objeto DateTime atrav�s das fun��es setDate e setTime.
```php
public DateTime DateTime::setDate ( int $year , int $month , int $day )
DateTime date_date_set ( DateTime $object , int $year , int $month , int $day )

public DateTime DateTime::setTime ( int $hour , int $minute [, int $second = 0 ] )
DateTime date_time_set ( DateTime $object , int $hour , int $minute [, int $second = 0 ] )
```

Lembrando que no caso de DateTimeImmutable os valores n�o s�o alterados.

Exemplo:
```php
<?php
$hoje = new DateTime();
$hoje->setDate(1990,12,25);
echo 'Hoje: '.$hoje->format('d/m/Y') . '<br/>'; //25/12/1990

$hoje2 = new DateTimeImmutable();
$hoje2->setDate(1990,12,25);
echo 'Hoje2: '.$hoje2->format('d/m/Y') . '<br/>'; //07/07/2016
```

Al�m de add, podemos tamb�m manipular datas com os m�todos sub e modify:
```php
public DateTime DateTime::sub ( DateInterval $interval )
DateTime date_sub ( DateTime $object , DateInterval $interval )

public DateTime DateTime::modify ( string $modify )
DateTime date_modify ( DateTime $object , string $modify )
```

No caso de modify, a string � um formato bem mais leg�vel por indicar exatamente o quanto queremos somar/subtrair e a unidade.

Exemplo sub:
```php
<?php
$date = new DateTime('2016-01-11');
$date->sub(new DateInterval('P10D'));
echo $date->format('Y-m-d') . "\n";
```

Exemplo modify:
```php
<?php
$date = date_create('2016-07-07');
$date->modify('+1 day');
echo $date->format('Y-m-d');
```
EXERCICIO: [LINK](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/datetime/datetime_ex3.php)

Podemos obter o intervalo (DateInterval) entre duas datas com DateTime::diff
```php
public DateInterval DateTime::diff ( DateTimeInterface $datetime2 [, bool $absolute = false ] )
```

Exemplo:
```php
<?php
$datetime1 = new DateTime('2009-10-11');
$datetime2 = new DateTime('2009-10-13');
$interval = $datetime1->diff($datetime2);
echo $interval->format('%R%a days'); //+2 days
```

> Nota: � poss�vel usar operadores de compara��o em objetos DateTime. Ex. $dateTimeObj1 == $dateTimeObj2

Caso seja preciso lidar com fuso hor�rio, podemos recorrer � classe DateTimeZone
```php
DateTimeZone {
    /* Constantes */
      const integer AFRICA = 1 ;
      const integer AMERICA = 2 ;
      const integer ANTARCTICA = 4 ;
      const integer ARCTIC = 8 ;
      const integer ASIA = 16 ;
      const integer ATLANTIC = 32 ;
      const integer AUSTRALIA = 64 ;
      const integer EUROPE = 128 ;
      const integer INDIAN = 256 ;
      const integer PACIFIC = 512 ;
      const integer UTC = 1024 ;
      const integer ALL = 2047 ;
      const integer ALL_WITH_BC = 4095 ;
      const integer PER_COUNTRY = 4096 ;
    /* M�todos */
      public __construct ( string $timezone )
      public array getLocation ( void )
      public string getName ( void )
      public int getOffset ( DateTime $datetime )
      public array getTransitions ([ int $timestamp_begin [, int $timestamp_end ]] )
      public static array listAbbreviations ( void )
      public static array listIdentifiers ([ int $what = DateTimeZone::ALL [, string $country = NULL ]] )
}
```
Embora tenhamos um fuso hor�rio definido no php.ini em date.timezone, o qual ser� usado caso n�o seja informado no construtor de DateTime, podemos definir um fuso hor�rio para cada objeto DateTime.

```php
<?php
$saoPaulo = new DateTime('now',new DateTimeZone('America/Sao_Paulo'));
echo $saoPaulo->format('d/m/Y H:m:s');
echo $saoPaulo->getTimeZone()->getName();
```

Por fim, podemos obter o Unix Timestamp ou criar a partir de um formato nosso.
```php
public int DateTime::getTimestamp ( void )
public static DateTime DateTime::createFromFormat ( string $format , string $time [, DateTimeZone $timezone = date_default_timezone_get() ] )
```

Exemplo:
```php
<?php
$date = new DateTime();
echo $date->getTimestamp();

$date = DateTime::createFromFormat('d/m/Y', '07/07/2016');
echo $date->format('Y-m-d');
```
EXERCICIO: [LINK](https://github.com/lisura/php_certification/blob/master/Questoes/DATA_FORMAT/datetime/datetime_ex4.php)