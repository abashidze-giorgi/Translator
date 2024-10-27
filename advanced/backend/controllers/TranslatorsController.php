<?php

namespace backend\controllers;

use backend\models\Translators;
use backend\models\TranslatorsSearch;
use backend\repositories\LanguagesRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Connection;

/**
 * TranslatorsController implements the CRUD actions for Translators model.
 */
class TranslatorsController extends Controller
{
    private LanguagesRepository $languageRepository;

    public function __construct(
        $id,
        $module,
        LanguagesRepository $languageRepository,
        $config = []
    ) {
        $this->languageRepository = $languageRepository;
        parent::__construct($id, $module, $config);
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Translators models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TranslatorsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $languages = $this->languageRepository->findAllLanguages();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'languagesFrom' => $languages,
            'languagesTo' => $languages,
        ]);
    }

    /**
     * Displays a single Translators model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Translators model.
     * @param Connection $db
     * @return string|\yii\web\Response
     */
    public function actionCreate(Connection $db)
    {
        $model = new Translators();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $db->createCommand()->insert('translators', [
                'name' => $model->name,
                'email' => $model->email,
                'available_weekdays' => $model->available_weekdays,
                'available_weekends' => $model->available_weekends,
                'language_from_id' => $model->language_from_id,
                'language_to_id' => $model->language_to_id,
            ])->execute();

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Translators model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Translators model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Translators model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Translators the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Translators::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
