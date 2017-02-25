<?php

namespace Previewtechs\Database\MySQL\Tests;

interface PDOMockInterface
{
    public function query($query);

    public function bind($param, $value, $type);

    public function execute();

    public function resultSet();

    public function single();

    public function count();

    public function lastInsertedId();

    public function beginTransaction();

    public function endTransaction();

    public function cancelTransaction();

    public function debugDumpsParams();
}
