<?php
namespace App\Model;

class Product {
    private string $productId;
    private string $title;
    private ?string $subtitle;
    private string $image;
    private string $thumbnail;
    private array $category;
    private string $url;
    private ?string $upc;
    private ?string $gtin14;
    private \DateTime $createdAt;
    private Brand $brand;

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     * @return Product
     */
    public function setProductId(string $productId): Product
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Product
     */
    public function setTitle(string $title): Product
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    /**
     * @param string|null $subtitle
     * @return Product
     */
    public function setSubtitle(?string $subtitle): Product
    {
        $this->subtitle = $subtitle;
        return $this;
    }



    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Product
     */
    public function setImage(string $image): Product
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * @param string $thumbnail
     * @return Product
     */
    public function setThumbnail(string $thumbnail): Product
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategory(): array
    {
        return $this->category;
    }

    /**
     * @param array $category
     * @return Product
     */
    public function setCategory(array $category): Product
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Product
     */
    public function setUrl(string $url): Product
    {
        $this->url = $url;
        return $this;
    }



    /**
     * @return string|null
     */
    public function getGtin14(): ?string
    {
        return $this->gtin14;
    }

    /**
     * @param string|null $gtin14
     * @return Product
     */
    public function setGtin14(?string $gtin14): Product
    {
        $this->gtin14 = $gtin14;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Product
     */
    public function setCreatedAt(\DateTime $createdAt): Product
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     * @return Product
     */
    public function setBrand(Brand $brand): Product
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpc(): ?string
    {
        return $this->upc;
    }

    /**
     * @param string|null $upc
     * @return Product
     */
    public function setUpc(?string $upc): Product
    {
        $this->upc = $upc;
        return $this;
    }


}