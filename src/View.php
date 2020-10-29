<?php
namespace Base;

class View
{
    private $templatePath = '';
//    private $data = [];

    public function __construct()
    {
        $this->templatePath = PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app/View';
    }

    public function render(string $tpl, $data = []): string
    {
//        $this->data += $data;
        extract($data);
        ob_start();
        include $this->templatePath . DIRECTORY_SEPARATOR . $tpl;
        return ob_get_clean();
    }

//    public function __get($varName)
//    {
//        return $this->data[$varName] ?? null;
//    }
}

/*
 * закомментирован второй способ обращение к переменным во вьюхе,
 * тогда можно было бы к ним обращаться там через $this->$userName, без объявления в phpdoc
 * */
