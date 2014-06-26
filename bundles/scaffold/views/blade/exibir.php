<script type="text/javascript">
$(document).ready(function () {
  // focus on the first text input field in the first field on the page
  $("input[type='text']:first", document.forms[0]).focus();
});
</script>
<div class="span12">
	<h3>Exibindo <?php echo str_replace('_', ' ', $singular_class); ?></h3>
  {{ Form::open(null, 'post', array('class' => 'form-horizontal', 'autocomplete' => 'off')) }}
<?php foreach($fields as $field => $type): ?>
  <div class="control-group">
    <label class="control-label" for="input<?php echo ucwords(str_replace('_', ' ', $field)); ?>"><?php echo ucwords(str_replace('_', ' ', $field)); ?>{{ $errors->first('<?php echo $field; ?>') }}</label>
    <div class="controls">
<?php if(strpos($field, '_id') !== false && in_array(substr($field, 0, -3), $belongs_to)): ?>
      {{ Form::select('<?php echo $field; ?>', $<?php echo substr($field, 0, -3); ?>, $<?php echo $singular; ?>-><?php echo $field; ?>, array('placeholder' => '<?php echo ucwords(str_replace('_', ' ', $field)); ?>', 'required' => 'required', 'disabled' => 'disabled')) }}
<?php else: ?>
<?php if(in_array($type, array('string', 'integer', 'float', 'time', 'timestamp'))): ?>
      {{ Form::text('<?php echo $field; ?>', $<?php echo $singular; ?>-><?php echo $field; ?>, array('placeholder' => '<?php echo ucwords(str_replace('_', ' ', $field)); ?>', 'required' => 'required', 'disabled' => 'disabled')) }}
<?php elseif($type == 'date'): ?>
      {{ Form::text('<?php echo $field; ?>', DateBR::toView($<?php echo $singular; ?>-><?php echo $field; ?>, 'date'), array('placeholder' => '<?php echo ucwords(str_replace('_', ' ', $field)); ?>', 'required' => 'required', 'disabled' => 'disabled')) }}
<?php elseif($type == 'boolean'): ?>
      {{ Form::checkbox('<?php echo $field; ?>', '1', $<?php echo $singular; ?>-><?php echo $field; ?>, array('disabled' => 'disabled'))  }}
<?php elseif($type == 'text' || $type == 'blob'): ?>
      {{ Form::textarea('<?php echo $field; ?>', $<?php echo $singular; ?>-><?php echo $field; ?>, array('placeholder' => '<?php echo ucwords(str_replace('_', ' ', $field)); ?>', 'required' => 'required', 'disabled' => 'disabled')) }}
<?php endif; ?>
<?php endif; ?>
    </div>
  </div>
<?php endforeach; ?>
  <div class="control-group">
    <div class="controls">			
      {{ HTML::link('<?php echo $nested_path.$plural; ?>/editar/'.$<?php echo $singular; ?>->id, 'Editar', array('class' => 'btn btn-primary')) }}
      {{ HTML::link('<?php echo $nested_path.$plural; ?>/excluir/'.$<?php echo $singular; ?>->id, 'Excluir', array('class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Voce tem certeza que deseja excluir este item?\')')) }}
      {{ HTML::link('<?php echo $nested_path.$plural; ?>', 'Cancelar', array('class' => 'btn')) }}
    </div>
  </div>
  {{ Form::close()}}
  <br>

<?php foreach($plural_relationships as $relationship => $models): ?>
<?php foreach($models as $model): ?>
  <hr>
  <h3><?php echo ucwords(str_replace('_', ' ', Str::plural($model))); ?></h3>
  @if(count($<?php echo $singular; ?>-><?php echo Str::plural($model); ?>) == 0)
    <p>Sem <?php echo str_replace('_', ' ', Str::plural($model)); ?>.</p>
  @else
  <table id="<?php echo Str::plural($model); ?>" class="table table-striped table-bordered table-hover">
    <thead>
<?php foreach(Scaffold\Table::fields(Str::plural($model)) as $field): ?>
<?php if($field != 'id' && $field != $singular.'_id'): ?>
      <th><?php echo ucwords(str_replace('_', ' ', $field)); ?></th>
<?php endif; ?>
<?php endforeach; ?>
      <th></th>
    </thead>
    <tbody>
    @foreach($<?php echo $singular; ?>-><?php echo Str::plural($model); ?> as $<?php echo $model; ?>)
      <tr>
<?php foreach(Scaffold\Table::fields(Str::plural($model)) as $field): ?>
<?php if($field != 'id' && $field != $singular.'_id'): ?>
        <td>{{$<?php echo $model; ?>-><?php echo $field; ?>}}</td>
<?php endif; ?>
<?php endforeach; ?>
        <td class="dr-fxwidth">
          <a href="{{URL::to('<?php echo $url[$model]; ?>/exibir/'.$<?php echo $model; ?>->id)}}" class="icon-eye-open icon-large icon-black"></a>
          <a href="{{URL::to('<?php echo $url[$model]; ?>/editar/'.$<?php echo $model; ?>->id)}}" class="icon-pencil icon-large icon-black"></a>
          <a href="{{URL::to('<?php echo $url[$model]; ?>/excluir/'.$<?php echo $model; ?>->id)}}" class="icon-trash icon-large icon-black" onclick="return confirm('Voce tem certeza que deseja excluir este item?')"></a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  <br>
  @endif
  {{ HTML::link( '<?php echo $url[$model]; ?>/adicionar/'.$<?php echo $singular; ?>->id, ' Criar <?php echo ucwords(str_replace('_', ' ', $model)); ?>', array('class' => 'btn btn-primary') ) }}
<?php endforeach; ?>
<?php endforeach; ?>
</div>