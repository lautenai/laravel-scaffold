<?php echo '<?php'.PHP_EOL; ?>

class <?php echo $plural_class; ?>_Controller extends <?php echo $controller; ?> {

	/**
	 * The layout being used by the controller.
	 *
	 * @var string
	 */
	public $layout = 'templates.scaffold';

	/**
	 * Indicates if the controller uses RESTful routing.
	 *
	 * @var bool
	 */
	public $restful = true;

	/**
	 * View all of the <?php echo $plural; ?>.
	 *
	 * @return void
	 */
	public function get_index()
	{
		//Authorized::check('<?php echo $nested_path.$plural; ?>', 'index', Auth::user()->id);

<?php if($has_relationships): ?>
		$<?php echo $plural; ?> = <?php echo $singular_class; ?>::with(array(<?php echo $with; ?>))->paginate(25);
<?php else: ?>
		$<?php echo $plural; ?> = <?php echo $singular_class; ?>::paginate(25);
<?php endif; ?>

		$this->layout->title   = '<?php echo ucwords(str_replace('_', ' ', $plural_class)); ?>';
		$this->layout->content = View::make('<?php echo $nested_view.$plural; ?>.index')->with('<?php echo $plural; ?>', $<?php echo $plural; ?>);
	}

	/**
	 * Show the form to adicionar a new <?php echo $singular; ?>.
	 *
	 * @return void
	 */
	public function get_adicionar(<?php echo $belongs_to_params; ?>)
	{
		//Authorized::check('<?php echo $nested_path.$plural; ?>', 'adicionar', Auth::user()->id);
<?php foreach($belongs_to as $model): ?>				
		$<?php echo $model; ?> = array('' => 'SELECIONE') + <?php echo ucfirst($model); ?>::order_by('id', 'asc')->take(999999)->lists('nome', 'id');
<?php endforeach; ?>

		$this->layout->title   = 'Novo <?php echo str_replace('_', ' ', $singular_class); ?>';
<?php if(count($belongs_to) == 0): ?>
		$this->layout->content = View::make('<?php echo $nested_view.$plural; ?>.adicionar');
<?php else: ?>
		$this->layout->content = View::make('<?php echo $nested_view.$plural; ?>.adicionar', array(
<?php foreach($belongs_to as $model): ?>
									'<?php echo $model; ?>_id' => $<?php echo $model; ?>_id,
<?php endforeach; ?>
<?php foreach($belongs_to as $model): ?>
									'<?php echo $model; ?>' => $<?php echo $model; ?>,
<?php endforeach; ?>
									));
<?php endif; ?>
	}

	/**
	 * Create a new <?php echo $singular; ?>.
	 *
	 * @return Response
	 */
	public function post_adicionar()
	{
		//Authorized::check('<?php echo $nested_path.$plural; ?>', 'adicionar', Auth::user()->id);

		$validation = Validator::make(Input::all(), array(
<?php foreach($fields as $field => $type): ?>
			'<?php echo $field; ?>' => array(<?php if($type == 'boolean'): ?>
'in:0,1'<?php elseif($type == 'string'): ?>
'required'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php elseif($type == 'integer'): ?>
'required', 'integer'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php elseif($type == 'float'): ?>
'required', 'numeric'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php else: ?>
'required'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php endif; ?>),
<?php endforeach; ?>
		));

		if($validation->valid())
		{
			$<?php echo $singular; ?> = new <?php echo $singular_class; ?>;

<?php foreach($fields as $field => $type): ?>
<?php if($type != 'boolean' AND $type != 'date'): ?>
			$<?php echo $singular; ?>-><?php echo $field; ?> = Input::get('<?php echo $field; ?>');
<?php elseif($type == 'date'): ?>
			$<?php echo $singular; ?>-><?php echo $field; ?> = DateBR::toMysql(Input::get('<?php echo $field; ?>'));
<?php else: ?>
			$<?php echo $singular; ?>-><?php echo $field; ?> = Input::get('<?php echo $field; ?>', '0');
<?php endif; ?>
<?php endforeach; ?>

			$<?php echo $singular; ?>->save();

			Session::flash('message', 'Adicionado <?php echo strtoupper(str_replace('_', ' ', $singular)); ?> #'.$<?php echo $singular; ?>->id);

			return Redirect::to('<?php echo $nested_path.$plural; ?>');
		}

		else
		{
			return Redirect::to('<?php echo $nested_path.$plural; ?>/adicionar')
							->with_errors($validation->errors)
							->with_input();
		}
	}

	/**
	 * View a specific <?php echo $singular; ?>.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_exibir($id)
	{
		//Authorized::check('<?php echo $nested_path.$plural; ?>', 'exibir', Auth::user()->id);

<?php if($has_relationships): ?>
		$<?php echo $singular; ?> = <?php echo $singular_class; ?>::with(array(<?php echo $with; ?>))->find($id);
<?php else: ?>
		$<?php echo $singular; ?> = <?php echo $singular_class; ?>::find($id);
<?php endif; ?>

		if(is_null($<?php echo $singular; ?>))
		{
			return Redirect::to('<?php echo $nested_path.$plural; ?>');
		}

<?php foreach($belongs_to as $model): ?>
		$<?php echo $model; ?> = array('' => 'SELECIONE') + <?php echo ucfirst($model); ?>::order_by('id', 'asc')->take(999999)->lists('nome', 'id');
<?php endforeach; ?>

		$this->layout->title   = 'Exibindo <?php echo str_replace('_', ' ', $singular_class); ?> #'.$id;
		$this->layout->content = View::make('<?php echo $nested_view.$plural; ?>.exibir')->with('<?php echo $singular; ?>', $<?php echo $singular; ?>)<?php foreach($belongs_to as $model): ?>->with('<?php echo $model; ?>', $<?php echo $model; ?>)<?php endforeach; ?>;
	}

	/**
	 * Show the form to edit a specific <?php echo $singular; ?>.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_editar($id)
	{
		//Authorized::check('<?php echo $nested_path.$plural; ?>', 'editar', Auth::user()->id);

		$<?php echo $singular; ?> = <?php echo $singular_class; ?>::find($id);

		if(is_null($<?php echo $singular; ?>))
		{
			return Redirect::to('<?php echo $nested_path.$plural; ?>');
		}
<?php foreach($belongs_to as $model): ?>
		$<?php echo $model; ?> = array('' => 'SELECIONE') + <?php echo ucfirst($model); ?>::order_by('id', 'asc')->take(999999)->lists('nome', 'id');
<?php endforeach; ?>

		$this->layout->title   = 'Editando <?php echo str_replace('_', ' ', $singular_class); ?> #'.$id;
		$this->layout->content = View::make('<?php echo $nested_view.$plural; ?>.editar')->with('<?php echo $singular; ?>', $<?php echo $singular; ?>)<?php foreach($belongs_to as $model): ?>->with('<?php echo $model; ?>', $<?php echo $model; ?>)<?php endforeach; ?>;
	}

	/**
	 * Edit a specific <?php echo $singular; ?>.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_editar($id)
	{
		//Authorized::check('<?php echo $nested_path.$plural; ?>', 'editar', Auth::user()->id);

		$validation = Validator::make(Input::all(), array(
<?php foreach($fields as $field => $type): ?>
			'<?php echo $field; ?>' => array(<?php if($type == 'boolean'): ?>
'in:0,1'<?php elseif($type == 'string'): ?>
'required'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php elseif($type == 'integer'): ?>
'required', 'integer'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php elseif($type == 'float'): ?>
'required', 'numeric'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php else: ?>
'required'<?php if(isset($size[$field])): ?>, 'max:<?php echo $size[$field]; ?>'<?php endif; ?><?php endif; ?>),
<?php endforeach; ?>
		));

		if($validation->valid())
		{
			$<?php echo $singular; ?> = <?php echo $singular_class; ?>::find($id);

			if(is_null($<?php echo $singular; ?>))
			{
				return Redirect::to('<?php echo $nested_path.$plural; ?>');
			}

<?php foreach($fields as $field => $type): ?>
<?php if($type == 'date'): ?>
			$<?php echo $singular; ?>-><?php echo $field; ?> = DateBR::toMysql(Input::get('<?php echo $field; ?>'));
<?php else: ?>
			$<?php echo $singular; ?>-><?php echo $field; ?> = Input::get('<?php echo $field; ?>');
<?php endif; ?>
<?php endforeach; ?>

			$<?php echo $singular; ?>->save();

			Session::flash('message', 'Atualizado <?php echo strtoupper(str_replace('_', ' ', $singular)); ?> #'.$<?php echo $singular; ?>->id);

			return Redirect::to('<?php echo $nested_path.$plural; ?>');
		}

		else
		{
			return Redirect::to('<?php echo $nested_path.$plural; ?>/editar/'.$id)
							->with_errors($validation->errors)
							->with_input();
		}
	}

	/**
	 * Delete a specific <?php echo $singular; ?>.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_excluir($id)
	{
		//Authorized::check('<?php echo $nested_path.$plural; ?>', 'excluir', Auth::user()->id);

		$<?php echo $singular; ?> = <?php echo $singular_class; ?>::find($id);

		if( ! is_null($<?php echo $singular; ?>))
		{
			$<?php echo $singular; ?>->delete();

			Session::flash('message', 'Excluído <?php echo strtoupper(str_replace('_', ' ', $singular)); ?> #'.$<?php echo $singular; ?>->id);
		}

		return Redirect::to('<?php echo $nested_path.$plural; ?>');
	}

	/**
	 * Checkbox delete to selected <?php echo $plural; ?>.
	 *
	 * @return Response
	 */
	public function post_checkbox()
	{
		//Authorized::check('<?php echo $nested_path.$plural; ?>', 'excluir', Auth::user()->id);

		$checkboxes = Input::get('checkbox');

		if(!Input::has('checkbox')){ Session::flash('message', 'Nenhum item selecionado.'); return Redirect::to('<?php echo $nested_path.$plural; ?>'); }

		<?php echo $singular_class; ?>::where_in('id', $checkboxes)->delete();

		Session::flash('message', 'Excluídos');

		return Redirect::to('<?php echo $nested_path.$plural; ?>');
	}
}