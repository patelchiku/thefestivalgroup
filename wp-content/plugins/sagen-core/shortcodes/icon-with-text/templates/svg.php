<?php
$params['svg_source'] = urldecode(base64_decode($params['svg_source']));
echo sagen_select_get_module_part( $params['svg_source'] );
