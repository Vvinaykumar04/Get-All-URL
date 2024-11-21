<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="get">
        <input type="url" value="<?= @$_GET['url'] ?>" name="url" id="" placeholder="Enter URL">
        <input type="submit" value="Submit">
    </form>
    <?php
    if (isset($_GET['url'])) {
        // $data = file_get_contents('url.html');
        $data=file_get_contents($_GET['url']);
        // file_put_contents('url.html',$data);
        
        
        $data = strip_tags($data, "<a>");
        $d = (preg_split("/<\/a>/", $data));
        $mainHost = parse_url($_GET['url'])['host'];
        if (count($d)) {
            echo '<table border="2">';
            echo '<tr>';
            echo '<td>URL</td>';
            echo '<td>Type</td>';
            echo '</tr>';
            foreach ($d as $k => $u) {
                $u = trim($u);
                if (strpos($u, "<a href=") !== FALSE) {
                    $u = preg_replace("/.*<a\s+href=\"/sm", "", $u);
                    $u = @mb_split(">", $u)[0];
                    $u = preg_replace("/\".*/", "", $u);
                    if(strpos($u, 'tel:') !== 0 && strpos($u, 'javascript') !== 0 && $u != '/' && $u != '#'){
                        
                        $urlHost = parse_url($u);
                        if(isset($urlHost['host']) && $urlHost['host'] != $mainHost ){
                            
                        }else{
                            echo '<tr>';
                            echo "<td>$u</td>";
                            // echo '<td>'.(strpos($u, basename(path: ($_GET['url']))) || $u == "#"?'Internal':'External').'</td>';
                            // echo '<td>'.(  json_encode(parse_url($u))).'</td>';
                            // echo '<td>'.( strpos($u, 'tel')).'</td>';
                            echo '<td>'.(isset($urlHost['host']) && $urlHost['host'] != $mainHost ? 'External':'Internal').'</td>';
                            echo '</tr>';
                            
                        }
                    }

                }
            }
            echo '</table>';

        }

    }
    ?>
</body>

</html>