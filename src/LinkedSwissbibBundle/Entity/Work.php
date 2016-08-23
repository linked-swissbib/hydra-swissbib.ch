<?php
/**
 * Created by PhpStorm.
 * User: Melanie
 * Date: 16.08.2016
 * Time: 11:35
 */

namespace LinedSwissbibBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A work.
 *
 * @see http://bibframe.org/vocab/Work
 *
 * @ApiResource(
 *     iri="http://bibframe.org/vocab/Work",
 *     itemOperations={
 *          "get":{"method":"GET"}
 *     },
 *     collectionOperations={
 *          "get":{"method":"GET"}
 *     }
 * )
 */
class Work
{
    /**
     * @var string | array
     *
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://bibframe.org/vocab/hasInstance");
     *
     */
    private $hasInstance;

    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/contributor");
     *
     */
    private $contributor;

    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/title");
     *
     */
    private $title;

    /**
     * Work constructor.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->id = $response['_id'];
        $this->context = $response['_source'];
        $this->type = $response['_source'];
        $this->hasInstance = $response['_source']['bf:hasInstance'] ?? null;
        $this->contributor = $response['_source']['dct:contributor']?? null;
        $this->title = $response['_source']['dct:title'] ?? null;
    }

    /**
     * @return string | array
     */
    public function geId()
    {
        return $this->id;
    }

    /**
     * @return string | array
     */
    public function getHasInstance()
    {
        return $this->hasInstance;
    }

    /**
     * @return string | array
     */
    public function getContributor()
    {
        return $this->contributor;
    }

    /**
     * @return string | array
     */
    public function getTitle()
    {
        return $this->title;
    }
}
