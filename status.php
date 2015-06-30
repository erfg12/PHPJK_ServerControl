<?PHP
include ("include.php");

$gq->setOption('timeout', 200);

$gq->setFilter('normalise');
$gq->setFilter('sortplayers', 'gq_ping');

$gamequery = $gq->requestData();

function print_results($gamequery) {
    foreach ($gamequery as $id => $data) {
		if ($id != $_GET['id'])
			continue;
			
        print_table($data);
    }
}

function print_table($data) {
    $gqs = array('gq_online', 'gq_address', 'gq_port', 'gq_prot', 'gq_type');
    if (!$data['gq_online']) {
        printf("<p>The server did not respond within the specified time.</p>\n");
        return;
    }
    print("<table><thead><tr><td>Variable</td><td>Value</td></tr></thead><tbody>\n");
    foreach ($data as $key => $val) {
        if (is_array($val)) continue;
        $cls = empty($cls) ? ' class="uneven"' : '';
        if (substr($key, 0, 3) == 'gq_') {
            $kcls = (in_array($key, $gqs)) ? 'always' : 'normalise';
            $key = sprintf("<span class=\"key-%s\">%s</span>", $kcls, $key);
        }
        printf("<tr%s><td>%s</td><td>%s</td></tr>\n", $cls, $key, $val);
    }
    print("</tbody></table>\n");
	echo '<hr><h2>Current Players</h2>';
	foreach ($data['players'] as $player){
		echo '<div>'.$player['gq_name'].' [SCORE:'.$player['gq_score'].'] [PING:'.$player['gq_ping'].']</div>';
	}
}

print_results($gamequery);
