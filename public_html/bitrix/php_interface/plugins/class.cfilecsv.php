<?php

/**
 * Класс для работы с csv файлами
 * Created by PhpStorm.
 * User: Zakusilo
 * Date: 20.03.2017
 * Time: 10:38
 */
class CFileCSV
{
    var $VERSION = "1.01";

/** ------------------------------------------------------------
 * Функция парсера CSV-файла
 *------------------------------------------------------------
 * @param string $file_name - имя файла для парсинга
 * @param string $separator - разделитель полей, по умолчанию ';'
 * @param string $quote - ограничитель строк, по умолчанию '"'
 * @return array - массив значений всего файла
 * ------------------------------------------------------------
*/
    function getCSV ($file_name, $separator = ';', $quote = '"')
    {
        // Загружаем файл в память целиком
        $f = fopen($file_name, 'r');
        $str = fread($f, filesize($file_name));
        fclose($f);

        // Убираем символ возврата каретки
        $str = trim(str_replace("\r", '', $str)) . "\n";

        $parsed = Array();    // Массив всех строк
        $i = 0;               // Текущая позиция в файле
        $quote_flag = false;  // Флаг кавычки
        $line = Array();      // Массив данных одной строки
        $varr = '';           // Текущее значение

        while ($i <= strlen($str)) {
            // Окончание значения поля
            if ($str[$i] == $separator && !$quote_flag) {
                $varr = str_replace("\n", "\r\n", $varr);
                $line[] = $varr;
                $varr = '';
            } // Окончание строки
            elseif ($str[$i] == "\n" && !$quote_flag) {
                $varr = str_replace("\n", "\r\n", $varr);
                $line[] = $varr;
                $varr = '';
                $parsed[] = $line;
                $line = Array();
            } // Начало строки с кавычкой
            elseif ($str[$i] == $quote && !$quote_flag) {
                $quote_flag = true;
            } // Кавычка в строке с кавычкой
            elseif ($str[$i] == $quote && $str[($i + 1)] == $quote && $quote_flag) {
                $varr .= $str[$i];
                $i++;
            } // Конец строки с кавычкой
            elseif ($str[$i] == $quote && $str[($i + 1)] != $quote && $quote_flag) {
                $quote_flag = false;
            } else {
                $varr .= $str[$i];
            }
            $i++;
        }
        return $parsed;
    }

    function setCSV ($f, $list, $d = ",", $q = '"')
    {
        $line = "";
        foreach ($list as $field) {
            # remove any windows new lines,
            # as they interfere with the parsing at the other end
            $field = str_replace("\r\n", "\n", $field);
            # if a deliminator char, a double quote char or a newline
            # are in the field, add quotes
            if (preg_match("/[$d$q\n\r]/", $field)) {
                $field = $q . str_replace($q, $q . $q, $field) . $q;
            }
            $line .= $field . $d;
        }
        # strip the last deliminator
        $line = substr($line, 0, -1);
        # add the newline
        $line .= "\n";
        # we don't care if the file pointer is invalid,
        # let fputs take care of it
        return fputs($f, $line);
    }
}