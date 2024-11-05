<?php
use PHPUnit\Framework\TestCase;
use App\Components\TreeBuilder;

class TreeBuilderTest extends TestCase{
    public function testBuildTreeWithLoop()
    {
        $elements = [
            ['categories_id' => 1, 'parent_id' => 0],
            ['categories_id' => 2, 'parent_id' => 0],
            ['categories_id' => 3, 'parent_id' => 5],
            ['categories_id' => 4, 'parent_id' => 3],
            ['categories_id' => 5, 'parent_id' => 4],           
            ['categories_id' => 6, 'parent_id' => 1], 
            ['categories_id' => 7, 'parent_id' => 6], 
            ['categories_id' => 8, 'parent_id' => 3],
            ['categories_id' => 5, 'parent_id' => 1]
        ];

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Loop detected in category hierarchy.');

        TreeBuilder::buildTree(elements: $elements);
    }


    public function testBuildTreeSuccess()
    {
        $elements = [
            ['categories_id' => 1, 'parent_id' => 0],
            ['categories_id' => 14, 'parent_id' => 1],
            ['categories_id' => 1030, 'parent_id' => 14],
            ['categories_id' => 18, 'parent_id' => 1],
            ['categories_id' => 30, 'parent_id' => 1],
            ['categories_id' => 36, 'parent_id' => 1],
            ['categories_id' => 1094, 'parent_id' => 36],
            ['categories_id' => 1455, 'parent_id' => 36],
            ['categories_id' => 1524, 'parent_id' => 36],
            ['categories_id' => 1678, 'parent_id' => 36],

        ];

        $expected = [
            1 => [
                14 => [
                    1030 => 1030
                ],
                18 => 18,
                30 => 30,
                36 => [
                    1094 => 1094,
                    1455 => 1455,
                    1524 => 1524,
                    1678 => 1678,
                ]
            ]  
        ];

        $result = TreeBuilder::buildTree(elements: $elements);
        $this->assertEquals($expected, $result);
    }

}