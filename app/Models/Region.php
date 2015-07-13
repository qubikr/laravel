<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
	/**
	 * DB table name
	 * @var string
	 */
	protected $table = 'regions';

	/**
	 * Protected attribute
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * mass assingnable attributes
	 * @var array
	 */
	protected $fillable = array(
		'seo_title',
		'seo_description',
		'seo_keywords',
		'name',
		'url',
		'description',
		'html',
	);

	/**
	 * fileds labels
	 * @var array
	 */
	protected $field_labels = array (
		'id' => array (
			'title' => 'id',
			'list' 	=> true,
			'edit'  => false,
			'type'  => 'text',
			'rules' => '',
		),
		'seo_title'	=> array (
			'title' => 'Тег title',
			'list'  => false,
			'edit'  => true,
			'type'  => 'text',
			'rules' => '',
		),
		'seo_description'	=> array (
			'title' => 'Тег description',
			'list'  => false,
			'edit'  => true,
			'type'  => 'textarea',
			'rules' => '',
		),
		'seo_keywords' 		=> array (
			'title' => 'Тег keywords',
			'list'  => false,
			'edit'  => true,
			'type'  => 'textarea',
			'rules' => '',
		),
		'name' 				=> array (
			'title' => 'Название раздела',
			'list'  => true,
			'edit'  => true,
			'type'  => 'text',
			'rules' => 'required',
		),
		'url' 				=> array (
			'title' => 'ЧПУ ссылка',
			'list'  => true,
			'edit'  => true,
			'type'  => 'text',
			'rules' => 'required|alpha_dash',
		),
		'description' 		=> array (
			'title' => 'Описание',
			'list'  => true,
			'edit'  => true,
			'type'  => 'textarea-big',
			'rules' => '',
		),
		'html' 				=> array (
			'title' => 'Страница раздела',	
			'list'  => false,
			'edit'  => true,
			'type'  => 'textarea-big',			
			'rules' => '',
		),
	);


	/**
	 * generate elements list width header
	 * @return array()
	 */
	public function getList()
	{
		$raw = $this->all();

		$data = array();
		$header = array();

		foreach ($this->field_labels as $field => $options) {
			if ($options['list']) {
				$header[] = array('index' => $field, 'title' => $options['title'], 'type' => $options['type']);
			}
		}

		foreach ($raw as $item) {
			$elem = array();
			$elem['values'] = array();
			foreach ($header as $field) {
				$elem['values'][] = $item[$field['index']];
				$elem['id'] = $item['id'];
			}
			$data[] = $elem;
		}

		return array('header' => $header, 'data' => $data);
	}

	/**
	 * Generate template element template
	 * @return array() 
	 */
	public function getTemplate()
	{
		$template = [];

		foreach ($this->field_labels as $field => $options) {
			if ($options['edit']) {
				$template[$field] = $options;
			}
		}

		return $template;
	}

	/**
	 * return validation rules array for validate() method
	 * @return array()
	 */
	public function getValidationRules()
	{
		$rules = [];

		foreach ($this->field_labels as $field => $options) {
			if($options['rules'] !== '') {
				$rules[$field] = $options['rules'];
			}
		}

		return $rules;
	}

	public function getElement($id)
	{
		$template = $this->getTemplate();
		$data = $this->find($id);
		$element = [];

		foreach ($template as $field => $value) {
			$element[$field] = $value;
			$element[$field]['value'] = $data[$field];
		}

		return $element;
	}
}

