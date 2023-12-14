<?php

namespace App\RMVC\Route;

class RouteDispatcher
{
    private string $requestUri = '/';
    private array $paramMap = [];
    private array $paramRequestMap = [];
    private RouteConfiguration $routeConfiguration;

    /**
     * @param RouteConfiguration $routeConfiguration
     */
    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }

    public function process(){
        // 1. Если строка запроса есть,  значит мы должны почстить ее и сохранить
        $this->saveRequestUri();
        // Разбиваем строку роута на массив и сохраняем в новый массив позицию параметр и его название
        $this->setParamMap();
        //Разбиваем строку запроса на массив и проверяем есть ли в этом массиве позиция как у позиции параметра
        // Если есть такая позиция,  значит приводим строку запроса в регулярное выражение.
        $this->makeRegexRequest();
        // Запускаем контроллер и Экшн.
        $this->run();

    }

    private function saveRequestUri()
    {
        if($_SERVER['REQUEST_URI'] !== '/'){
            $this->requestUri =$this->clean($_SERVER['REQUEST_URI']);
            $this->routeConfiguration->route = $this->clean($this->routeConfiguration->route);
//            echo '<pre>';
//            var_dump($this->requestUri);
//            echo '</pre>';
//            echo '<pre>';
//            var_dump($this->routeConfiguration->route);
//            echo '</pre>';
        }
    }

    private function clean($str): string
    {
        return preg_replace('/(^\/)|(\/$)/', '', $str);
    }

    private function setParamMap()
    {
        $routeArray = explode('/', $this->routeConfiguration->route);
        foreach ($routeArray as $paramKey => $param){
            if(preg_match('/{.*}/', $param)){
                $this->paramMap[$paramKey] = preg_replace('/(^{)|(}$)/', '', $param);
            }
        }

//        echo '<pre>';
//        var_dump($this->paramMap);
//        echo '</pre>';

    }
    private function makeRegexRequest()
    {
        $requestUriArray = explode('/', $this->requestUri);

        foreach ($this->paramMap as $paramKey => $param){
            if(!isset($requestUriArray[$paramKey])){
                return ;
            }
            $this->paramRequestMap[$param] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey] = "{.*}";
        }
        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();
//        echo '<pre>';
//        var_dump($this->paramRequestMap);
//        var_dump(111111111);
//        echo '</pre>';


    }
    private function prepareRegex()
    {
        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    private function run()
    {
        if(preg_match("/$this->requestUri/", $this->routeConfiguration->route)){
            $this->render();
        }
    }

    private function render()
    {
        $className = $this->routeConfiguration->controller;
        $action = $this->routeConfiguration->action;
        print((new $className)->$action(...$this->paramRequestMap));
//        echo '<pre>';
//        var_dump('fgffgfg');
//        var_dump((new $className)->$action());
//        echo '</pre>';

        die();
    }
}