<script type="text/javascript">
$(document).ready(function () {
  // focus on the first text input field in the first field on the page
  $("input[type='text']:first", document.forms[0]).focus();
});
</script>
<div class="span12">
	<h3>Exibindo Teste</h3>
  {{ Form::open(null, 'post', array('class' => 'form-horizontal', 'autocomplete' => 'off')) }}
  <div class="control-group">
    <label class="control-label" for="inputNome">Nome{{ $errors->first('nome') }}</label>
    <div class="controls">
      {{ Form::text('nome', $teste->nome, array('placeholder' => 'Nome', 'required' => 'required', 'disabled' => 'disabled')) }}
    </div>
  </div>
  <div class="control-group">
    <div class="controls">			
      {{ HTML::link('testes/editar/'.$teste->id, 'Editar', array('class' => 'btn btn-primary')) }}
      {{ HTML::link('testes/excluir/'.$teste->id, 'Excluir', array('class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Voce tem certeza que deseja excluir este item?\')')) }}
      {{ HTML::link('testes', 'Cancelar', array('class' => 'btn')) }}
    </div>
  </div>
  {{ Form::close()}}
  <br>

</div>