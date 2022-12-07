<?php
namespace G3n0s\BlogManager\Model;
class Blog extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const NOROUTE_ENTITY_ID = 'no-route';
    const ENTITY_ID = 'entity_id';
    const CACHE_TAG = 'G3n0s_blogmanager_blog';
    protected $_cacheTag = 'G3n0s_blogmanager_blog';
    protected $_eventPrefix = 'G3n0s_blogmanager_blog';
    
    public function _construct()
    {
        $this->_init(\G3n0s\BlogManager\Model\ResourceModel\Blog::class);
    }
    
    public function load($id, $field = null)
    {
        if ($id === null) {
            return $this->noRoute();
        }
        return parent::load($id, $field);
    }
    
    public function noRoute()
    {
        return $this->load(self::NOROUTE_ENTITY_ID, $this->getIdFieldName());
    }
    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }   
    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }
}