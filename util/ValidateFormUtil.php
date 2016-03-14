<?php
/**
*  Esta classe tem o objetivo de vericar o preenchimento de determinados campos de um formulario
*  no lado do Servidor.
*  Aqueles campos que tiverem problemas de preenchimento serao exibidos novamente
*
*  @author Bruno R. de Oliveira
*  @version 1.0
*  @copyright 2010 Bruno R. de Oliveira
*  @see http://br.php.net/manual/pt_BR/book.ctype.php , http://br.php.net/manual/pt_BR/function.filter-var.php
*/

class ValidationFormServer
{

      private $fields; #campos adicionados e suas respectivas mensagens
      private $fieldsRequired; #array com os campos que devem ser preenchidos
      private $fieldsEmail; #array com os campos que devem ter formato de e-mail
      private $fieldsEmailNull;
      private $fieldsAlphaNumeric; #array com os campos que devem ter formato Alfa-numéricos (letras e números)
      private $fieldsAlphaNumericNull;
      private $fieldsAlpha; #array com os campos que devem ter formato Alfa (somente letras)
      private $fieldsAlphaNull;
      private $fieldsNumeric; #array com os campos que devem ter formato numérico
      private $fieldsNumericNull;
      private $fieldsNull; #campos que não precisam ser preenchidos

      function __construct()
      {
            $this->fields = array();
            $this->fieldsRequired = array();
            $this->fieldsEmail = array();
            $this->fieldsEmailNull = array();
            $this->fieldsAlphaNumeric = array();
            $this->fieldsAlphaNumericNull = array();
            $this->fieldsAlpha = array();
            $this->fieldsAlphaNull = array();
            $this->fieldsNumeric = array();
            $this->fieldsNumericNull = array();
            $this->fieldsNull = array();
      }

      /**
       * Adiciona um metodo de verificacao
       * @param string $field = nome do campo no formulário
       * @param string $method = metodo de verificacao desta classe
       */
      public function setMethod($field, $method)
      {
            $this->fields[] = $field;
            $this->{'method' . $method}($field);
      }

      /**
       * Retorna os métodos de validação disponíveis
       * Será utilizado na classe TField
       *
       * @return array
       */
      static function getType()
      {
      	return array('Required', 'Email', 'EmailNull', 'AlphaNumeric', 'AlphaNumericNull', 'Alpha', 'AlphaNull', 'Numeric', 'NumericNull', 'Null');
      }

      /**
      * Adiciona ao Metodo de verificacao de preenchimento
      * @param string $field
      */
      private function methodNull($field)
      {
      	$this->fieldsNull[] = $field->getName();
      }

      /**
       * Adiciona ao Metodo de verificacao de preenchimento
       * @param string $field
       */
      private function methodRequired($field)
      {
            $this->fieldsRequired[] = $field->getName();
      }

      /**
       * Adiciona ao Metodo de verificacao de e-mail
       * @param string $field
       */
      private function methodEmail($field)
      {
      	$this->fieldsEmail[] = $field->getName();
      }

      /**
       * Adiciona ao Metodo de verificacao de e-mail mas que pode ser fazio
       * @param string $field
      */
      private function methodEmailNull($field)
      {
      	$this->fieldsEmailNull[] = $field->getName();
      }

      /**
       * Adiciona ao Metodo de verificacao anfanumurica
       * @param string $field
       */
      private function methodAlphaNumeric($field)
      {
      	$this->fieldsAlphaNumeric[] = $field->getName();
      }

      /**
       * Adiciona ao Metodo de verificacao anfanumurica
       * @param string $field
      */
      private function methodAlphaNumericNull($field)
      {
      	$this->fieldsAlphaNumericNull[] = $field->getName();
      }

      /**
      * Adiciona ao Metodo de verificacao Alpha
      * @param string $field
      */
      private function methodAlpha($field)
      {
      	$this->fieldsAlpha[] = $field->getName();
      }

      /**
       * Adiciona ao Metodo de verificacao Alpha
       * @param string $field
      */
      private function methodAlphaNull($field)
      {
      	$this->fieldsAlphaNull[] = $field->getName();
      }

      /**
       * Adiciona ao Metodo de verificacao numerica
       * @param string $field
       */
      private function methodNumeric($field)
      {
      	$this->fieldsNumeric[] = $field->getName();
      }

      /**
      * Adiciona ao Metodo de verificacao numerica
      * @param string $field
      */
      private function methodNumericNull($field)
      {
      	$this->fieldsNumericNull[] = $field->getName();
      }

      /**
       * Faz as checagens necessarias dos campos e retorna uma mensagem
       *
       * @return string
       */
      public function check($fieldName, $fieldValue)
      {

        //armazena as mensagens
      	$mensagens = "";

      	//checa os campos que devem ser preenchidos
      	if (in_array($fieldName, $this->fieldsRequired))
      	{
      		if (empty($fieldValue))
      		{
      			$mensagens .= 'O campo ' . $fieldName . ' deve ser preenchido!<br/>';
      		}
      	}

      	//checa os campos com formato de e-mail
      	if (in_array($fieldName, $this->fieldsEmail))
      	{
      		if (filter_var($fieldValue, FILTER_VALIDATE_EMAIL) === false)
      		{
      			$mensagens .= 'O campo ' . $fieldName . ' deve estar no formato nome@dominio.aaa!<br/>';
      		}
      	}

      	//checa os campos com formato de e-mail que pode estar vazio
      	if (in_array($fieldName, $this->fieldsEmailNull))
      	{
      		if ($fieldValue)
      		{
	      		if (filter_var($fieldValue, FILTER_VALIDATE_EMAIL) === false)
	      		{
	      			$mensagens .= 'O campo ' . $fieldName . ' deve estar no formato nome@dominio.aaa!<br/>';
	      		}
      		}
      	}

      	//checa os campos que devem ser alfanumericos
      	if (in_array($fieldName, $this->fieldsAlphaNumeric))
      	{
      		if (!ctype_alnum($fieldValue))
      		{
      			$mensagens .= 'O campo ' . $fieldName . ' deve conter letras ou n&uacute;meros!<br/>';
      		}
      	}

      	//checa os campos que devem ser alfanumericos que pode estar vazio
      	if (in_array($fieldName, $this->fieldsAlphaNumericNull))
      	{
      		if ($fieldValue)
      		{
	      		if (!ctype_alnum($fieldValue))
	      		{
	      			$mensagens .= 'O campo ' . $fieldName . ' deve conter letras ou n&uacute;meros!<br/>';
	      		}
      		}
      	}

      	//checa os campos que devem ser alfa (somente letras)
      	if (in_array($fieldName, $this->fieldsAlpha))
      	{
      		if (!ctype_alpha($fieldValue))
      		{
      			$mensagens .= 'O campo ' . $fieldName . ' deve conter apenas letras!<br/>';
      		}
      	}

      	//checa os campos que devem ser alfa (somente letras) que pode estar vazio
      	if (in_array($fieldName, $this->fieldsAlphaNull))
      	{
      		if ($fieldValue)
      		{
	      		if (!ctype_alpha($fieldValue))
	      		{
	      			$mensagens .= 'O campo ' . $fieldName . ' deve conter apenas letras!<br/>';
	      		}
      		}
      	}

      	//checa os campos que devem ser numericos
      	if (in_array($fieldName, $this->fieldsNumeric))
      	{
      		if (!ctype_digit($fieldValue))
      		{
      			$mensagens .= 'O campo ' . $fieldName . ' deve conter apenas n&uacute;meros!<br/>';
      		}
      	}

      	//checa os campos que devem ser numericos que pode estar vazio
      	if (in_array($fieldName, $this->fieldsNumericNull))
      	{
      		if ($fieldValue)
      		{
	      		if (!ctype_digit($fieldValue))
	      		{
	      			$mensagens .= 'O campo ' . $fieldName . ' deve conter apenas n&uacute;meros!<br/>';
	      		}
      		}
      	}

      	return $mensagens;
	}
}
?>
