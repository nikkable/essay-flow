<?php

class EntityHelper
{
    private static $_cachedEntities = [];

    /**
     * Загружает все сущности указанного класса в память, если они еще не загружены.
     *
     * @param string $modelClass Имя класса модели (например, 'Subjects', 'Periods').
     * @return CActiveRecord[] Массив всех объектов указанного класса.
     */
    private static function loadAllEntities(string $modelClass): array
    {
        if (!isset(self::$_cachedEntities[$modelClass])) {
            if (!class_exists($modelClass) || !is_subclass_of($modelClass, 'CActiveRecord')) {
                throw new InvalidArgumentException("Class {$modelClass} must be a valid CActiveRecord model.");
            }
            self::$_cachedEntities[$modelClass] = CActiveRecord::model($modelClass)->findAll();
        }
        return self::$_cachedEntities[$modelClass];
    }

    /**
     * Возвращает имя сущности по ее коду, языку и классу модели.
     *
     * @param string $modelClass Имя класса модели (например, 'Subjects').
     * @param string $code Код сущности.
     * @param string $lang Язык сущности.
     * @return string|null Имя сущности или null, если не найдено.
     * @throws InvalidArgumentException Если указан недействительный класс модели.
     */
    public static function getEntityNameByCodeAndLang(string $modelClass, string $code, string $lang): ?string
    {
        $allEntities = self::loadAllEntities($modelClass);

        foreach ($allEntities as $entity) {
            if (isset($entity->code) && isset($entity->lang) && isset($entity->name)) {
                if ($entity->code === $code && $entity->lang === $lang) {
                    return $entity->name;
                }
            }
        }

        return null;
    }

    /**
     * Очищает кэш для конкретного класса модели или для всех классов.
     *
     * @param string|null $modelClass Имя класса модели для очистки кэша. Если null, очищает весь кэш.
     */
    public static function clearCache(?string $modelClass = null): void
    {
        if ($modelClass === null) {
            self::$_cachedEntities = [];
        } else {
            unset(self::$_cachedEntities[$modelClass]);
        }
    }
}