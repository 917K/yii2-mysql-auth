<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserAdmin;
use common\models\User;

/**
 * UserAdminSearch represents the model behind the search form about `\backend\models\UserAdmin`.
 */
class UserAdminSearch extends UserAdmin
{

    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'admin_role_id'], 'integer'],
            [['created_at, username'], 'safe'],
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
        $query = UserAdmin::find();
        $query->joinWith('user');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'admin_role_id' => $this->admin_role_id,
            'created_at' => $this->created_at,
        ]);
        /*$query->andFilterWhere(['like', 'user.username', $this->username]);
        $query->joinWith(['user' => function ($q) {
                //\common\helpers\Dev::dump($this->user);exit;
            $q->andFilterWhere(['like', 'user.username', $this->username]);
        }]);*/

        return $dataProvider;
    }
}