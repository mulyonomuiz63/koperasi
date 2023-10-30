<?php


function set_active($uri, $output = 'menu-item-open')
{
    $uris = service('uri');

    $uriSegment = $uris->getSegment(1);
    if (is_array($uri)) {
        foreach ($uri as $u) {
            if ($uriSegment == $u) {
                return $output;
            }
        }
    } else {
        if ($uris->getSegment(1) == $uri) {
            return $output;
        }
    }
}

function set_active_submenu($uri, $output = 'menu-item-active')
{
    $uris = service('uri');
    $uriSegment = $uris->getSegment(1);

    if (is_array($uri)) {
        foreach ($uri as $u) {
            if ($uriSegment == $u) {
                return $output;
            }
        }
    } else {
        if ($uris->getSegment(1) == $uri) {
            return $output;
        }
    }
}
