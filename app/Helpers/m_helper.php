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

function get_geotag($tmp)
{
    $data = @exif_read_data($tmp, 0, true);

    if ((isset($data['GPS']) and is_array($data['GPS'])) and (isset($data['GPS']['GPSLatitudeRef']))) {
        $lat_ref = $data['GPS']['GPSLatitudeRef'];
        $lat = $data['GPS']['GPSLatitude'];
        list($num, $dec) = explode('/', $lat[0]);
        $lat_s = $num / $dec;
        list($num, $dec) = explode('/', $lat[1]);
        $lat_m = $num / $dec;
        list($num, $dec) = explode('/', $lat[2]);
        $lat_v = $num / $dec;

        $lng_ref = $data['GPS']['GPSLongitudeRef'];
        $lng = $data['GPS']['GPSLongitude'];
        list($num, $dec) = explode('/', $lng[0]);
        $lng_s = $num / $dec;
        list($num, $dec) = explode('/', $lng[1]);
        $lng_m = $num / $dec;
        list($num, $dec) = explode('/', $lng[2]);
        $lng_v = $num / $dec;

        $lat_int = ($lat_s + $lat_m / 60.0 + $lat_v / 3600.0);
        $lat_int = ($lat_ref == 'S') ? '-' . $lat_int : $lat_int;

        $lng_int = ($lng_s + $lng_m / 60.0 + $lng_v / 3600.0);
        $lng_int = ($lng_ref == 'W') ? '-' . $lng_int : $lng_int;

        return array('lat' => $lat_int, 'lng' => $lng_int);
    } else {
        return array('lat' => 0, 'lng' => 0);
    }
}


if (!function_exists('roleAkses')) {

    function roleAksesMenu($id, $menu)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT d.nama as nama_user, b.role, c.menu, a.lihat, a.tambah, a.ubah, a.hapus FROM menu_role a JOIN role b on a.idrole=b.idrole JOIN menu c on a.idmenu=c.idmenu join user d on b.idrole=d.idrole where a.deleted_at is null and d.iduser ='$id' and c.menu IN $menu GROUP BY a.idmenurole ORDER by d.nama ASC";

        $query = $db->query($sql);
        $row = $query->getRow();

        if (isset($row)) {
            if ($row->lihat == '1') {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}

if (!function_exists('roleAkses')) {

    function roleAkses($id, $menu)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT d.nama as nama_user, b.role, c.menu, a.lihat, a.tambah, a.ubah, a.hapus FROM menu_role a JOIN role b on a.idrole=b.idrole JOIN menu c on a.idmenu=c.idmenu join user d on b.idrole=d.idrole where a.deleted_at is null and d.iduser ='$id' and c.menu ='$menu' GROUP BY a.idmenurole ORDER by d.nama ASC";

        $query = $db->query($sql);
        $row = $query->getRow();

        if (isset($row)) {
            if ($row->lihat == '1') {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}
