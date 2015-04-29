<?php
/**
 * Import dishes from file
 * User: Mihail Kornilov <fix-06 at yandex.ru>
 * Date: 04.04.15
 * Time: 1:50
 *
 * @since 1.0
 */

namespace app\controllers\components;
use yii\log\Logger;

/**
 * Class DishImport
 *
 * @package app\controllers\components
 */
class DishImport {
    protected $filePath;

    /**
     * Loaded file
     *
     * @var \PHPExcel
     */
    protected $file;

    /**
     * Hash with imported dishes
     *
     * @var array
     */
    protected $dishes;

    /**
     * Constructor
     *
     * @use DishImport::load()
     * @use DishImport::parse()
     *
     * @param string $filePath path to file from what being imports
     * @throws \RuntimeException
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;

        if ( ! file_exists($this->filePath) || is_dir($this->filePath) ) {
            throw new \RuntimeException('Импорт файла невозможен, файла с таким именем не существует: ' . $this->filePath);
        }

        $this->load();

        $this->parse();
    }

    /**
     * Load file data
     */
    protected function load()
    {
        $this->file = \PHPExcel_IOFactory::load($this->filePath);
    }

    /**
     * Parse loaded data and push it to DishImport::dishes hash
     */
    protected function parse()
    {
        set_time_limit(20);
        \Yii::$app->log->logger->log('Начинается разбор файла', Logger::LEVEL_INFO);
        $sheets = $this->file->getAllSheets();
        $excludes = [
            mb_convert_encoding('завтрак', 'utf-8'),
            mb_convert_encoding('2-ой завтрак', 'utf-8'),
            mb_convert_encoding('обед', 'utf-8'),
            mb_convert_encoding('полдник', 'utf-8'),
            mb_convert_encoding('итого на 1 человека', 'utf-8'),
            mb_convert_encoding('цена', 'utf-8'),
            mb_convert_encoding('стоимость', 'utf-8'),
        ];

        // Перебор всех листов в документе
        foreach ($sheets as $sheet) {
            \Yii::$app->log->logger->log('Разбор листа ' . $sheet->getTitle(), Logger::LEVEL_INFO);
            $rows = $sheet->getRowIterator();
            $ingridients = array();
            $dishCoordinate = false;

            // Перебор всех строк на листе
            foreach ($rows as $row) {
                /**
                 * @var $row \PHPExcel_Worksheet_Row
                 */
                $cells = $row->getCellIterator();
                \Yii::getLogger()->log($row->getRowIndex(), Logger::LEVEL_INFO);
                $isHeader = false;
                $dishName = 'default dish name';

                // Перебор всех ячеек в строке
                foreach ($cells as $cell) {
                    /**
                     * @var $cell \PHPExcel_Cell
                     */
                    $cellValue = $cell->getOldCalculatedValue();
                    \Yii::getLogger()->log($cellValue, Logger::LEVEL_INFO);
                    $cellCoordinate = $cell->getColumn();

                    // Если строка - это шапка таблицы
                    if ($isHeader) {
                        \Yii::$app->log->logger->log('Шапка таблицы', Logger::LEVEL_INFO);
                        // Читаем названия ингридиентов
                        if ( (strtolower($cellValue) != mb_convert_encoding('выход', 'utf-8')) && (! empty($cellValue) ) ) {
                            $ingridients[$cellCoordinate] = $cellValue;
                        }
                    } else {
                        // Если колонка содержит названия блюд - сохраняем блюда в массив
                        if ($cellCoordinate === $dishCoordinate) {
                            \Yii::$app->log->logger->log('Первая колонка', Logger::LEVEL_INFO);
                            // Если значение ячейки в первой колонке есть и оно не является названием периода приема пищи
                            if ($cellValue && ( ! in_array($cellValue, $excludes) )) {
                                \Yii::$app->log->logger->log('Название блюда', Logger::LEVEL_INFO);
                                $this->dishes[$cellValue] = array();
                                $dishName = $cellValue;
                                continue;
                            }
                        // Колонка содержит количественную характеристику ингридиента
                        } else {
                            if ($cellValue && array_key_exists($cellCoordinate, $ingridients)) {
                                $this->dishes[$dishName][$ingridients[$cellCoordinate]] = $cellValue;
                            }
                        }
                    }

                    if (strtolower($cellValue) == mb_convert_encoding('наименование блюда', 'utf-8')) {
                        $isHeader = true;
                        $dishCoordinate = $cellCoordinate;
                    }
                }
            }
        }
    }

    /**
     * Returns dishes and it's consist
     *
     * @return array
     */
    public function getImportedDishes()
    {
        return $this->dishes;
    }
} 