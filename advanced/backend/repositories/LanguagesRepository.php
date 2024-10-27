<?php

namespace backend\repositories;

use yii\web\NotFoundHttpException;
use backend\models\Languages;

class LanguagesRepository
{
    private Languages $model;

    public function __construct(Languages $model)
    {
        $this->model = $model;
    }

    /**
     * Finds the Language model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Languages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = Languages::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested model does not exist.');
    }

    /**
     * Finds user by Languages
     *
     * @param string $language
     * @return Languages|null
     */
    public function findByLanguages($language)
    {
        return Languages::findOne(['name' => $language]);
    }

    /**
     * Returns all languages.
     * @return Languages[]
     */
    public function findAllLanguages()
    {
        return Languages::find()->all();
    }
}
