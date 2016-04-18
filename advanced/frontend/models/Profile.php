<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string $avatar
 * @property string $first_name
 * @property string $second_name
 * @property string $middle_name
 * @property date $birthday
 * @property integer $gender
 *
 * @property User $user
 */
class Profile extends ActiveRecord
{
	public function behaviors()
	{
		return [
				'image' => [
						'class' => 'rico\yii2images\behaviors\ImageBehave',
				]
		];
	}
	/**
	 * @var UploadedFile file attribute
	 */
	public $file;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'profile';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['birthday'], 'date', 'format' => 'php:Y-m-d'],
			[['gender'], 'string'],
			[['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
			[['first_name', 'second_name', 'middle_name'], 'string', 'max' => 32]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'user_id' => 'User ID',
			'avatar' => 'Аватар',
			'first_name' => 'Имя',
			'second_name' => 'Фамилия',
			'middle_name' => 'Отчество',
			'birthday' => 'День Рождения',
			'gender' => 'Пол',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	public function updateProfile()
	{
		if (Profile::findOne(yii::$app->user->id)) {
			$profile = Profile::findOne(yii::$app->user->id);
		} else {
			$profile =  new Profile();
		}
		$profile->user_id = Yii::$app->user->id;
		$profile->first_name = $this->first_name;
		$profile->second_name = $this->second_name;
		$profile->middle_name = $this->middle_name;
		$profile->birthday = $this->birthday;
		$profile->gender = $this->gender;
		/* return $profile->save()?true:false;*/
		if (isset(yii::$app->user->id)) {
			$result = $profile->save();
			return $result;
		}
	}

}
