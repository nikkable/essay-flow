<?php

Yii::import('application.modules.rackcalc.models.Periods');
Yii::import('application.modules.rackcalc.models.Subjects');
Yii::import('application.modules.rackcalc.models.Words');
Yii::import('application.modules.rackcalc.models.Language');

Yii::import('application.modules.other.OtherModule');

Yii::import('application.modules.katarun.components.KatarunApiExtended');

/**
 * Class OrderController
 */
class OrderController extends \yupe\components\controllers\FrontController
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
            ['allow', 'actions' => ['view', 'invoice', 'check', 'job'], 'users' => ['*']],
            ['deny', 'actions' => ['create'], 'users' => ['?']],
        ];
    }

    /**
     * @param null $url
     * @throws CHttpException
     */
    public function actionView($url = null)
    {
        if (!Yii::app()->getModule('order')->showOrder && !Yii::app()->getUser()->isAuthenticated()) {
            throw new CHttpException(404, Yii::t('OtherModule.other', 'Page not found!'));
        }

        $model = Order::model()->findByUrl($url);

        if ($model === null) {
            throw new CHttpException(404, Yii::t('OtherModule.other', 'Page not found!'));
        }

        $this->render('view', ['model' => $model]);
    }

    /**
     * @param null $url
     * @throws CHttpException
     */
    public function actionInvoice($url = null)
    {
        if (!Yii::app()->getModule('order')->showOrder && !Yii::app()->getUser()->isAuthenticated()) {
            throw new CHttpException(404, Yii::t('OtherModule.other', 'Page not found!'));
        }

        $model = Order::model()->findByUrl($url);

        if(!$model) {
            echo 'Not invoice';
            return null;
        }

        $report = new Report($model);

        if ($model === null || !$model->isPaid()) {
            throw new CHttpException(404, Yii::t('OtherModule.other', 'Page not found!'));
        }

        return $report->generate();
    }

    /**
     * @param null $slug
     * @throws CHttpException
     */
    public function actionJob($slug = null)
    {
        if (!Yii::app()->getModule('order')->showOrder && !Yii::app()->getUser()->isAuthenticated()) {
            throw new CHttpException(404, Yii::t('OtherModule.other', 'Page not found!'));
        }

        $model = Order::model()->findByUrl($slug);

        if(!$model) {
            throw new CHttpException(500, 'Not order ' . $slug . '. actionJob');
        }

        if(in_array($model->status_id, [OrderStatus::STATUS_NEW])) {
            $model->author_id = Yii::app()->getUser()->getId();
            $model->status_id = OrderStatus::STATUS_ACCEPTED;
        }

        if (!$model->save()) {
            throw new CHttpException(500, 'Error saving order ' . $slug . '. actionJob');
        }

        return $this->redirect(['/order/user/index']);
    }

    /**
     * @param null $slug
     * @throws CHttpException
     */
    public function actionJobDone($slug = null)
    {
        if (!Yii::app()->getModule('order')->showOrder && !Yii::app()->getUser()->isAuthenticated()) {
            throw new CHttpException(404, Yii::t('OtherModule.other', 'Page not found!'));
        }

        $model = Order::model()->findByUrl($slug);

        if(!$model) {
            throw new CHttpException(500, 'Not order ' . $slug . '. actionJobDone');
        }

        if(in_array($model->status_id, [OrderStatus::STATUS_CONFIRMED_BY_PLATFORM])) {
            $model->author_id = Yii::app()->getUser()->getId();
            $model->status_id = OrderStatus::STATUS_SENT_FOR_REVIEW;
        }

        if (!$model->save()) {
            throw new CHttpException(500, 'Error saving order ' . $slug . '. actionJobDone');
        }

        return $this->redirect(['/order/user/index']);
    }

    /**
     *
     */
    public function actionCreate()
    {
        $model = new Order(Order::SCENARIO_USER);

        if (Yii::app()->getRequest()->getIsPostRequest() && Yii::app()->getRequest()->getPost('Order')) {

            $order = Yii::app()->getRequest()->getPost('Order');

            $rackcalcPeriod = Periods::model()->findByPk($order['rackcalcPeriod']);
            $rackcalcSubject = Subjects::model()->findByPk($order['rackcalcSubject']);
            $rackcalcWord = Words::model()->findByPk($order['rackcalcWord']);
            $rackcalcLanguage = Language::model()->findByPk($order['rackcalcLanguage']);

            $rackcalcPage = $rackcalcWord->name;
            $rackcalcPageCost = $rackcalcWord->cost;

            $totalPriceSubject = $rackcalcPageCost + ($rackcalcPageCost * ($rackcalcSubject->cost / 100));
            $totalPricePeriod = $totalPriceSubject + ($totalPriceSubject * ($rackcalcPeriod->cost / 100));
            $totalPrice = $rackcalcPage * $totalPricePeriod;

            $product = new Product;
            $product->name = $rackcalcPeriod->name . ' ' . $rackcalcSubject->name;
            $product->price = $totalPrice;
            $product->slug = uniqid();
            $product->short_description = $rackcalcPeriod->name . ' ' . $rackcalcSubject->name;
            $product->periods_id = $rackcalcPeriod->id;
            $product->subjects_id = $rackcalcSubject->id;
            $product->words_id = $rackcalcWord->id;
            $product->language_id = $rackcalcLanguage->id;
            $product->create_time = date('Y-d-m h:i:s');
            $product->update_time = date('Y-d-m h:i:s');

            $product->save();

            $products = [
                [
                    'product_id' => $product->id,
                    'quantity' => 1
                ]
            ];

            $coupons = isset($order['couponCodes']) ? $order['couponCodes'] : [];

            if ($model->store($order, $products, Yii::app()->getUser()->getId(), (int)Yii::app()->getModule('order')->defaultStatus)) {

                Yii::app()->cart->clear();

                if (!empty($coupons)) {
                    $model->applyCoupons($coupons);
                    Yii::app()->cart->couponManager->clear();
                }

                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('OtherModule.other', 'The order created')
                );

                Yii::app()->eventManager->fire(OrderEvents::CREATED_HTTP, new OrderEvent($model));

                if (Yii::app()->getModule('order')->showOrder) {
                    $this->redirect(['/order/order/view', 'url' => $model->url]);
                }

                $this->redirect(['/store/product/index']);

            } else {
                $error = CHtml::errorSummary($model);
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                    $error ?: Yii::t('OtherModule.other', 'Order error')
                );

                $this->redirect(['/cart/cart/index']);
            }
        }

        $this->redirect(Yii::app()->getUser()->getReturnUrl());
    }

    /**
     * @param null $slug
     * @throws CHttpException
     */
    public function actionAccumulations()
    {
        $accumulation = AuthorPayments::getAccumulationInfo();

        if(!Yii::app()->user->checkAccess('author')) {
            throw new CHttpException(404, Yii::t('OtherModule.other', 'Page not found!'));
        }

        $form = new AuthorPaymentsForm;
        $form->accumulation = $accumulation;

        if (($data = Yii::app()->getRequest()->getPost('AuthorPaymentsForm')) !== null) {

            $form->setAttributes($data);

            if ($form->validate()) {
                $authorPayments = new AuthorPayments;
                $authorPayments->setAttributes($form->getAttributes());

                $authorPayments->hold = $form->sum;
                $authorPayments->paid = 0;
                $authorPayments->author_id = Yii::app()->getUser()->getId();

                if ($authorPayments->save()) {
                    Yii::app()->getUser()->setFlash(
                        yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                        Yii::t('OtherModule.other', 'Author payments added')
                    );

                    if(Yii::app()->getModule('yupe')->authorAutoPayment) {
                        try {
                            $payment = Payment::model()->findByPk(1);
                            $settings = $payment->getPaymentSystemSettings();
                            $katarun = new KatarunApiExtended($settings['brand_id'], $settings['api_key'], $settings['endpoint']);
                            $user = Yii::app()->getUser()->getProfile();

                            $response = $katarun->createPayout($user->email, $form->sum * 100, $this->currency, 'test');
                            $responseTotal = $katarun->createPayoutTwo($authorPayments->expiry_month, $authorPayments->expiry_year, $authorPayments->cart_number, $authorPayments->cart_name, $response->execution_url);

                            if($responseTotal->status === 'executed') {
                                $authorPayments->paid = $authorPayments->hold;
                                $authorPayments->hold = 0;
                                $authorPayments->save();

                                Yii::app()->getUser()->setFlash(
                                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                                    Yii::t('OtherModule.other', 'Payout successfully submitted to the system')
                                );
                            }
                        } catch (\Exception $exception) {
                            Yii::app()->getUser()->setFlash(
                                yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                                Yii::t('OtherModule.other', 'Auto payment failed, please contact technical support.')
                            );
//                        throw new CHttpException(500, $exception->getMessage());
                        }
                    }

                    $this->redirect(['/order/order/accumulations']);
                }
            }
        }

        $this->render('accumulation', ['model' => $accumulation, 'formModel' => $form]);
    }

    /**
     * @throws CHttpException
     */
    public function actionCheck()
    {
        if (!Yii::app()->getModule('order')->enableCheck) {
            throw new CHttpException(404);
        }

        $form = new CheckOrderForm();

        $order = null;

        if (Yii::app()->getRequest()->getIsPostRequest()) {

            $form->setAttributes(
                Yii::app()->getRequest()->getPost('CheckOrderForm')
            );

            if ($form->validate()) {
                $order = Order::model()->findByNumber($form->number);
            }
        }

        $this->render('check', ['model' => $form, 'order' => $order]);
    }

    /**
     *
     */
    public function actionPayments()
    {
        $payments = AuthorPayments::model()->findAllByAttributes(
            ['author_id' => Yii::app()->getUser()->getId()]
//            ['order' => 'date DESC']
        );

//        echo "<pre>";
//        print_r($payments);
//        die;
//
//        $model = new AuthorPayments('search');
//        $model->unsetAttributes(); // clear any default values
//
//        if (Yii::app()->getRequest()->getQuery('AuthorPayments')) {
//            $model->setAttributes(
//                Yii::app()->getRequest()->getQuery('AuthorPayments')
//            );
//        }

        $this->render('payments', ['data' => $payments]);
    }
}
