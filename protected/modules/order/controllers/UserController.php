<?php


/**
 * Class UserController
 */
class UserController extends \yupe\components\controllers\FrontController
{
    /**
     * @return array
     */
    public function filters()
    {
        return [
            'accessControl',
        ];
    }

    /**
     * @return array
     */
    public function accessRules()
    {
        return [
            ['allow', 'actions' => ['index'], 'users' => ['@'],],
            ['deny', 'users' => ['*'],],
        ];
    }

    /**
     *
     */
    public function actionIndex()
    {
        // Создаем CDbCriteria и сразу добавляем общую жадную загрузку
        $criteria = new CDbCriteria;
        $criteria->limit = 20;
        $criteria->order = 't.date DESC';

        $criteria->with = [
            'products' => [
                'together' => true,
                'with' => [
                    'product' => [
                        'together' => true,
                        'with' => [
                            'subject' => ['alias' => 'subject', 'together' => true],
                            'period',
                            'word',
                            'language'
                        ]
                    ]
                ]
            ]
        ];

        $dataProvider = new CActiveDataProvider('Order', [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => $this->getModule()->perPage
            ]
        ]);

        $currentUserId = Yii::app()->user->getId();
        $user = User::model()->findByPk($currentUserId);

        // Получаем текущий статус из запроса, если он есть
        $requestStatus = Yii::app()->request->getQuery('status');

        // Проверка прав доступа автора и статуса верификации
        if (Yii::app()->user->checkAccess('author')) {
            // Только оплаченные
            $criteria->addCondition('t.paid = :paid');
            $criteria->params[':paid'] = Order::PAID_STATUS_PAID;

            if ($requestStatus) {
                // Если статус передан, то автор видит свои заказы по author_id,
                $criteria->addCondition('t.author_id = :author_id');
                $criteria->params[':author_id'] = $currentUserId;
            } else {
                // Только если автор верифицирован
                if ($user && isset($user->author_verification_status) && $user->author_verification_status == User::AUTHOR_VERIFICATION_VERIFIED) {
                    $criteria->addCondition('t.status_id = :status');
                    $criteria->params[':status'] = OrderStatus::STATUS_NEW;

                    if ($user->subjects) {
                        $allowedSubjects = array_map('trim', $user->subjects);
                        $criteria->addInCondition('subject.code', $allowedSubjects);
                    }
                } else {
                    // Если автор не верифицирован
                    $criteria->addCondition('t.user_id = :nonExistentUser');
                    $criteria->params[':nonExistentUser'] = 0;
                }
            }
        }

        // Дополнительные условия по статусу (применяются после проверки автора)
        if ($requestStatus) {
            if ($requestStatus == Order::STATUS_IN_WORK) {
                $criteria->addCondition('status_id NOT IN (:status_deleted, :status_finished)');
                $criteria->params[':status_deleted'] = OrderStatus::STATUS_DELETED;
                $criteria->params[':status_finished'] = OrderStatus::STATUS_FINISHED;
            } // Готовы
            else if ($requestStatus == Order::STATUS_DONE) {
                $criteria->addCondition('status_id = :status_finished');
                $criteria->params[':status_finished'] = OrderStatus::STATUS_FINISHED;
            } // Для любых других переданных статусов, просто применяем его
            else {
                $criteria->addCondition('t.status_id = :requested_status');
                $criteria->params[':requested_status'] = $requestStatus;
            }
        }

        $dataProvider->setCriteria($criteria);

        $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
}