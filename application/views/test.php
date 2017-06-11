<?
$ob = $lt->result_array()[0]['contents'];

print_r($ob);
$result = iscontents($ob,'youtube');
echo 'result : ';
print_r($result);
?>