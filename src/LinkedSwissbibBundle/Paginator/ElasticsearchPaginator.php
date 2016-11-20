<?php

namespace LinkedSwissbibBundle\Paginator;

use ApiPlatform\Core\DataProvider\PaginatorInterface;
use ElasticsearchAdapter\Result\Result;
use \Iterator;

class ElasticsearchPaginator implements Iterator, PaginatorInterface
{

    private $response;
    private $current = 0;
    private $page;
    private $itemsPerPage;
    private $resources;

    public function __construct(Result $response, array $resources, int $itemsPerPage = 0, int $page = 1)
    {
        $this->response = $response;
        $this->page = $page;
        $this->itemsPerPage = $itemsPerPage;
        $this->resources = $resources;
    }

    /**
     * Gets the current page number.
     *
     * @return float
     */
    public function getCurrentPage() : float
    {
        return $this->page;
    }

    /**
     * Gets last page.
     *
     * @return float
     */
    public function getLastPage() : float
    {
        return ceil($this->getTotalItems() / $this->itemsPerPage);
    }

    /**
     * Gets the number of items by page.
     *
     * @return float
     */
    public function getItemsPerPage() : float
    {
        return $this->itemsPerPage;
    }

    /**
     * Gets the number of items in the whole collection.
     *
     * @return float
     */
    public function getTotalItems() : float
    {
        return $this->response->getTotal();
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->resources);
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        if ($this->current < count($this->resources)){
            return $this->resources[$this->current];
        }
        return null;
        //return $this->current;
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->current += 1;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->current();
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return $this->current < $this->count();
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->current = 0;
    }
}
