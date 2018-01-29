<?php
namespace Newfinder\Helpers;

class StrHelper
{
    /**
     * @param            $name
     * @param bool|false $firstLower
     *
     * @return string
     */
    public function camelize($name, $firstLower = false)
    {
        $result = implode('', array_map('ucfirst', explode('_', $name)));
        if ($firstLower) {
            $result = lcfirst($result);
        }
        return $result;
    }

    /**
     * Возвращает правильный падеж фразы, в зависимости от числа.
     * Числа могут быть любого порядка, анализируются только 2 последние цифры.
     * Например, нужно вернуть правильную фразу "N объявления",
     *            где N - переменное число.
     *            $number = N,
     *            $cases = ['объявление', 'объявления', 'объявлений', 'объявление']
     *
     * @param integer $number - число
     * @param array $cases
     *                            0 => string, // если N = 1
     *                            1 => string, // если N от 2 до 4
     *                            2 => string, // если N от 5 до 20
     *                            3 => string, // если N > 20 и заканчивается на 1 (21, 31)
     *
     * @param bool $withNumber - вернуть фразу с числом или без.
     *
     * @return string
     */
    public function numberTransitions($number, array $cases, $withNumber = true)
    {
        $number = (int)$number;
        $showNumber = $number;
        if ($number > 99) {
            $number = (string)$number;
            $number = (int)(substr($number, strlen($number) - 2));
        }
        if ($number === 0) {
            $phraseKey = 2;
        } elseif ($number === 1) {
            $phraseKey = 0;
        } elseif ($number < 5) {
            $phraseKey = 1;
        } elseif ($number < 21) {
            $phraseKey = 2;
        } else {
            $check = (string)$number;
            $check = (int)(substr($check, strlen($check) - 1));
            if ($check === 0) {
                $phraseKey = 2;
            } elseif ($check === 1) {
                $phraseKey = 3;
            } elseif ($check < 5) {
                $phraseKey = 1;
            } else {
                $phraseKey = 2;
            }
        }
        if (!$withNumber) {
            $showNumber = '';
        } else {
            $showNumber .= '&nbsp;';
        }
        return $showNumber . $cases[$phraseKey];
    }

    /**
     * Proxy shortening method for numberTransitions.
     *
     * @param           $number
     * @param array $cases
     * @param bool|true $withNumber
     *
     * @return string
     */
    public function trans($number, array $cases, $withNumber = true)
    {
        return $this->numberTransitions($number, $cases, $withNumber);
    }

    /**
     * Proxy shortening method for numberTransitions.
     *
     * @param           $number
     * @param array $cases
     * @param bool|true $withNumber
     *
     * @return string
     */
    public static function transNum($number, array $cases, $withNumber = true)
    {
        return (new StrHelper())->numberTransitions($number, $cases, $withNumber);
    }

    /**
     * @param $str
     *
     * @return string
     */
    public function ucfirst($str)
    {
        if ($str) {
            $str = mb_strtoupper(mb_substr($str, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($str, 1, null, 'UTF-8');
        }
        return $str;
    }

    /**
     * Транслитирирует строку
     *
     * @param string $str - строка
     *
     * @return string
     */
    public function translit($str)
    {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => '', 'ы' => 'y', 'ъ' => '',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
        );
        return strtr($str, $converter);
    }

    public function makeUrl($str)
    {
        return trim(preg_replace('~[^-a-z0-9_]+~u', '-', mb_strtolower($this->translit($str), 'UTF-8')), "-");
    }

    public function to_prepositional($str)
    {	
	    
        $result = "";
        $postfix = array("г.");
	    $replace = array(                      
            'лев' => 'леве', 
            'ия' => 'ии',
            'ий' => 'ом',
            'ое' => 'ом',
            'ая' => 'ой',
            'ль' => 'ле', 
            'ев' => 'евом',
            'ый' => 'ом',
            'обл.' => 'области',
            'а' => 'е',
            'о' => 'o',
            'и' => 'ах',
            'ы' => 'ах',
            'ь' => 'и',
            'д' => 'де',
            'я' => 'е',
		'н' =>'не',
	'ие' => 'ии'         
        );

	
        $str = trim(str_replace($postfix, "", $str));
        $str_array = explode(" ", $str);
        foreach ($str_array as $key => $string) {
            foreach ($replace as $initial => $output) {
                        $length = mb_strlen($initial, 'UTF-8');
                        $str_length = mb_strlen($string, 'UTF-8');
                        $find = mb_substr($string, $str_length - $length, $str_length, 'UTF-8');
                        if($find == $initial){
                            $string = mb_substr($string, 0, $str_length - $length, 'UTF-8');
				            $result .=" ".$string.$output;
                            break 1;
                        }
                }

        }

        if(empty($result)){
            if ($find == 'е') {
		        return $str;
	        } else {
		        return $str.'е';
	        }
        }
        return $result;
    }

    public function abbr($str){
        $toAbbr = explode(' ', $str);
        foreach ($toAbbr as &$word)
        {
            $word = mb_substr($word, 0, 1, 'UTF-8');
        }
        $toAbbr = implode('',$toAbbr);
        return mb_strtoupper($toAbbr);
    }
}
