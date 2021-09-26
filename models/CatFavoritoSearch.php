<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatFavorito;
use app\models\Usuario;

/**
 * CatFavoritoSearch represents the model behind the search form of `app\models\CatFavorito`.
 */
class CatFavoritoSearch extends CatFavorito
{
    public $productoNombre;
    public $usuarioNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fav_id', 'fav_fkproducto', 'fav_fkusuario'], 'integer'],
            [['productoNombre','usuarioNombre'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = CatFavorito::find();

        // add conditions that should always apply here
        $query->joinWith('favFkproducto');
        $query->joinWith('favFkusuario');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'fav_id',
                'fav_fkusuario',
                'fav_fkproducto',
                'productoNombre'=> [
                    'asc'=>['pro_nombre' => SORT_ASC],
                    'desc'=>['pro_nombre' => SORT_DESC],
                    'default'=>SORT_ASC,
                ],
                'usuarioNombre'=> [
                    'asc'=>['usu_nombre' => SORT_ASC],
                    'desc'=>['usu_nombre' => SORT_DESC],
                    'default'=>SORT_ASC,
                ],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'fav_id' => $this->fav_id,
            'fav_fkproducto' => $this->fav_fkproducto,
            'fav_fkusuario' => $this->fav_fkusuario,
        ]);
        $query->andFilterWhere(['like', 'pro_nombre', $this->productoNombre])
        ->andFilterWhere(['like','usu_nombre', $this->usuarioNombre]);
       
        return $dataProvider;
    }
}
