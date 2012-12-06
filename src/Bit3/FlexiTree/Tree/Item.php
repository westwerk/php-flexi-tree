<?php

/**
 * FlexiTree
 *
 * @package FlexiTree
 * @author  Tristan Lins <tristan.lins@bit3.de>
 * @link    http://bit3.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Bit3\FlexiTree\Tree;

use Model;

/**
 * Class Item
 *
 *
 * @package FlexiTree
 * @author  Tristan Lins <tristan.lins@bit3.de>
 * @link    http://bit3.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */
class Item
{
    /**
     * The data model for this item.
     *
     * @var object
     */
    protected $data;

    /**
     * Type of the item.
     *
     * @var string
     */
    protected $type;

    /**
     * Label of the item.
     *
     * @var string
     */
    protected $label = null;

    /**
     * Title of the item.
     *
     * @var string
     */
    protected $title = null;

    /**
     * URL of the item.
     *
     * @var string
     */
    protected $url = null;

    /**
     * Position as positive float, starting at 0.
     *
     * @var float
     */
    protected $position = null;

    /**
     * The item is in trail.
     *
     * @var bool
     */
    protected $trail = false;

    /**
     * The item is active.
     *
     * @var bool
     */
    protected $active = false;

    /**
     * The parent item or <em>null</em> if there is no parent item.
     *
     * @var null|Item
     */
    protected $parent = null;

    /**
     * Additional attributes.
     *
     * @var array
     */
    protected $attributes = array();

    /**
     * List of children.
     *
     * @var ItemCollection
     */
    protected $children;

    /**
     * Create new item.
     */
    function __construct($label, $url, $data = null, $type = null)
    {
        $this->label = $label;
        $this->url   = $url;
        $this->data  = $data;

        if ($type !== null) {
            $this->type = $type;
        }
        else {
            $this->type = get_class($data);
        }

        $this->children = new ItemCollection();
    }

    /**
     * @return object
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = (string) $label;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = is_null($title) ? null : (string) $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = (string) $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param float $position
     */
    public function setPosition($position)
    {
        $this->position = is_null($position) ? null : (float) $position;
    }

    /**
     * @return float|null
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param boolean $trail
     */
    public function setTrail($trail)
    {
        $this->trail = $trail;
    }

    /**
     * @return boolean
     */
    public function getTrail()
    {
        return $this->trail;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set an attribute.
     *
     * @param string $name
     * @param mixed  $value
     */
    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Get an attribute.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getAttribute($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }
        return null;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param \Bit3\FlexiTree\Tree\Item|null $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return \Bit3\FlexiTree\Tree\Item|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param ItemCollection $children
     */
    public function setChildren(ItemCollection $children)
    {
        $this->children = $children;

        foreach ($this->children as $children) {
            $children->setParent($this);
        }
    }

    /**
     * @return ItemCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add a new item.
     *
     * @param Item $child
     */
    public function addChildren(Item $children)
    {
        $this->children->add($children);
        $children->setParent($this);
    }

    /**
     * Add a new item.
     *
     * @param Item $child
     */
    public function addChildrens(array $childrens)
    {
        $this->children->addAll($childrens);

        foreach ($childrens as $children) {
            $children->setParent($this);
        }
    }

    /**
     * @return string
     */
    function __toString()
    {
        return sprintf(
            '%s (%s)',
            $this->label,
            $this->url
        );
    }
}