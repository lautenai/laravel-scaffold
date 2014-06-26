<?php

class Testes_Controller extends Base_Controller {

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
	 * View all of the testes.
	 *
	 * @return void
	 */
	public function get_index()
	{
		//Authorized::check('testes', 'index', Auth::user()->id);

		$testes = Teste::paginate(25);

		$this->layout->title   = 'Testes';
		$this->layout->content = View::make('testes.index')->with('testes', $testes);
	}

	/**
	 * Show the form to adicionar a new teste.
	 *
	 * @return void
	 */
	public function get_adicionar()
	{
		//Authorized::check('testes', 'adicionar', Auth::user()->id);

		$this->layout->title   = 'Novo Teste';
		$this->layout->content = View::make('testes.adicionar');
	}

	/**
	 * Create a new teste.
	 *
	 * @return Response
	 */
	public function post_adicionar()
	{
		//Authorized::check('testes', 'adicionar', Auth::user()->id);

		$validation = Validator::make(Input::all(), array(
			'nome' => array('required'),
		));

		if($validation->valid())
		{
			$teste = new Teste;

			$teste->nome = Input::get('nome');

			$teste->save();

			Session::flash('message', 'Adicionado TESTE #'.$teste->id);

			return Redirect::to('testes');
		}

		else
		{
			return Redirect::to('testes/adicionar')
							->with_errors($validation->errors)
							->with_input();
		}
	}

	/**
	 * View a specific teste.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_exibir($id)
	{
		//Authorized::check('testes', 'exibir', Auth::user()->id);

		$teste = Teste::find($id);

		if(is_null($teste))
		{
			return Redirect::to('testes');
		}


		$this->layout->title   = 'Exibindo Teste #'.$id;
		$this->layout->content = View::make('testes.exibir')->with('teste', $teste);
	}

	/**
	 * Show the form to edit a specific teste.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_editar($id)
	{
		//Authorized::check('testes', 'editar', Auth::user()->id);

		$teste = Teste::find($id);

		if(is_null($teste))
		{
			return Redirect::to('testes');
		}

		$this->layout->title   = 'Editando Teste #'.$id;
		$this->layout->content = View::make('testes.editar')->with('teste', $teste);
	}

	/**
	 * Edit a specific teste.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_editar($id)
	{
		//Authorized::check('testes', 'editar', Auth::user()->id);

		$validation = Validator::make(Input::all(), array(
			'nome' => array('required'),
		));

		if($validation->valid())
		{
			$teste = Teste::find($id);

			if(is_null($teste))
			{
				return Redirect::to('testes');
			}

			$teste->nome = Input::get('nome');

			$teste->save();

			Session::flash('message', 'Atualizado TESTE #'.$teste->id);

			return Redirect::to('testes');
		}

		else
		{
			return Redirect::to('testes/editar/'.$id)
							->with_errors($validation->errors)
							->with_input();
		}
	}

	/**
	 * Delete a specific teste.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_excluir($id)
	{
		//Authorized::check('testes', 'excluir', Auth::user()->id);

		$teste = Teste::find($id);

		if( ! is_null($teste))
		{
			$teste->delete();

			Session::flash('message', 'Excluído TESTE #'.$teste->id);
		}

		return Redirect::to('testes');
	}

	/**
	 * Checkbox delete to selected testes.
	 *
	 * @return Response
	 */
	public function post_checkbox()
	{
		//Authorized::check('testes', 'excluir', Auth::user()->id);

		$checkboxes = Input::get('checkbox');

		if(!Input::has('checkbox')){ Session::flash('message', 'Nenhum item selecionado.'); return Redirect::to('testes'); }

		Teste::where_in('id', $checkboxes)->delete();

		Session::flash('message', 'Excluídos');

		return Redirect::to('testes');
	}
}