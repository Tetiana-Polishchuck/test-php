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
}