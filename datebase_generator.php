<?php
//todo сделать через классы ( каждом типу товаров присвоить свой класс )
$names = [
    'John',
    'Oliver',
    'Jack',
    'Harry',
    'Jacob',
    'Charley',
    'Thomas',
    'George',
    'Oscar',
    'James',
    'William',
    'Noah',
    'Liam',
    'Mason',
    'Jacob',
    'William',
    'Ethan',
    'Michael',
    'Alexander',
    'James',
    'Daniel'
]; // q как сверунть все массивы сразу?
$surnames = [
    'Oliver ',
    'Jack ',
    'Harry ',
    'Jacob ',
    'Charley ',
    'Thomas ',
    'Smith',
    'Johnson',
    'Williams',
    'Jones',
    'Brown',
    'Davis',
    'Miller',
    'Wilson',
    'Moore',
    'Taylor',
    'Anderson',
    'Thomas',
    'Jackson',
    'White',
    'Harris',
    'Martin',
    'Thompson',
    'Wood',
    'Lewis',
    'Scott',
    'Cooper',
    'King',
    'Green',
    'Walker',
    'Edwards',
    'Turner',
    'Morgan',
    'Baker',
    'Hill',
    'Phillips'
];

$goods_names = [
    'home appliances',
    'furniture',
    'dress'
];
$goods = [
    'home appliances' => [
        'oven',
        'dryer',
        'blender',
        'juicer',
        'coffee maker',
        'espresso maker',
        'electronic kitchen scale',
        'hotplate',
        'ice cream maker',
        'hand mixer',
        'microwave oven',
        'kettle',
        'deep fryer',
        'food steamer',
        'popcorn maker',
        'iron',
        'fridge',
        'juicer',
        'dishwasher',
        'vacuum cleaner',
        'hairdryer',
        'washing-machine',
    ],
    'furniture' => [ //todo поделить на мягкую и другоую мебель
        'office chair',
        'desk',
        'filing cabinet',
        'bookshelf',
        'table lamp',
        'coat wardrobe',
        'cradle',
        'travel cot',
        'divan',
        'futon',
        'single bed',
        'bunk beds',
        'sofa bed',
        'camp bed',
        'airbed',
        'hammock',
        'chair',
        'armchair',
        'rocking chair',
        'stool',
        'car seat',
        'wheelchair',
        'swivel chair',
        'deckchair',
        'chaise longue',
        'lounger',
        'high chair',
        'director’s chair',
        'bench',
        'sofa'
    ],
    'dress' => [
        'boots',
        'coat',
        'dress',
        'jacket',
        'jeans',
        'shirt',
        'shoes',
        'skirt',
        'suit',
        'blouse',
        'tank top',
        't-shirt',
        'tunic',
        'cloak',
        'down-padded coat',
        'fur coat',
        'jacket',
        'parka',
        'waistcoat',
        'cardigan',
        'hoodie',
        'pullover',
        'sweat-shirt',
        'shorts',
        'slacks',
        'sweatpants',
        'a-line dress',
        'cocktail dress',
        'dressing gown',
        'evening dress',
        'hospital gown',
        'sheath dress',
        'slip dress',
        'strapless dress',
        'wedding dress',
        'wrap dress',
        'business suit',
        'casual suit',
        'costume',
        'dinner jacket',
        'tailcoat',
        'frock coat',
        'two-piece suit',
        'three-piece suit',
        'beret',
        'bucket hat',
        'cap',
        'hat',
        'helmet',
        'straw hat',
        'veil'
    ]
];

// todo Добавить цвета
// q Как оптимизировать списки
$materials = [
    'fabric' => [
        'artificial leather',
        'faux leather',
        'eco-leather',
        'imitation leather',
        'synthetic leather',
        'artificial materials',
        'corduroy',
        'cotton',
        'denim',
        'faux fur',
        'lace',
        'leather',
        'genuine leather',
        'linen',
        'mink',
        'satin',
        'silk',
        'suede',
        'rubber',
        'velvet',
        'wool'
    ],
];
$patterns = [
    'checked',
    'plaid',
    'floral print',
    'flowery print',
    'patterned',
    'plain',
    'striped',
    'polka-dotted',
];

$prefixes = [
    'new',
    'good',
    'bad',
    'awesome',
    'great',
    'pretty ',
    'little ',
    'big',
    'well',
    ''
];
$options = [
    'materials' => [
        'furniture',
        'dress'
    ],
    'patterns' => [
        'home appliances',
        'furniture',
        'dress'
    ]
];

$database = new Database();
$db = $database->getConnection();

for ($i = 1; $i < 20; $i++) {
    $name = $names[rand(0, count($names) - 1)];
    $surname = $surnames[rand(0, count($surnames) - 1)];
    echo '<br>';

    $qurey = "INSERT INTO board_bd.ads VALUES ( )";
}

function description_gen()
{
    null;
}

function randomDate($start_date, $end_date)
{
    $min = strtotime($start_date);
    $max = strtotime($end_date);
    $val = rand($min, $max);

    return date('Y-m-d H:i:s', $val);
}

/*for ($i = 1; $i < 10; $i++) {

    $good_name = $goods_names[rand(0, count($goods_names) - 1)];
    $prefix = $prefixes[rand(0, count($prefixes) - 1)];

    if (in_array($good_name, $options['materials'])) {
        $material = $materials['fabric'][rand(0, count($materials['fabric']) - 1)]; //q как пролучить доступ к подмассиву через индекс (заменить fabric на 0)
    }

    if (in_array($good_name, $options['patterns'])) {
        $pattern = $patterns[rand(0, count($patterns) - 1)];
    }

    $good = $goods[$good_name][rand(0, count($goods[$good_name]))];

    $author = 0;
    $title = ucfirst(trim($material . ' ' . $good)); //todo сделать проверку на заполненость полей
    $description = ucfirst(trim($prefix . ' ' . $pattern . ' ' . $material . ' ' . $good));
    $price = rand(500, 10000); //todo сделать зависимость от материала и качества
    $publication_date = randomDate('01.01.2021', '29.01.2021');

    echo($title . '<br>' . $description. '<br>' .$price. '<br>' .$publication_date);
    echo('<br><br>');

    $prefix = null;
    $pattern = null;
    $material = null;
    $good = null;

    //todo сделать генерацию автора для объявления, генерацию изображений и добавление всех данных в базу данных
}