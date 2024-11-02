<?php
namespace App\Components;
use RuntimeException;
class TreeBuilder{

    /**
     * Summary of buildTree
     * @param array $elements
     * @param int $parentId
     * @return array
     */
    public static function buildTree(array $elements, int $parentId = 0, array &$visited = []):array {
        $branch = [];        
        if (isset($visited[$parentId])) {
            throw new RuntimeException('Loop detected in category hierarchy.');
        }        
        $visited[$parentId] = $parentId;

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {            
                $children = self::buildTree($elements, $element['categories_id'], $visited);
                if ($children) {
                    $branch[$element['categories_id']] = $children;
                }else{
                    $branch[$element['categories_id']] = $element['categories_id'];
                }
            }
        }

        return $branch;
    }
}