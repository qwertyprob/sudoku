<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Classes\Board;

class BoardTest extends TestCase
{
    protected array $initBoard;

    protected function setUp(): void
    {
        $this->initBoard = [

            [ 7,0,0, 0,5,0, 6,0,0 ],
            [ 0,0,8, 9,0,0, 0,5,7 ],
            [ 0,0,0, 4,0,0 ,0,0,0 ],

            [ 0,8,5, 0,2,0, 0,0,1 ],
            [ 0,6,0, 1,0,8, 0,3,0 ],
            [ 4,0,0, 0,9,0 ,7,6,0 ],

            [ 0,0,0, 0,0,2, 0,0,0 ],
            [ 5,1,0, 0,0,9, 2,0,0 ],
            [ 0,0,2, 0,3,0 ,0,0,9 ]

        ];

        Board::setBoard($this->initBoard);
    }
    public function testErrorCounter()
    {
        Board::insertValue(2,5,9);



        $this->assertEquals(Board::getErrorCounter(), 1);


    }
    public function testInsertErrorDoesNotChangeBoard()
    {
        Board::insertValue(1,1,1);

        $this->assertEquals($this->initBoard, Board::getBoard());
    }

    public function testInsertValidValue()
    {
        Board::insertValue(1,2,3);

        $expected = $this->initBoard;
        $expected[0][1] = 3;

        $this->assertEquals($expected, Board::getBoard());
    }


}
