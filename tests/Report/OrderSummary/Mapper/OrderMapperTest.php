<?php

namespace App\Tests\Report\OrderSummary\Mapper;

use App\Model\Customer;
use App\Report\OrderSummary\Mapper\OrderMapper;
use PHPUnit\Framework\TestCase;

class OrderMapperTest extends TestCase
{

    public function testMapFromArrayForOrderDetails()
    {
        $source = $this->getExampleOrder();
        $order = OrderMapper::mapFromArray($source);
        $this->assertEquals($source["order_id"], $order->getOrderId());
        $this->assertEquals($source["order_date"], $order->getOrderDate()->format("D, d M Y H:i:s O"));
        $this->assertEquals($source["shipping_price"], $order->getShippingPrice());
        $this->assertEquals($source["customer"]["first_name"], $order->getCustomer()->getFirstName());
        $this->assertEquals($source["customer"]["shipping_address"]["state"], $order->getCustomer()->getShippingAddress()->getState());
        $this->assertEquals(count($source["items"]), count($order->getItems()));
    }

    /**
     * @return array
     */
    public function getExampleOrder(): array
    {
        return [
            'order_id' => 1005,
            'order_date' => 'Fri, 08 Mar 2019 19:03:05 +0000',
            'customer' => [
                'customer_id' => 2712731,
                'first_name' => 'Shakira',
                'last_name' => 'Rutherford',
                'email' => 'shakira.rutherford@example.com',
                'phone' => '+61248056938',
                'shipping_address' => [
                    'street' => '27 DAY ST',
                    'postcode' => '6365',
                    'suburb' => 'KULIN',
                    'state' => 'WESTERN AUSTRALIA',
                ],
            ],
            'items' => [
                0 => [
                    'quantity' => 1,
                    'unit_price' => 24.99,
                    'product' => [
                        'product_id' => 3759666,
                        'title' => 'Adidas C40 3-Stripe Climalite Cap - Black',
                        'subtitle' => NULL,
                        'image' => 'https://s.catch.com.au/images/product/0018/18255/5c861117625c5461251384.jpg',
                        'thumbnail' => 'https://s.catch.com.au/images/product/0018/18255/5c861117625c5461251384_w200.jpg',
                        'category' => [
                            0 => 'SPORTS AND FITNESS',
                            1 => 'APPAREL - MENS',
                            2 => 'TRAINING',
                            3 => 'HAT',
                        ],
                        'url' => 'https://www.catch.com.au/product/adidas-c40-3-stripe-climalite-cap-black-3759666',
                        'upc' => '4059812357679',
                        'gtin14' => NULL,
                        'created_at' => '2019-03-04 10:31:11',
                        'brand' => [
                            'id' => 2837,
                            'name' => 'Adidas',
                        ],
                    ],
                ],
                1 => [
                    'quantity' => 6,
                    'unit_price' => 24.99,
                    'product' => [
                        'product_id' => 3627810,
                        'title' => 'Nautica Sea Horse Beach Towel - Multi',
                        'subtitle' => NULL,
                        'image' => 'https://s.catch.com.au/images/product/0017/17683/5c6cfba81296c631507437.jpg',
                        'thumbnail' => 'https://s.catch.com.au/images/product/0017/17683/5c6cfba81296c631507437_w200.jpg',
                        'category' => [
                            0 => 'HOME',
                            1 => 'TOWEL',
                            2 => 'ADULT TOWEL',
                            3 => 'BEACH TOWEL',
                        ],
                        'url' => 'https://www.catch.com.au/product/nautica-sea-horse-beach-towel-multi-3627810',
                        'upc' => '9319288570046',
                        'gtin14' => NULL,
                        'created_at' => '2019-02-04 17:15:01',
                        'brand' => [
                            'id' => 2835,
                            'name' => 'Nautica',
                        ],
                    ],
                ],
                2 => [
                    'quantity' => 1,
                    'unit_price' => 49.99,
                    'product' => [
                        'product_id' => 3484795,
                        'title' => 'Greenlund Workshop Creeper w/ 6 Wheels ',
                        'subtitle' => NULL,
                        'image' => 'https://s.catch.com.au/images/product/0016/16526/5c38548a5ab57936001621.jpg',
                        'thumbnail' => 'https://s.catch.com.au/images/product/0016/16526/5c38548a5ab57936001621_w200.jpg',
                        'category' => [
                            0 => 'TOOLS AND HARDWARE',
                            1 => 'TOOLS',
                            2 => 'TOOL ACCESSORIES',
                            3 => 'MULTIFUNCTION TOOL ACCESSORIES',
                        ],
                        'url' => 'https://www.catch.com.au/product/greenlund-workshop-creeper-w-6-wheels-3484795',
                        'upc' => '9345916105748',
                        'gtin14' => NULL,
                        'created_at' => '2019-01-08 10:21:39',
                        'brand' => [
                            'id' => 12737,
                            'name' => 'Greenlund',
                        ],
                    ],
                ],
                3 => [
                    'quantity' => 1,
                    'unit_price' => 24.99,
                    'product' => [
                        'product_id' => 3691979,
                        'title' => 'Honey Can Do 3-Tier All Purpose Household Cart',
                        'subtitle' => NULL,
                        'image' => 'https://s.catch.com.au/images/product/0019/19125/5cadbbd8f383e883700891.jpg',
                        'thumbnail' => 'https://s.catch.com.au/images/product/0019/19125/5cadbbd8f383e883700891_w200.jpg',
                        'category' => [
                            0 => 'HOME',
                            1 => 'LAUNDRY',
                            2 => 'LAUNDRY ACCESSORIES',
                            3 => 'STORAGE',
                        ],
                        'url' => 'https://www.catch.com.au/product/honey-can-do-3-tier-all-purpose-household-cart-3691979',
                        'upc' => '811434011490',
                        'gtin14' => NULL,
                        'created_at' => '2019-02-12 15:55:07',
                        'brand' => [
                            'id' => 7076,
                            'name' => 'Honey Can Do',
                        ],
                    ],
                ],
                4 => [
                    'quantity' => 6,
                    'unit_price' => 9.99,
                    'product' => [
                        'product_id' => 3577536,
                        'title' => '3 x Kayser Women\'s Luxe Delightfuls Xmas Cheeky Bikini - Red Foil',
                        'subtitle' => NULL,
                        'image' => 'https://s.catch.com.au/images/product/0017/17630/5c6b53c0b2b5a483321317.jpg',
                        'thumbnail' => 'https://s.catch.com.au/images/product/0017/17630/5c6b53c0b2b5a483321317_w200.jpg',
                        'category' => [
                            0 => 'FASHION APPAREL',
                            1 => 'UNDERWEAR - WOMENS',
                            2 => 'BRIEFS',
                            3 => 'BIKINI BRIEFS',
                        ],
                        'url' => 'https://www.catch.com.au/product/3-x-kayser-womens-luxe-delightfuls-xmas-cheeky-bikini-red-foil-3577536',
                        'upc' => '9341263394903',
                        'gtin14' => NULL,
                        'created_at' => '2019-01-29 10:11:40',
                        'brand' => [
                            'id' => 2916,
                            'name' => 'Kayser',
                        ],
                    ],
                ],
            ],
            'discounts' => [
                0 => [
                    'type' => 'DOLLAR',
                    'value' => 8,
                    'priority' => 1,
                ],
            ],
            'shipping_price' => 13.99,
        ];
    }
}
