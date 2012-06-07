<?php
require_once('Array2XML.php');
$restaurant = array();
$restaurant['@attributes'] = array(
    'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
    'xsi:noNamespaceSchemaLocation' => 'http://www.example.com/schmema.xsd',
    'lastUpdated' => date('c')  // dynamic values
);
 
$restaurant['masterChef'] = array(  //empty node with attributes
    '@attributes' => array(
        'name' => 'Mr. Big C.'
    )
);
 
 
$restaurant['menu'] = array();
$restaurant['menu']['@attributes'] = array(
    'key' => 'english_menu',
    'language' => 'en_US',
    'defaultCurrency' => 'USD'
);
 
 
// we have multiple image tags (without value)
$restaurant['menu']['assets']['image'][] = array(
    '@attributes' => array(
        'info' => 'Logo',
        'height' => '100',
        'width' => '100',
        'url' => 'http://www.example.com/res/logo.png'
    )
);
$restaurant['menu']['assets']['image'][] = array(
    '@attributes' => array(
        'info' => 'HiRes Logo',
        'height' => '300',
        'width' => '300',
        'url' => 'http://www.example.com/res/hires_logo.png'
    )
);
 
$restaurant['menu']['item'] = array();
$restaurant['menu']['item'][] = array(
    '@attributes' => array(
        'lastUpdated' => '2011-06-09T08:30:18-05:00',
        'available' => true  // boolean values will be converted to 'true' and not 1
    ),
    'category' => array('bread', 'chicken', 'non-veg'),	 // we have multiple category tags with text nodes
    'keyword' => array('burger', 'chicken'),
    'assets' => array(
        'title' => 'Zinger Burger',
        'desc' => array('@cdata'=>'The Burger we all love >_< !'),
        'image' => array(
            '@attributes' => array(
                'height' => '100',
                'width' => '100',
                'url' => 'http://www.example.com/res/zinger.png',
                'info' => 'Zinger Burger'
            )
        )
    ),
    'price' => array(
        array(
            '@value' => 10,  // will create textnode <price currency="USD">10</price>
            '@attributes' => array(
                'currency' => 'USD'
            )
        ),
        array(
            '@value' => 450,  // will create textnode <price currency="INR">450</price>
            '@attributes' => array(
                'currency' => 'INR'
            )
        )
    ),
    'trivia' => null  // will create empty node <trivia/>
);
$restaurant['menu']['item'][] = array(
    '@attributes' => array(
        'lastUpdated' => '2011-06-09T08:30:18-05:00',
        'available' => true  // boolean values will be preserved
    ),
    'category' => array('salad', 'veg'),
    'keyword' => array('greek', 'salad'),
    'assets' => array(
        'title' => 'Greek Salad',
        'desc' => array('@cdata'=>'Chef\'s Favorites'),
        'image' => array(
            '@attributes' => array(
                'height' => '100',
                'width' => '100',
                'url' => 'http://www.example.com/res/greek.png',
                'info' => 'Greek Salad'
            )
        )
    ),
    'price' => array(
        array(
            '@value' => 20,  // will create textnode <price currency="USD">20</price>
            '@attributes' => array(
                'currency' => 'USD'
            )
        ),
        array(
            '@value' => 900,  // will create textnode <price currency="INR">900</price>
            '@attributes' => array(
                'currency' => 'INR'
            )
        )
    ),
    'trivia' => 'Loved by the Greek!'
);
 
$xml = Array2XML::createXML('restaurant', $restaurant);
echo $xml->saveXML();
?>