<?php
  function includeFn($page, $params = '')
  {
    if (is_array($params)) {
      extract($params);
    }
    include($page);
    //USAGE
    // includeFn("header.php", array(
    //   'keywords'=> "Potato, Tomato, Toothpaste",
    //   'title'=> "Hello World"
    // ));
  }

  function redirect($url)
  {
    if (headers_sent()) {
      die('<script type="text/javascript">window.location=\'' . $url . '\';</script>');
    } else {
      header('Location: ' . $url);
      die();
    }
  }

  function base()
  {
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF'];
    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
    $pathInfo = pathinfo($currentPath);
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST'];
    // output: http://
    // $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https://' ? 'https://' : 'https://';
    // return: http://localhost/myproject/
    return $protocol . $hostName;
    // return $protocol.$hostName.$pathInfo['dirname']."/";
  }
?>