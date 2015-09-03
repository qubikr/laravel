<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

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
		'gender',
		'description',
		'html',
	);


	/**
	 * number of elements on single page
	 */
	protected $pageLength = 20;

	/**
	 * fileds labels
	 * @var array
	 */
	protected $field_labels = array (
		array (
			'title' => 'Основные свойства',
			'code' => 'base',
			'sort' => 1,
			'selected' => true,
			'fields' => array(
				'id' => array (
					'title' => 'id',
					'list' 	=> true,
					'edit'  => false,
					'type'  => 'text',
					'rules' => '',
				),
				'name' => array (
					'title' => 'Название раздела',
					'list'  => true,
					'edit'  => true,
					'type'  => 'text',
					'rules' => 'required',
				),
				'url' => array (
					'title' => 'ЧПУ ссылка',
					'list'  => true,
					'edit'  => true,
					'type'  => 'text',
					'rules' => 'required|alpha_dash',
				),
				'gender' => array (
					'title' => 'Половозрастная привязка',
					'list'  => false,
					'edit'  => true,
					'type'  => 'gender',
					'rules' => 'required'
				),
				'description' => array (
					'title' => 'Описание',
					'list'  => true,
					'edit'  => true,
					'type'  => 'textarea-big',
					'rules' => '',
				),
				'html' => array (
					'title' => 'Страница раздела',	
					'list'  => false,
					'edit'  => true,
					'type'  => 'textarea-big',			
					'rules' => '',
				),
			),	
		),
		array (
			'title' => 'Seo',
			'code' => 'seo',
			'sort' => 2,
			'selected' => false,
			'fields' => array(
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
			),
		),
	);


	/**
	 * generate elements list width header
	 * @return array()
	 */
	public function getList($page)
	{

		$data = array();
		$header = array();

		Paginator::currentPageResolver(function() use ($page) {
			return $page;
		});

		$raw = $this->paginate($this->pageLength);

		$paginator = array(
			'currentPage' => $page,
			'count'	  => $raw->lastPage(),
		);

		$raw->all();

		foreach ($this->field_labels as $group) {
			foreach ($group['fields'] as $field => $options) {
				if ($options['list']) {
					$header[] = array('index' => $field, 'title' => $options['title'], 'type' => $options['type']);
				}
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


		return array('header' => $header, 'data' => $data, 'pagination' => $paginator);
	}

	/**
	 * Generate template element template
	 * @return array() 
	 */
	public function getTemplate()
	{
		$template = [];

		foreach ($this->field_labels as $group) {
			$template[$group['code']] = array(
					'title' => $group['title'],
					'selected' => $group['selected'],
					'fields' => array(),
				);
			foreach ($group['fields'] as $field => $options) {
				if ($options['edit']) {
					$template[$group['code']]['fields'][$field] = $options;
				}
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

		foreach ($this->field_labels as $group) {
			foreach ($group['fields'] as $field => $options) {
				if($options['rules'] !== '') {
					$rules[$field] = $options['rules'];
				}
			}
		}

		return $rules;
	}

	public function getElement($id)
	{
		$template = $this->getTemplate();
		$data = $this->find($id);
		$element = [];

		foreach ($template as $code => $group) {			
			$element[$code] = array(
					'title' => $group['title'],
					'selected' => $group['selected'],
					'fields' => array(),
				);
			foreach ($group['fields'] as $field => $value) {
				$element[$code]['fields'][$field] = $value;
				$element[$code]['fields'][$field]['value'] = $data[$field];
			}
		}

		return $element;
	}
}

