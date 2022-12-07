<?php
namespace G3n0s\BlogManager\Model\ResourceModel\Comment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    
    public function _construct()
    {
        $this->_init(
            \G3n0s\BlogManager\Model\Comment::class,
            \G3n0s\BlogManager\Model\ResourceModel\Comment::class
        );
        $this->_map['fields']['entity_id'] = 'main_table.entity_id';
    }
}