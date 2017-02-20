<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/20
 * Time: 11:07
 */

namespace Vendor\Core;


interface Database
{
    public function connect();
    public function query();
    public function where();
    public function insert();
    public function insertGetId();
    public function update();
    public function delete();
    public function limit();
    public function orderBy();
    public function groupBy();
    public function get();
    public function first();
    public function close();
}