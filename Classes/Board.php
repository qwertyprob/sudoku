<?php

namespace Classes;

class Board
{
    private static $errorCounter = 0;
    private static $board = [
    //первый 3x3
    [ 7,0,0, 0,5,0, 6,0,0 ],
    [ 0,0,8, 9,0,0, 0,5,7 ],
    [ 0,0,0, 4,0,0 ,0,0,0 ],
    //второй 3х3
    [ 0,8,5, 0,2,0, 0,0,1 ],
    [ 0,6,0, 1,0,8, 0,3,0 ],
    [ 4,0,0, 0,9,0 ,7,6,0 ],
    //третий 3х3
    [ 0,0,0, 0,0,2, 0,0,0 ],
    [ 5,1,0, 0,0,9, 2,0,0 ],
    [ 0,0,2, 0,3,0 ,0,0,9 ]
];
    private static array $initBoard;
    private static bool $initialized = false;
    private static function staticConstructor() {
        if (!self::$initialized) {
            self::$initBoard = self::$board;
            self::$initialized = true;
        }
    }

    private function __construct() {
    }
    public static function getBoard()
    {
        return self::$board;
    }

    public static function setBoard($board)
    {
        self::$board = $board;
    }

    public static function getErrorCounter()
    {
        return self::$errorCounter;
    }

    public static function printBoard(){

        echo "\n\t----------|-----------|----------";
        for($i = 0; $i < 9; $i++){
            if($i % 3 == 0 && $i != 0)
                echo "\n\t----------|-----------|----------";
            echo "\n";
            for($j = 0; $j < 9; $j++){
                $value = self::$board[$i][$j];

                if($value == 0)
                    $value = ".";

                if($j % 3 == 0 & $j != 0)
                    echo " | ".$value;
                else{
                    echo "\t".$value;
                }
            }

        }
        echo "\n\t----------|-----------|----------";

    }
    public static function insertValue($row, $col, $value){

        self::staticConstructor();

        if($value < 1 || $value > 9){
            self::addError("Число должно быть от 1 до 9!");
            return;
        }

        if($row < 1 || $col < 1 || $row > 9 || $col > 9)
        {
            self::addError("Строка и колонка должны быть от 1 до 9!");
            return;
        }

        if(self::checkInitNumber($row,$col,$value)){
            self::addError("Клетка исходная, менять нельзя!");
            return;
        }

        if(!self::checkInCube($row,$col,$value) ||
            !self::checkRow($row,$col,$value) ||
            !self::checkColumn($row,$col,$value)){
            return;
        }



        self::$board[$row-1][$col-1] = $value;
        echo "\n\033[32mИнформация:\033[0m Вы успешно вставили цифру!\n";
    }
    private static function addError($message){
        self::$errorCounter++;
        echo "\n\033[31mОшибка: \033[0m$message";
    }

    private static function checkInCube($row,$col,$value)
    {
        $startRow = intdiv($row - 1, 3) * 3;
        $startCol = intdiv($col - 1, 3) * 3;

        for ($i = $startRow; $i < $startRow + 3; $i++) {
            for ($j = $startCol; $j < $startCol + 3; $j++) {
                if (self::$board[$i][$j] == $value) {
                    echo "\n\033[31mОшибка: \033[0m В этом 3x3 кубике уже есть $value!";
                    //Увеличиваем кол-во ошибок
                    self::$errorCounter++;
                    return false;
                }
            }
        }
        return true;

    }
    private static function checkRow($row,$col,$value){

        for($i = 0; $i < 9; $i++){
            if(self::$board[$row-1][$i] == 0)
                continue;

            if(self::$board[$row-1][$i] == $value){
                echo "\n\033[31mОшибка: \033[0m";
                echo "Ваша цифра не может быть здесь! Проверка по строке 1 - 9";

                //Увеличиваем кол-во ошибок
                self::$errorCounter++;

                return false;
            }
        }
        return true;
    }
    private static function checkColumn($row,$col,$value){
        for($i = 0; $i < 9; $i++){
            if(self::$board[$i][$col - 1] == 0)
                continue;

            if(self::$board[$i][$col - 1] == $value){
                echo "\n\033[31mОшибка: \033[0m";
                echo "Ваша цифра не может быть здесь! Проверка по столбцу 1 - 9";

                //Увеличиваем кол-во ошибок
                self::$errorCounter++;

                return false;
            }
        }
        return true;
    }

    private static function checkInitNumber($row,$col,$value)
    {
        if(self::$board[$row-1][$col-1] == 0)
            return false;

        if(self::$board[$row-1][$col-1] == self::$initBoard[$row-1][$col-1]){
            return true;
        }





        return false;


    }




}