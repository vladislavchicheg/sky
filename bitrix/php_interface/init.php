<?
include 'old.php';
include 'include/kint-master/Kint.class.php';
include 'include/asst.php';
include 'include/Props.php';
include 'include/request.php';
include 'include/dom_selector.php';


class modelData
{
    public static $iblock = 49;
    private $cache = array();

    public function __construct()
    {
        CModule::IncludeModule('iblock');
    }

    public function insert($names)
    {
        if (!is_array($names)) {
            $names = array($names);
        }
        $marks = $this->getChildToSet(array(), $names, true, true);
        $codes = array();
        foreach ($marks as $mark) {
            foreach ($mark as $model) {
                $codes[] = md5(json_encode($model));
            }
        }
        $rsItems = CIBlockElement::GetList(array(), array(
            'IBLOCK_ID' => self::$iblock,
            'CODE' => $codes
        ), false, false, array('ID', 'CODE'));
        $already = array();
        while ($ob = $rsItems->Fetch()) {
            $already[] = $ob['CODE'];
        }
        $el = new CIBlockElement();
        foreach ($marks as $mark) {
            foreach ($mark as $model) {
                if (!in_array(md5(json_encode($model)), $already)) {
                    $el->Add(array(
                        'IBLOCK_ID' => self::$iblock,
                        'CODE' => md5(json_encode($model)),
                        'NAME' => $model['mark'] . ' ' . $model['model'] . ' ' . ($model['kuzov'] ? $model['kuzov'] . ' ' : '') . $model['year'] . ' ' . $model['modification'],
                        'ACTIVE' => "Y",
                        'PROPERTY_VALUES' => array(
                            'mark' => $model['mark'],
                            'model' => $model['model'],
                            'body' => $model['kuzov'],
                            'year' => $model['year'],
                            'modification' => $model['modification']
                        ),
                        'PREVIEW_TEXT' => json_encode($model['params'], JSON_PRETTY_PRINT)
                    ));
                }
            }
        }
    }

    /**
     * @param array $items
     * @param bool|array $access
     * @param bool $self
     * @param bool $isSet
     * @return array|bool
     */
    function getChildToSet($items = array(), $access = false, $self = true, $isSet = false)
    {
        if ($self) {
            $items = json_decode(request::get('http://kolesa-darom.ru/netcat/podbor.php', array('key' => 'autoselect')), true);
        }
        if (!$items) {
            return false;
        }
        $result = array();
        foreach ($items['items'] as $name => $key) {
            if (!$name) {
                continue;
            }
            if (is_array($access) && $access[0] == 'exclude') {
                if (in_array($name, $access)) {
                    continue;
                }
            } else {
                if ($access && (!in_array($name, $access) && !is_array($access[$name]))) {
                    continue;
                }
            }
            if ($access && is_array($access[$name])) {
                $setAccess = $access[$name];
            } else {
                $setAccess = false;
            }
            $set = array(
                'name' => $name,
                'type' => $items['defaultText']
            );
            if (preg_match("/Select/", $key)) {
                $subItems = json_decode(request::get('http://kolesa-darom.ru/netcat/podbor.php', array('key' => $key)), true);
                $set['items'] = $this->getChildToSet($subItems, $setAccess, false, false);
            } else {
                $set['page'] = $key;
                $data = request::get("http://kolesa-darom.ru/moskva/diski/auto/" . $key);
                $dom = new SelectorDOM($data);
                $divs = $dom->select('.recom-wh');
                $sh = $divs[0];
                $bus = array(
                    'base' => array(),
                    'sub' => array()
                );
                $wheel = $bus;
                preg_match_all("/([0-9]+)\/([0-9]+) R([0-9][0-9])/", $sh['children'][1]['text'], $matches);
                foreach ($matches as $k => $m) {
                    if ($k != 0) {
                        $key = 'r';
                        switch ($k) {
                            case 1:
                                $key = 'profil';
                                break;
                            case 2:
                                $key = 'profil-height';
                                break;
                        }
                        foreach ($m as $j => $v) {
                            $bus['base'][$j][$key] = $v;
                        }
                    }
                }
                preg_match_all("/([0-9]+)\/([0-9]+) R([0-9][0-9])/", $sh['children'][2]['text'], $matches);
                foreach ($matches as $k => $m) {
                    if ($k != 0) {
                        $key = 'r';
                        switch ($k) {
                            case 1:
                                $key = 'profil';
                                break;
                            case 2:
                                $key = 'profil-height';
                                break;
                        }
                        foreach ($m as $j => $v) {
                            $bus['sub'][$j][$key] = $v;
                        }
                    }
                }
                $di = $divs[1];
                preg_match_all("/R([0-9]+) \(([0-9]+(?:\.[0-9]+)?) x [0-9]+ ET([0-9]+)/", $di['children'][1]['text'], $matches);
                foreach ($matches as $k => $m) {
                    if ($k != 0) {
                        $key = 'r';
                        switch ($k) {
                            case 2:
                                $key = 'width';
                                break;
                            case 3:
                                $key = 'et';
                                break;
                        }
                        foreach ($m as $j => $v) {
                            $wheel['base'][$j][$key] = $v;
                        }
                    }
                }
                preg_match_all("/R([0-9]+) \(([0-9]+(?:\.[0-9]+)?) x [0-9]+ ET([0-9]+)/", $di['children'][2]['text'], $matches);
                foreach ($matches as $k => $m) {
                    if ($k != 0) {
                        $key = 'r';
                        switch ($k) {
                            case 2:
                                $key = 'width';
                                break;
                            case 3:
                                $key = 'et';
                                break;
                        }
                        foreach ($m as $j => $v) {
                            $wheel['sub'][$j][$key] = $v;
                        }
                    }
                }
                $set['params'] = array(
                    'bus' => $bus,
                    'wheel' => $wheel
                );
            }

            if ($isSet) {
                $subset = array();
                foreach ($set['items'] as $model) {
                    foreach ($model['items'] as $kuzov) {
                        if (!count($kuzov['items'])) {
                            continue;
                        }
                        if ($kuzov['type'] == 'Год выпуска') {
                            $year = $kuzov;
                            if ($year['items']) {
                                foreach ($year['items'] as $mod) {
                                    $temp = array(
                                        'mark' => $set['name'],
                                        'model' => $model['name'],
                                        'year' => $year['name'],
                                        'modification' => $mod['name']
                                    );
                                    if ($mod['params']) {
                                        $temp['params'] = $mod['params'];
                                    }
                                    $subset[] = $temp;
                                }
                            } else {
                                $subset[] = array(
                                    'mark' => $set['name'],
                                    'model' => $model['name'],
                                    'year' => $year['name'],
                                );
                            }
                        } else {
                            foreach ($kuzov['items'] as $year) {
                                if ($year['items']) {
                                    foreach ($year['items'] as $mod) {
                                        $temp = array(
                                            'mark' => $set['name'],
                                            'model' => $model['name'],
                                            'kuzov' => $kuzov['name'],
                                            'year' => $year['name'],
                                            'modification' => $mod['name']
                                        );
                                        if ($mod['params']) {
                                            $temp['params'] = $mod['params'];
                                        }
                                        $subset[] = $temp;
                                    }
                                } else {
                                    $subset[] = array(
                                        'mark' => $set['name'],
                                        'model' => $model['name'],
                                        'kuzov' => $kuzov['name'],
                                        'year' => $year['name'],
                                    );
                                }
                            }
                        }
                    }
                }
                $set = $subset;
            }
            $result[] = $set;
        }
        return $result;
    }
}

function modelCron($models)
{
    $model = new modelData();
    $model->insert($models);
    return "modelCron(" . var_export($models, true) . ");";
}

function setImage(&$id, $resize = false)
{
    if ($id) {
        if ($resize) {
            $get = CFile::ResizeImageGet($id, array('width' => $resize[0], 'height' => $resize[1]));
            $id = array(
                "SRC" => $get['src']
            );
        } else {
            $id = CFile::GetFileArray($id);
        }
    } else {
        $id = false;
    }
}



function getCartCount()
{
    CModule::IncludeModule('sale');
    $count = 0;
    $all = true;
    $dbBasketItems = CSaleBasket::GetList(
        array(
            "NAME" => "ASC",
            "ID" => "ASC"
        ),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL",
            'CAN_BUY' => 'Y'
        ),
        false,
        false,
        array("ID", 'QUANTITY', 'CAN_BUY')
    );
    while ($ob = $dbBasketItems->Fetch()) {
        if ($all) {
            $count += $ob['QUANTITY'];
        } else {
            $count++;
        }
    }
    return $count;
}