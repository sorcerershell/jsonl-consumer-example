<?php

namespace App\Common;

use JMS\Serializer\SerializerBuilder;

class JSONMarshaller
{
    public static function unmarshal($object, $className)
    {
        $serializer = SerializerBuilder::create()->build();
        return $serializer->deserialize($serializer, $className, 'json');
    }

    public static function marshal($object) {
        $serializer = SerializerBuilder::create()->build();
        return $serializer->serialize($serializer,'json');
    }
}