<?php
/**
 * Created by PhpStorm.
 * User: lgray
 * Date: 5/6/2015
 * Time: 10:11 PM
 */

class Route
{
   public static $requests = array();

    public static function get($url, $responder)
    {
        self::set('GET', $url, $responder);
    }

    public static function post($url, $responder)
    {
        self::set('POST', $url, $responder);
    }

    public static function set($method, $url, $responder)
    {
        self::$requests[] = array( 'method'     => $method,
            'url'      => $url,
            'responder' => $responder
        );
    }

    public static function respond()
    {
        $request_method = $_SERVER['REQUEST_METHOD'];

        $url = self::processUrl($request_method);

        foreach(self::$requests as $request)
        {
            if($request['url'] == $url || $request['url'] == '/'.$url)
            { 
                if($request['method'] == $request_method)
                { 
                    if(is_callable( $request['responder'] )){
                        $return = call_user_func($request['responder']);
                        echo self::toJson($return);
                        return;
                    }//end if
                    else
                    {
                        list($class, $method) = explode('@', $request['responder']);
                        require CONTROLLER_FOLDER . $class . '.php';
                        $controller = new $class();
                        $return =  $controller->$method();
                        echo self::toJson($return);
                    }
                }//end if
            }//end if
        }//end foreach
    }//end function respond()

    public static function match($url)
    {
        foreach(self::$requests as $request)
        {
            if ($request['url'] != '/')
            {
                $vars = explode('/', $request['url']);
                $urls = explode('/', $url);
                $num = 1;
                foreach( $vars as $var)
                {
                    if (preg_match('/{\w+}/', $var))
                    {
                        echo 'param' . $num . ': ' . preg_replace('/{|}/', '', $var) . '<br>';
                    }
                        
                    $num++;
                }
            }
        }
        die;
    }

    public static function toJson($data)
    {
        if (is_object($data) || is_array($data))
        {
            $data = json_encode($data);
        }
        echo $data;
    }

    public static function processUrl($request_method)
    {
        if ( $request_method == 'GET'){
            if ( array_key_exists('url', $_GET))
            {
                $url = rtrim($_GET['url'], '/');
            }
            else
            {
                $url = '/';
            }
                
        }
        else if ( $request_method = 'POST')
        {   
            if ( array_key_exists('url', $_POST))
            {
                $url = rtrim($_POST['url'], '/');
            }
            else
            {
                $url = '/';
            }
        }

        return $url;
    }
}//end class Route