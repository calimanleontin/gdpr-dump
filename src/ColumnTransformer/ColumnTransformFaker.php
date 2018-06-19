<?php

namespace machbarmacher\GdprDump\ColumnTransformer;

use Faker\Factory;
use Faker\Provider\Base;

class ColumnTransformFaker extends ColumnTransformer
{

    private static $factory;

    private $formatter;


    public function __construct($tableName, $columnName, $expression)
    {
        parent::__construct($tableName, $columnName, $expression);
        if (!isset(self::$factory)) {
            self::$factory = Factory::create();
        }

        if (!isset($expression['formatter'])) {
            throw new ParseExpressionException("Invalid Faker provider for table:{$tableName} column:{$columnName}");
        }

        $this->formatter = $expression['formatter'];
    }

    public function getValue($uniqueId = null)
    {
        return self::$factory->format($this->formatter);
    }
}