<script type="text/javascript">
$(document).ready(function () {
  // focus on the first text input field in the first field on the page
  $("input[type='text']:first", document.forms[0]).focus();
});
</script>
<div class="span12">
  <h3>Editando Teste</h3>
	{{ Form::open(null, 'post', array('class' => 'form-horizontal', 'autocomplete' => 'off')) }}
	<div class="control-group">
      <label class="control-label" for="nome">Nome{{ $errors->first('nome') }}</label>
      <div class="controls">
		{{ Form::text('nome', Input::old('nome', $teste->nome), array('placeholder' => 'Nome', 'required' => 'required', 'tabindex' => 1)) }}
      </div>
	</div>
    <div class="control-group">
      <div class="controls">
        {{ Form::submit('Salvar', array('class' => 'btn btn-primary', 'tabindex' => 2)) }}
        {{ HTML::link('testes', 'Cancelar', array('class' => 'btn','tabindex' => 3) ) }}
      </div>
    </div>
	{{ Form::close()}}
</div>