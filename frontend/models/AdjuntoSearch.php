<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Adjunto;

/**
 * AdjuntoSearch represents the model behind the search form about `frontend\models\Adjunto`.
 */
class AdjuntoSearch extends Adjunto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_adjunto', 'id_formulario'], 'integer'],
            [['nombre_archivo', 'nombre_original', 'fecha_subida'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Adjunto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_adjunto' => $this->id_adjunto,
            'id_formulario' => $this->id_formulario,
            'fecha_subida' => $this->fecha_subida,
        ]);

        $query->andFilterWhere(['like', 'nombre_archivo', $this->nombre_archivo])
            ->andFilterWhere(['like', 'nombre_original', $this->nombre_original]);

        return $dataProvider;
    }
}
