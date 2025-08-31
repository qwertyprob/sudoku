<?php

namespace Classes;
use Classes\Board;

class Console
{
    private static $endFlag = false;
    public static function startGame()
    {

        echo "Добро пожаловать в игру Судоку в консоль!\n";
        echo "\nВведите 'start', чтобы начать игру: ";
        $message = readline();

        if (strtolower(trim($message)) === "start") {

            echo "\nИзначальная таблица:";
            Board::printBoard();
            self::startInserting();
        }
        else
        {
            echo "\nВы не начали игру. Введите start!";
        }




    }

    private static function startInserting()
    {
        while(!self::$endFlag)
        {
            echo "\nВведите строку, колонку и число:\n";
            echo "Строка:";
            $row = readline();

            if($row === "end"){
                self::$endFlag = true;
                return;
            }
            echo "Колонка:";
            $col = readline();
            echo "Число:";
            $value = readline();

            Board::insertValue($row, $col, $value);
            echo "\n";
            Board::printBoard();
        }

    }
}