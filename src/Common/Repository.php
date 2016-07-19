<?php

namespace vedebel\directv5\Common;

use vedebel\directv5\Campaign\Properties\TextCampaign\BiddingStrategy\Search;
use vedebel\directv5\Client;

/**
 * Class Repository
 * @package vedebel\directv5\Common
 */
abstract class Repository
{
    /**
     *
     */
    const ENDPOINT = null;

    /**
     *
     */
    const ALLOWED_ACTIONS = [];

    /**
     * @var Client
     */
    protected $client;

    /**
     * Repository constructor.
     * @param Client $client
     */
    final public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param Selector $selector
     * @param SelectionCriteria $criteria
     * @param Pagination $pagination
     * @return Collection
     * @throws ApiException
     * @throws Exceptions\PointsShortageException
     * @throws RequestApiException
     */
    public function get(Selector $selector, SelectionCriteria $criteria = null, Pagination $pagination = null) : Collection
    {
        $data = [];

        if ($criteria) {
            $data['SelectionCriteria'] = $criteria;
        }

        foreach ($selector as $selectProperty => $selectValue) {
            $data[$selectProperty] = $selectValue;
        }

        if ($pagination) {
            $data['Page'] = $pagination;
        }

        $getResults = $this->client->request(static::ENDPOINT, 'get', $data);

        $collectionItems = [];

        foreach ($getResults['collection'] as $getResult) {
            $collectionItems[] = $this->createCollectionItem($getResult);
        }

        if ($pagination) {
            $hasNext = !empty($getResults['hasNextPage']);
            $pagination->setHasNext($hasNext);
        }

        $collection = $this->getCollection();
        $collection->addMany($collectionItems);

        return $collection;
    }

    /**
     * @param Collection $collection
     * @return Collection
     * @throws ApiException
     * @throws RequestApiException
     */
    public function add(Collection $collection) : Collection
    {
        $addResults = $this->client->request(static::ENDPOINT, 'add', [
            $collection->getId() => $collection
        ]);

        foreach ($addResults['collection'] as $index => $addedItem) {
            if (isset($collection[$index])) {
                if (!empty($addedItem->Id)) {
                    $collection[$index]->id = $addedItem->Id;
                }

                if (!empty($addedItem->Warnings)) {
                    $collection->setWarnings($index, $addedItem->Warnings);
                }

                if (!empty($addedItem->Errors)) {
                    $collection->setErrors($index, $addedItem->Errors);
                }
            }
        }

        return $collection;
    }

    /**
     * @param Collection $collection
     * @return Collection
     * @throws ApiException
     * @throws RequestApiException
     */
    public function update(Collection $collection) : Collection
    {
        $updateResults = $this->client->request(static::ENDPOINT, 'update', [
            $collection->getId() => $collection
        ]);

        foreach ($updateResults['collection'] as $index => $updatedItem) {
            if (!isset($collection[$index])) {
                continue;
            }

            $oldItem = $collection[$index];

            if (isset($updatedItem->Id) && $oldItem->id !== $updatedItem->Id) {
                $oldItem->id = $updatedItem->Id;
            }

            if (!empty($updatedItem->Warnings)) {
                $collection->setWarnings($index, $updatedItem->Warnings);
            }

            if (!empty($updatedItem->Errors)) {
                $collection->setErrors($index, $updatedItem->Errors);
            }
        }

        return $collection;
    }

    /**
     * @param SelectionCriteria $criteria
     * @return Collection
     */
    public function delete(SelectionCriteria $criteria) : Collection
    {
        return $this->process('delete', $criteria);
    }

    /**
     * @param $action
     * @param $processData
     * @return Collection
     * @throws ApiException
     * @throws Exceptions\PointsShortageException
     * @throws RequestApiException
     */
    public function process($action, $processData)
    {
        if ($processData instanceof Collection) {
            $processResults = $this->client->request(static::ENDPOINT, $action, [
                $processData->getId() => $processData
            ]);

            foreach ($processResults as $index => $processedItem) {
                if (!isset($processData[$index])) {
                    continue;
                }

                if (!empty($processedItem->Warnings)) {
                    $processData->setWarnings($index, $processedItem->Warnings);
                }

                if (!empty($processedItem->Errors)) {
                    $processData->setErrors($index, $processedItem->Errors);
                }
            }

            return $processData;
        } elseif ($processData instanceof SelectionCriteria) {
            $processResults = $this->client->request(static::ENDPOINT, $action, [
                'SelectionCriteria' => $processData
            ]);

            $collection = $this->getCollection();

            foreach ($processResults ['collection'] as $index => $getResult) {
                $item = $this->createCollectionItem($getResult);

                $collection->add($item);

                if (!empty($getResult->Errors)) {
                    $collection->setErrors($index, $getResult->Errors);
                }

                if (!empty($getResult->Warning)) {
                    $collection->setWarnings($index, $getResult->Warning);
                }
            }

            return $collection;
        }

        throw new \InvalidArgumentException('Second argument should be instance of Collection or SelectionCriteria.');
    }

    /**
     * Magic method that will invoke process method with specified operation
     * @param $name
     * @param $arguments
     *
     * @return Collection
     */
    public function __call($name, $arguments)
    {
        if (in_array($name, static::ALLOWED_ACTIONS)) {
            array_unshift($arguments, $name);
            return call_user_func_array([$this, 'process'], $arguments);
        }

        throw new \BadMethodCallException('Trying to call undefined method');
    }

    /**
     * @param \stdClass $data
     * @return Object
     */
    protected function createCollectionItem(\stdClass $data) : Object
    {
        $collectionItemClassName = str_replace('Repository', '', get_class($this));

        if (!class_exists($collectionItemClassName)) {
            throw new \UnexpectedValueException(sprintf('Class %s was not found', $collectionItemClassName));
        }

        return $collectionItemClassName::createFromStdObject($data);
    }

    /**
     * @return Collection
     */
    protected function getCollection() : Collection
    {
        $collectionClassName = str_replace('Repository', 'Collection', get_class($this));

        if (!class_exists($collectionClassName)) {
            throw new \UnexpectedValueException(sprintf('Collection with name %s was not found', $collectionClassName));
        }

        return new $collectionClassName;
    }
}