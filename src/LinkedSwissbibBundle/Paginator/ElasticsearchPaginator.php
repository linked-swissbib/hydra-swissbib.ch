<?php

namespace LinkedSwissbibBundle\Paginator;
use ApiPlatform\Core\DataProvider\PaginatorInterface;
use \Iterator;

class ElasticsearchPaginator implements PaginatorInterface, Iterator
{

    private $response;
    private $current = 0;
    private $page;
    private $resources;
    private $itemsPerPage = 8;

    public function __construct(array $response, array $resources, int $page = 0)
    {
        $this->response = $response;
        $this->resources = $resources;
        $this->page = $page;
       // var_dump($this->response);
       // var_dump($this->resources);
        exit;
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
        return $this->getTotalItems()/8;
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
        return $this->response->getTotal()/8;
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->response->getHits()[$this->current];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
        public function next()
    {
        ;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return 0;
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
        return true;
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
