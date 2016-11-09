<?php

class asst
{
    /**
     * Для возвращения $rsItem->Fetch();
     */
    const FETCH = 1;
    /**
     * Для возвращения $rsItem->GetNext();
     */
    const NEXT = 2;
    /**
     * Для возвращения $rsItem->GetNextElement();
     */
    const NEXT_ELEMENT = 3;

    const lifeTime = 43200;
    const cacheTime = 86400;

    public static $withoutCache = false;

    /**
     * @param int $id ID элемента
     * @param int $type тип возвращаемого результата
     * @return array|mixed элемент
     */
    public static function getByID($id, $type = asst::FETCH)
    {
        $result = array();
        if (self::getCache('element', $id, $type)) {
            return self::getCache('element', $id, $type);
        }
        if (CModule::IncludeModule('iblock')) {
            $rsResult = CIBlockElement::GetByID($id);
            switch ($type) {
                case self::FETCH:
                    while ($ob = $rsResult->Fetch()) {
                        $result = $ob;
                    }
                    break;
                case self::NEXT:
                    while ($ob = $rsResult->GetNext()) {
                        $result = $ob;
                    }
                    break;
                case self::NEXT_ELEMENT:
                    while ($ob = $rsResult->GetNextElement()) {
                        $fields = $ob->GetFields();
                        $fields['DISPLAY_PROPERTIES'] = $ob->GetProperties();
                        $result = $fields;
                    }
                    break;
            }
            $put['element'][$id][$type] = $result;
            self::writeCache($put);
        }
        return $result;
    }

    /**
     * @param array|string $keys
     * @return mixed
     */
    function getCache($keys)
    {
        global $CIBlockHelperCache;
        if (func_num_args() > 1) {
            $keys = func_get_args();
        }
        if (is_array($keys)) {
            $last = $CIBlockHelperCache;
            foreach ($keys as $k) {
                $last = $last[$k];
            }
            return $last;
        } else {
            return $CIBlockHelperCache[$keys];
        }
    }

    function writeCache($value)
    {
        global $CIBlockHelperCache;
        $CIBlockHelperCache = array_merge($CIBlockHelperCache, $value);
    }

    /**
     * Возвращает элементы инфоблока с заданными параметрами:
     *
     * @param array $filter фильтр для элементов. Может быть использован asst::filter; Так же, при передаче ключа KEY и его значении, в массиве элементов ключи будут установлены не автоматически, а значением поля указанного ключа.
     * @param array $sort сортировка. По умолчанию стоит по параметру сортировки по возрастанию. Если указать false или null будет так же использована сортировка по возрастанию.
     * @param int $type тип возвращаемого результата.
     * @param array $select массив возвращаемых полей
     * @param bool|int|array $page количество выводимых элементов, если передать массив, в GetList будет передан массив
     * @param bool|array $group группировка по полю. Все ключи данного массива будут добавлены в массив сортировки по возрастанию
     * @return array|bool массив элементов или false в случае ошибки/отсутствия элементов
     */
    public static function getList($filter, $sort = array('SORT' => 'ASC'), $type = asst::NEXT_ELEMENT, $select = array(), $page = false, $group = false)
    {
        $args = func_get_args();
        $uid = md5(serialize($args));
        $cacheFile = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/cache/asst/' . $uid;
        if (file_exists($cacheFile) && time() - filemtime($cacheFile) <= self::lifeTime && $_REQUEST['clear_cache'] != 'Y' && !ADMIN_SECTION && !self::$withoutCache) {
            $data = file_get_contents($cacheFile);
            $result = unserialize($data);
            if ($type == self::NEXT_ELEMENT && class_exists('arItem')) {
                foreach ($result as $key => $item) {
                    $result[$key]['item'] = new arItem($item);
                }
            }
            return $result;
        }
        if (!$sort) {
            $sort = array('SORT' => "ASC");
        }
        if (is_array($type)) {
            $select = $type;
        }
        if (is_int($sort)) {
            $type = $sort;
            $sort = array('SORT' => "ASC");
        }
        if (!is_int($type)) {
            $type = asst::NEXT_ELEMENT;
        }
        if ($group) {
            foreach ($group as $g) {
                $sort[$g] = 'ASC';
            }
        }
        if (is_int($page)) {
            $pageArray = array(
                'nPageSize' => $page
            );
        } elseif (is_array($page)) {
            $pageArray = $page;
        } else {
            $pageArray = false;
        }
        if (CModule::IncludeModule('iblock')) {
            $rsResult = CIBlockElement::GetList($sort, $filter, $group, $pageArray, $select);
            $result = array();
            switch ($type) {
                case self::FETCH:
                    while ($ob = $rsResult->Fetch()) {
                        if ($filter['KEY']) {
                            $result[$ob[$filter['KEY']]] = $ob;
                        } else {
                            $result[] = $ob;
                        }
                    }
                    break;
                case self::NEXT:
                    while ($ob = $rsResult->GetNext()) {
                        if ($filter['KEY']) {
                            $result[$ob[$filter['KEY']]] = $ob;
                        } else {
                            $result[] = $ob;
                        }
                    }
                    break;
                case self::NEXT_ELEMENT:
                    while ($ob = $rsResult->GetNextElement()) {
                        $fields = $ob->GetFields();
                        $fields['DISPLAY_PROPERTIES'] = $ob->GetProperties();
                        if ($filter['KEY']) {
                            $result[$fields[$filter['KEY']]] = $fields;
                        } else {
                            $result[] = $fields;
                        }
                    }
                    break;
            }
            self::clear();
            file_put_contents($cacheFile, serialize($result));
            if ($type == self::NEXT_ELEMENT && class_exists('arItem')) {
                foreach ($result as $key => $item) {
                    $result[$key]['item'] = new arItem($item);
                }
            }
            return $result;
        }
        return false;
    }

    public static function clear()
    {
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/cache/asst/';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        if (time() - filemtime($folder) >= self::cacheTime) {
            touch($folder);
            foreach (glob($folder . '*') as $file) {
                if (time() - filemtime($file) >= self::lifeTime) {
                    unlink($file);
                }
            }
        }
    }

    public static function clearEnable()
    {
        self::$withoutCache = true;
    }

    public static function clearDisable()
    {
        self::$withoutCache = false;
    }

    /**
     * Подготавливает массив фильтра для использования в других функциях класса
     *
     * @param bool $iblockID ID инфоблока или массив значений фильтра
     * @param bool $active фильтрация по активности. При передаче true - будет установлено значение ACTIVE => Y, при передаче в качестве строки, в параметр ACTIVE будет переданого значение параметра. Так же можно использовать как массив значений
     * @param bool $sectionID используется как SECTION_ID при передаче числа. Так же может быть использован  в качестве массива значений
     * @param array $rewrite используется в качестве массива значений
     * @return array возвращает массив для фильтра
     */
    public static function filter($iblockID = false, $active = false, $sectionID = false, $rewrite = array())
    {
        $filter = array();
        if (is_int($iblockID)) {
            $filter['IBLOCK_ID'] = $iblockID;
        } elseif (is_array($iblockID)) {
            $filter = $iblockID;
        }
        if (is_string($active) || is_bool($active)) {
            $filter['ACTIVE'] = is_string($active) ? $active : 'Y';
        } elseif (is_array($active)) {
            $filter = array_merge($filter, $active);
        }
        if (is_int($sectionID)) {
            $filter['SECTION_ID'] = $sectionID;
        } elseif (is_string($sectionID)) {
            $filter['SECTION_CODE'] = $sectionID;
        } elseif (is_array($sectionID)) {
            $filter = array_merge($filter, $sectionID);
        }
        $filter = array_merge($filter, $rewrite);
        return $filter;
    }

    /**
     * Фильтрует массив по значениям указанных полей
     *
     * <code>
     * asst::pass($arResult['ITEMS'], array('NAME'=>'Яблоко','PROPERTY_TYPE'=>'Фрукты'));
     * </code>
     *
     * @param array $array массив элементов
     * @param array $fields массив полей типа ключ => значение для фильтрации
     * @return array отфильтрованный список элементов
     */
    public static function pass($array, $fields = array())
    {
        if (empty($fields)) {
            return $array;
        }
        $result = array();
        foreach ($array as $arItem) {
            $access = true;
            foreach ($fields as $key => $field) {
                if (preg_match("/PROPERTY_/", $key)) {
                    $key = str_replace('PROPERTY_', '', $key);
                    $value = $arItem['DISPLAY_PROPERTIES'][$key]['VALUE'];
                    if (!$value || $value != $field) {
                        $access = false;
                        break;
                    }
                } else {
                    if ($arItem[$key] != $field) {
                        $access = false;
                        break;
                    }
                }
            }
            if (!$access) {
                continue;
            }
            $result[] = $arItem;
        }
        return $result;
    }
}