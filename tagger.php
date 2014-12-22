<?
/*
	error_reporting(E_ALL);
ini_set('display_errors', '1');

	require("PHP-Stanford-NLP-master/autoload.php");
$pos = new \StanfordNLP\POSTagger(
  'tagger/models/english-left3words-distsim.tagger',
  'tagger/stanford-postagger-3.5.0.jar'
);
$result = $pos->tag(explode(' ', "What does the fox say?"));
var_dump($result);
*/


require('class_Stanford_POS_Tagger.php');
$pos = new Stanford_POS_Tagger();
/*
print_r($pos);
exit;
*/
print_r($pos->array_tag("The cow jumped over the moon and the dish ran away with the spoon."));


?>