--TEST--
PDO_Firebird: cursor should not be marked as opened on singleton statements
--SKIPIF--
<?php if (!extension_loaded('pdo_firebird')) die('skip'); ?>
--FILE--
<?php
require 'testdb.inc';

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
@$dbh->exec('drop table ta_table');
$dbh->exec('create table ta_table (id integer)');
$S = $dbh->prepare('insert into ta_table (id) values (:id) returning id');
$S->execute(['id' => 1]);
$S->execute(['id' => 2]);
unset($S);
unset($dbh);
echo 'OK';
?>
--EXPECT--
OK
