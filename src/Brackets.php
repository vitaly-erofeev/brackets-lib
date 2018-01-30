<?php

namespace verofeev;
/**
 *
 * Класс провереят валидность скобок
 *
 */

class Brackets
{
	private $bracketsString;
	private $availableSymbols = [
		"(",
		")",
		" ",
		"\r",
		"\t",
		"\n",
	];

	function __construct($bracketsString)
	{
		$this->bracketsString = $bracketsString;
	}

	/**
	 *
	 * @return bool 
	 * провереят валидность выражения
	 *
	 */
	function validate()
	{
		$bracketsSymbols = preg_split('//', $this->bracketsString, -1, PREG_SPLIT_NO_EMPTY);
		if (!$this->checkSymbols($bracketsSymbols)) {
			throw new \InvalidArgumentException('Invalid symbols');
		}
		$validateCount = 0;
		foreach ($bracketsSymbols as $symbol) {
			if ($symbol == ")" && $validateCount == 0) {
				return false;
			} elseif ($symbol == "(") {
				$validateCount++;
			} elseif ($symbol == ")") {
				$validateCount--;
			}
		}
		return $validateCount==0;
	}

	/**
	 *
	 * @param $bracketsSymbols
	 * @return bool
	 * првоеряет корректность переданных символов
	 *
	 */
	function checkSymbols($bracketsSymbols){
		foreach ($bracketsSymbols as $symbol) {
			if (!in_array($symbol, $this->availableSymbols)) {
				return false;
			}
		}
		return true;
	}
}