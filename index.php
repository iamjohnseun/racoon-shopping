<?php include './include/ini.php'; ?>
<?php
define('dir', dirname(__FILE__) . '/view/');

$rules = array(
  'regular' => "(?:\G(?!\A)&|(?<dir>[^/?]+)?\/?[?])(?<key>[^=&]*)=?(?<val>[^&]*)",
  'param' => "/(?'d'[^/]+)/(?'p'[^/]+)",
  'query' => "/[^/]+(?:/[^/]+){2,}/?",
  'dir' => "/(?'post'[\w\-]+)",
  'ext' => "/(?'post').(?'t'[^/]+)",
  'index' => "/"
);
$uri = rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/');
$uri = '/' . trim(str_replace($uri, '', $_SERVER['REQUEST_URI']), '/');
$uri = urldecode($uri);

foreach ($rules as $action => $rule) {
  if (preg_match_all('~^' . $rule . '$~i', $uri, $params)) {
    // PARAMETER IS STORED IN ACTION
    // TRIM URL EXTENSION
    $uri = ltrim($uri, '/');
    $arr = explode(".", $uri);
    $uri = strtolower($arr[0]);

    // INCLUDE APPROPRIATE PAGE OR TEMPLATE
    switch ($action) {
      case "regular":
        $uri = (isset($params['dir']) && !empty($params['dir'][0])) ? $params['dir'][0] : "index";
        $params = array_combine($params["key"], $params["val"]);
        $params['pagename'] = $uri;
        $page = dir . $uri . '.php';
        if (file_exists($page)) {
          includeFn($page, $params);
        } else {
          $params = array("pagename" => "Error");
          includeFn(dir . 'error.php', $params);
        }
        break;
      case "param":
        $arr = explode("/", $uri);
        $uri = $arr[0];
        $param = end($arr);
        $params = array("pagename" => $uri, "param" => $param);
        $page = dir . $uri . '.php';
        if (file_exists($page)) {
          includeFn($page, $params);
        } else {
          $params = array("pagename" => "Error");
          includeFn(dir . 'error.php', $params);
        }
        break;
      case "query":
        $arr = explode("/", $uri);
        $uri = $arr[0];
        $params = array("pagename" => $uri);
        $key = "";
        $val = "";
        for ($i = 1; $i < count($arr); $i++) {
          if ($i % 2 !== 0) {
            $key = $arr[$i];
          } else {
            $val = $arr[$i];
          }
          $params[$key] = $val;
        }
        $page = dir . $uri . '.php';
        if (file_exists($page)) {
          includeFn($page, $params);
        } else {
          $params = array("pagename" => "Error");
          includeFn(dir . 'error.php', $params);
        }
        break;
      case "dir":
        $params = array("pagename" => $uri);
        $page = dir . $uri . '.php';
        if (file_exists($page)) {
          includeFn($page, $params);
        }
        break;
      case "ext":
        $uri = ltrim($uri, '/');
        $arr = explode(".", $uri, 2);
        $uri = $arr[0];
        $pagename = $uri;
        $page = dir . $uri . '.php';
        if (file_exists($page)) {
          includeFn($page, $params);
        } else {
          $params = array("pagename" => "Error");
          includeFn(dir . 'error.php', $params);
        }
        includeFn($page, $params);
        break;
      case "index":
        $params = array("pagename" => $action);
        $page = dir . $action . '.php';
        if (file_exists($page)) {
          includeFn($page, $params);
        } else {
          $params = array("pagename" => "Error");
          includeFn(dir . 'error.php', $params);
        }
        break;
      default:
        $params = array("pagename" => "Error");
        includeFn(dir . 'error.php', $params);
    }
    // EXIT TO AVOID 404
    exit();
  }
}

// NOTHING IS FOUND, HANDLE 404 ERROR
$params = array("pagename" => "Error");
includeFn(dir . 'error.php', $params);
?>