<?php

$twigPath = dirname(__FILE__) . '/Twig/Autoloader.php';
if (file_exists($twigPath)) {
    /** @var string $twigPath */
    /** @noinspection PhpIncludeInspection */
    require_once $twigPath;
    Twig_Autoloader::register();
    global $twig;
    $twig = new Twig_Environment(new Twig_Loader_String());
    define('USE_TWIG', true);
} else {
    define('USE_TWIG', false);
}


/**
 * Class Props
 */
class Props
{

    /**
     * @var array|null
     */
    public $object;
    /**
     * @var
     */
    public $list;
    public $alias = array(
        'PREVIEW_PICTURE' => 'image',
        'DETAIL_PICTURE' => 'image',
        'PICTURE' => 'image',
        'DETAIL_PAGE_URL' => 'link',
        'SECTION_PAGE_URL' => 'link',
        'NAME' => 'name',
        'PREVIEW_TEXT' => 'text',
        'DETAIL_TEXT' => 'text',
        'DESCRIPTION' => 'text',
    );
    /**
     * @var array
     */
    private $hlCache = array();

    /**
     * Props constructor.
     * @param array $object
     */
    function __construct($object = null)
    {
        if ($object) {
            $this->object = $object;
            $this->getList();
        }
    }

    /**
     * @return array|null
     */
    function getList()
    {
        if (!$this->list) {
            $this->list = array();
            foreach ($this->object as $key => $value) {
                if (is_array($value)) {
                    $this->list[$key] = $value['NAME'];
                }

            }
            return $this->list;
        } else {
            return $this->list;
        }
    }

    /**
     * @param null $list
     */
    public function setList($list)
    {
        $this->list = $list;
    }

    function set($key, $value, $display = false)
    {
        $subKey = $display ? 'DISPLAY_VALUE' : 'VALUE';
        $this->object[$key][$subKey] = $value;
    }

    /**
     * @param string $key
     * @param null|int $i
     * @return null|string
     */
    function getDesc($key, $i = null)
    {
        $prop = null;
        if (!$this->object[$key]) {
            return null;
        } else {
            $prop = $this->object[$key];
        }
        if ($i >= 0) {
            return $prop['DESCRIPTION'][$i];
        } else {
            return $prop['DESCRIPTION'];
        }
    }

    /**
     * @param string $key
     * @return bool|string
     */
    function getName($key)
    {
        if (!$this->object[$key]) {
            return false;
        }
        return $this->object[$key]['NAME'];
    }

    /**
     * @param string $key
     * @return bool|string
     */
    function getCode($key)
    {
        if (!$this->object[$key]) {
            return false;
        }
        return $this->object[$key]['CODE'];
    }

    /**
     * @param string $key
     * @return bool|int
     */
    function getId($key)
    {
        if (!$this->object[$key]) {
            return false;
        }
        return $this->object[$key]['ID'];
    }

    /**
     * @return array
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param array $object
     */
    public function setObject($object)
    {
        $this->object = $object;
        $this->getList();
    }

    /**
     * @param string|array $keys
     * @param string $template
     * @param bool $no_matter
     * @return bool
     */
    public function show($keys, $template = null, $no_matter = false)
    {
        echo $this->getShow($keys, $template, $no_matter);
    }

    /**
     * @param $keys
     * @param null $template
     * @param bool $no_matter
     * @return array|bool|int|mixed|string
     */
    public function getShow($keys, $template = null, $no_matter = false)
    {
        if (!is_array($keys)) {
            $keys = array($keys);
        }
        if (!$template && count($keys) == 1) {
            return $this->get($keys[0]);
        } elseif (!$template && count($keys) > 1) {
            return Alert::error('Для данного использования необходим шаблон');
        }
        $access = true;
        $replacements = array();
        foreach ($keys as $key) {
            if (!$this->get($key) && !$no_matter) {
                $access = false;
            } else {
                $useSrc = $key == 'PREVIEW_PICTURE' || $key == 'DETAIL_PICTURE' ? true : false;
                $prop = $this->get($key);
                $propValue = $useSrc ? $prop['SRC'] : $prop;
                if ($this->alias[$key]) {
                    $replacements[$this->alias[$key]] = $propValue;
                }
                $replacements[$key] = $propValue;
            }
        }
        if ($access) {
            if (USE_TWIG) {
                global $twig;
                return $twig->render($template, $replacements);
            } else {
                foreach ($replacements as $key => $value) {
                    $template = str_replace('{{' . $key . '}}', $value, $template);
                }
                return $template;
            }
        } else {
            return false;
        }
    }

    /**
     * @param string $key
     * @param bool $display
     * @return array|bool|int|string
     */
    function get($key, $display = false)
    {
        $prop = null;
        if (!$this->object[$key]) {
            return null;
        } else {
            $prop = $this->object[$key];
        }
        if (!is_bool($display)) {
            if (is_array($display)) {
                $last = $prop;
                foreach ($display as $k) {
                    $last = $last[$k];
                }
                return $last;
            }
            return $prop[$display];
        }
        if ($display) {
            return $prop['DISPLAY_VALUE'];
        } else {
            if ($prop['FILE_VALUE']) {
                return ($prop['MULTIPLE'] == 'Y' && $prop['FILE_VALUE']['SRC'] ? array($prop['FILE_VALUE']) : $prop['FILE_VALUE']);
            } else {
                return $prop['VALUE'];
            }
        }
    }

    /**
     * @param $key
     * @param string $field
     * @param bool $whereField
     * @param bool $whereValue
     * @return array|bool
     */
    function getHL($key, $field = 'UF_FILE', $whereField = true, $whereValue = false)
    {
        $tableInfo = $this->get($key, 'USER_TYPE_SETTINGS');
        if (!$tableInfo['TABLE_NAME']) {
            return false;
        } else {
            $tableName = $tableInfo['TABLE_NAME'];
            $result = $this->hlCache[$tableName];
            if (!$result) {
                global $DB;
                $query = "SELECT ID,UF_XML_ID,UF_NAME,`$field` FROM $tableName";
                if ($whereField && $whereValue) {
                    $query .= " WHERE '$whereField'='$whereValue'";
                }
                $rs = $DB->Query($query);
                while ($ob = $rs->Fetch()) {
                    if (is_bool($whereField) && $whereField == true) {
                        $ob['UF_FILE'] = CFile::GetFileArray($ob['UF_FILE']);
                    }
                    $result[$ob['UF_XML_ID']] = $ob;
                }
                $this->hlCache[$tableName] = $result;
            }
            $getted = $this->get($key);
            if (is_array($getted)) {
                $return = array();
                foreach ($getted as $g) {
                    $return[] = $result[$g];
                }
                return $return;
            } else {
                return $result[$getted];
            }
        }
    }

    /**
     * @param $key
     * @return null|array
     */
    function getProp($key)
    {
        $prop = null;
        if (!$this->object[$key]) {
            return null;
        } else {
            return $this->object[$key];
        }
    }

    /**
     * @param string|array $keys
     * @return bool
     */
    public function hasOf($keys)
    {
        if (!is_array($keys)) {
            $keys = array($keys);
        }
        $has = false;
        foreach ($keys as $key) {
            if ($this->get($key)) {
                $has = true;
            }
        }
        return $has;
    }

    /**
     * @param string|array $keys
     * @return bool
     */
    public function hasAll($keys)
    {
        if (!is_array($keys)) {
            $keys = array($keys);
        }
        $has = 0;
        foreach ($keys as $key) {
            if ($this->get($key)) {
                $has++;
            }
        }
        if ($has == count($keys)) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Class arItem
 */
class arItem extends Props
{
    /**
     * @var Props
     */
    private $props;

    /**
     * arItem constructor.
     * @param array|null $object
     */
    public function __construct($object)
    {
        $this->props = new Props($object['DISPLAY_PROPERTIES']);
        parent::__construct($object);
    }

    /**
     * @return Props
     */
    public function getProps()
    {
        return $this->props;
    }

    /**
     * @param mixed $props
     */
    public function setProps($props)
    {
        $this->props = $props;
    }

    /**
     * @param $key
     * @param string $field
     * @param bool $whereField
     * @param bool $whereValue
     * @return array|bool
     */
    function _getHL($key, $field = 'UF_FILE', $whereField = true, $whereValue = false)
    {
        return $this->props->getHL($key, $field, $whereField, $whereValue);
    }

    /**
     * @param $key
     * @return array|null
     */
    function _prop($key)
    {
        return $this->_getProp($key);
    }

    /**
     * @param $key
     * @return array|null
     */
    function _getProp($key)
    {
        return $this->props->getProp($key);
    }

    /**
     * Example:
     * <code>
     * <div id="<?=$item->area($this)?>"></div>
     * </code>
     * @param CBitrixComponentTemplate $component
     * @param bool $edit
     * @param bool $delete
     * @return string
     */
    function area($component, $edit = true, $delete = true)
    {
        if ($edit) {
            $component->AddEditAction($this->id(), $this->get('EDIT_LINK'), CIBlock::GetArrayByID($this->iblock(), "ELEMENT_EDIT"));
        }
        if ($delete) {
            $component->AddDeleteAction($this->id(), $this->get('DELETE_LINK'), CIBlock::GetArrayByID($this->iblock(), "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        }
        return $component->GetEditAreaId($this->id());
    }

    /**
     * @return bool|int
     */
    function id()
    {
        return $this->getId();
    }

    /**
     * @return bool|int
     */
    function getId()
    {
        return $this->get('ID');
    }

    /**
     * @param string $key
     * @param null $field
     * @return bool|mixed
     */
    function get($key, $field = null)
    {
        if ($field) {
            if (is_array($field)) {
                $last = $this->object[$key];
                foreach ($field as $k) {
                    $last = $last[$k];
                }
                return $last;
            }
            return $this->object[$key][$field];
        }
        if ($this->object[$key]) {
            return $this->object[$key];
        } else {
            return false;
        }
    }

    function iblock()
    {
        return $this->get('IBLOCK_ID');
    }

    /**
     * @param $key
     * @return bool|string
     */
    function _name($key)
    {
        return $this->_getName($key);
    }

    /**
     * @param $key
     * @return bool|string
     */
    function _getName($key)
    {
        return $this->props->getName($key);
    }

    /**
     * @param $keys
     * @param null $template
     * @param bool $no_matter
     * @return bool
     */
    function _show($keys, $template = null, $no_matter = false)
    {
        return $this->props->show($keys, $template, $no_matter);
    }

    /**
     * @param $keys
     * @param null $template
     * @return array|bool|int|mixed|string
     */
    function _getShow($keys, $template = null)
    {
        return $this->props->getShow($keys, $template);
    }

    /**
     * @return Props
     */
    function createProps()
    {
        $this->props = new Props($this->get('DISPLAY_PROPERTIES'));
        return $this->props;
    }

    /**
     * @param bool $detail
     * @param bool $matter
     * @return array|bool|int|string
     */
    function text($detail = false, $matter = true)
    {
        if (!$this->getPreviewText() && !$this->getDetailText()) {
            return $this->getDesc();
        }
        if ($matter) {
            return ($detail ? $this->getDetailText() : $this->getPreviewText());
        } else {
            return ($detail ? ($this->getDetailText() ? $this->getDetailText() : $this->getPreviewText()) : ($this->getPreviewText() ? $this->getPreviewText() : $this->getDetailText()));
        }
    }

    /**
     * @return string|bool
     */
    function getPreviewText()
    {
        return $this->get('PREVIEW_TEXT');
    }

    /**
     * @return string|bool
     */
    function getDetailText()
    {
        return $this->get('DETAIL_TEXT');
    }

    /**
     * @return array|bool|int|string
     */
    function getDesc()
    {
        return $this->get('DESCRIPTION');
    }

    /**
     * @param bool $src
     * @return string|array|bool
     */
    function getPreview($src = true)
    {
        $obj = $this->get('PREVIEW_PICTURE');
        if (!is_array($obj)) {
            $obj = CFile::GetFileArray($obj);
        }
        return ($src == true ? $obj['SRC'] : $obj);
    }

    /**
     * @param bool $src
     * @return string|array|bool
     */
    function getDetail($src = true)
    {
        $obj = $this->get('DETAIL_PICTURE');
        if (!is_array($obj)) {
            $obj = CFile::GetFileArray($obj);
        }
        return ($src == true ? $obj['SRC'] : $obj);
    }

    /**
     * @return bool|string
     */
    function name()
    {
        return $this->getName();
    }

    /**
     * @return bool|string
     */
    function getName()
    {
        return $this->get('NAME');
    }

    /**
     * @param $key
     * @param bool $display
     * @param bool $default
     * @return array|bool|int|string
     */
    function _($key, $display = false, $default = false)
    {
        if ($default) {
            $value = $this->props->get($key, $display);
            return $value ? $value : $default;
        } else {
            return $this->props->get($key, $display);
        }
    }

    function _set($key, $value, $display = false)
    {
        $this->props->set($key, $value, $display);
    }

    /**
     * @param $key
     * @param bool $display
     * @return array|bool|int|string
     * @deprecated
     */
    function _get($key, $display = false)
    {
        return $this->props->get($key, $display);
    }

    /**
     * @return bool|string
     */
    function getCode()
    {
        return $this->get('CODE');
    }

    /**
     * @return bool|int|mixed
     */
    function pId()
    {
        if ($this->get('PRODUCT_ID')) {
            return $this->get('PRODUCT_ID');
        } else {
            return $this->id();
        }
    }

    /**
     * @return bool|string
     * @deprecated
     */
    function getLink()
    {
        return $this->get('DETAIL_PAGE_URL');
    }

    function link()
    {
        if ($this->get('SECTION_PAGE_URL')) {
            return $this->get('SECTION_PAGE_URL');
        } else {
            return $this->get('DETAIL_PAGE_URL');
        }
    }

    function date($format = 'd.m.Y')
    {
        $date = $this->get('TIMESTAMP_X');
        if ($this->get('ACTIVE_FROM')) {
            $date = $this->get('ACTIVE_FROM');
        }
        $date = strtotime($date);
        return date($format, $date);
    }

    /**
     * @return string
     */
    function getMinPrice()
    {
        $price = $this->get('MIN_PRICE');
        return $price['PRINT_VALUE'];
    }

    /**
     * @return int
     */
    function getMinPriceValue()
    {
        $price = $this->get('MIN_PRICE');
        return $price['VALUE'];
    }
}

/**
 * Class Unstable
 */
Class Unstable
{
    /**
     * @param $values
     * @param null $template
     * @param bool $no_matter
     */
    public static function show($values, $template = null, $no_matter = false)
    {
        echo Unstable::getShow($values, $template, $no_matter);
    }

    /**
     * @param $values
     * @param null $template
     * @param bool $no_matter
     * @return array|bool|mixed
     */
    public static function getShow($values, $template = null, $no_matter = false)
    {
        if (!is_array($values)) {
            $values = array($values);
        }
        if (!$template && count($values) == 1) {
            return (is_array($values[0]) ? ($values[0][0] ? $values[0][0] : (is_array($values[0][1]) ? ($values[0][1][0] ? $values[0][1][0] : $values[0][1][1]) : $values[0][1])) : $values[0]);
        } elseif (!$template && count($values) > 1) {
            return Alert::error('Для данного использования необходим шаблон');
        }
        $access = true;
        $replacements = array();
        foreach ($values as $v => $key) {
            if (!$key && !$no_matter) {
                $access = false;
            } else {
                $setKey = $v <> "" ? $v : "a" . $v;
                if (is_array($key) && !USE_TWIG) {
                    if ($key[0] <> '') {
                        $replacements[$setKey] = $key[0];
                    } else {
                        $replacements[$setKey] = $key[1];
                    }
                } else {
                    $replacements[$setKey] = $key;
                }
            }
        }
        if ($access) {
            if (USE_TWIG) {
                global $twig;
                return $twig->render($template, $replacements);
            } else {
                return preg_replace_callback('/:\w+/', function ($matches) use (&$replacements) {
                    return array_shift($replacements);
                }, $template);
            }
        } else {
            return false;
        }
    }

    public static function display($values, $template = null)
    {
        echo Unstable::getDisplay($values, $template);
    }

    public static function getDisplay($values, $template = null)
    {
        return Unstable::getShow($values, $template, true);
    }

    /**
     * @param mixed $value
     * @param null|mixed $default
     * @param null|string $template
     * @param bool $no_matter
     */
    public static function showOf($value, $default = null, $template = null, $no_matter = false)
    {
        echo Unstable::getShowOf($value, $default, $template, $no_matter);
    }

    /**
     * @param mixed $value
     * @param null|mixed $default
     * @param null|string $template
     * @param bool $no_matter
     * @return array|bool|mixed
     */
    public static function getShowOf($value, $default = null, $template = null, $no_matter = false)
    {
        return Unstable::getShow(array(array($value, $default)), $template, $no_matter);
    }

    /**
     * @param bool $expression
     * @param mixed $content
     * @return null|mixed
     */
    public static function _if($expression, $content)
    {
        return Unstable::_if_else($expression, $content);
    }

    /**
     * @param bool $expression
     * @param mixed $content
     * @param null|mixed $content_
     * @return null|mixed
     */
    public static function _if_else($expression, $content, $content_ = null)
    {
        return Unstable::_if_then(array(
            array($expression, $content),
            array(true, $content_)
        ));
    }

    /**
     * @param array $values
     * @return null|mixed
     */
    public static function _if_then(array $values)
    {
        foreach ($values as $pair) {
            if ($pair[0]) {
                return $pair[1];
                break;
            }
        }
        return null;
    }
}

class Alert
{
    public static $defaults = array(
        'error' => 'Неизвестная ошибка'
    );

    public static function error($error = null, $admin = true)
    {
        if ($error == false || $error == null) {
            $error = self::$defaults['error'];
        }
        $permission = true;
        self::checkPermission($permission, $admin);
        if ($permission) {
            ?>
            <div role="alert" class="error-alert" style="
                    color: #a94442;
                    background-color: #f2dede;
                    border: 1px solid #ebcccc;
                    padding: 15px;
                    margin-bottom: 1rem;
                    border-radius: .25rem;
                    -webkit-box-sizing: inherit;
                    box-sizing: inherit;
                " title="<?= $error ?> <?= ($admin ? '(сообщение видно только администраторам)' : '') ?>">
                <?= $error ?>
            </div>
            <?
        }
        return false;
    }

    private function checkPermission(&$permission, $admin)
    {
        if ($admin) {
            $permission = false;
            global $USER;
            if (is_object($USER)) {
                if ($USER->IsAdmin()) {
                    $permission = true;
                } else {
                    $permission = false;
                }
            }
        } else {
            $permission = true;
        }
    }
}